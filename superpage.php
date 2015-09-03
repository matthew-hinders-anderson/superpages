<?php
/*
Plugin Name: Super Pages
Plugin URI: http://walihassan.com
Description: Super Pages Plugin
Version: 1.1.2
Author: Wali Hassan, Matthew Anderson
Author URI: http://walihassan.com
GitHub Plugin URI: https://github.com/walihassanjafferi/SuperPages/
GitHub Branch: master
*/
// Define urls/paths that will be used throughout the plugin
define( 'SP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SP_PLUGIN_CLASS_DIR', SP_PLUGIN_DIR.'classes/' );

require ( SP_PLUGIN_CLASS_DIR . 'advanced_fields.php' );

class SuperPages_Class {

	public function __construct() {
		
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_superpages_style' ) );
		add_action( 'init', array ( $this, 'add_superpage_type' ) );
		add_filter( 'single_template', array( $this, 'sp_single_template' ) );
		add_filter( 'post_type_link', array ( $this, 'df_custom_post_type_link') , 10, 2 );
		add_action( 'init', array ( $this, 'df_custom_rewrite_rule' ) );		
		add_action( 'wp_head', array ( $this, 'into_head' ) );	
		
	}
	
	public function enqueue_superpages_style(){
		global $post;
		if ($post->post_type == "super_pages"){
			$superpages_plugin_directory = plugin_dir_url( __FILE__ );
			wp_enqueue_script('jquery');
			wp_enqueue_style( 'superpages-frontend-css', $superpages_plugin_directory . 'css/style.css');
			wp_enqueue_style( 'superpages-lightbox-css', $superpages_plugin_directory . 'source/jquery.fancybox.css');				
			wp_enqueue_script( 'superpages-lightbox-js', $superpages_plugin_directory . 'source/jquery.fancybox.pack.js');	
		}
	}
	
	
	//Fancybox OR Lightbox for Image Grid
	public function into_head(){
		global $post;
		if ($post->post_type == "super_pages"){
		?>
		
			 <script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery(".fancybox").fancybox({
						padding: 0,
						fitToView	: true,
						scrolling   : false,
						autoSize	: true,
						closeClick	: false,
						openEffect	: 'none',
						closeEffect	: 'none',
						helpers:  {
									overlay : {
										css : {
											'background-color' : 'rgba(255,255,255,0.5)'
										}
									}
								},
									afterClose: function(){
								 jQuery(".fancybox").css("display","block");
								}
							});
					});
			</script>
		<?php }
	}			
	
	/**
	* Register a Feature Template post type.
	*
	* @link http://codex.wordpress.org/Function_Reference/register_post_type
	*/
	public function add_superpage_type() {
		$labels = array(
			'name'               => _x( 'Super Pages', 'post type general name', 'super-pages' ),
			'singular_name'      => _x( 'Super Page', 'post type singular name', 'super-pages' ),
			'menu_name'          => _x( 'Super Pages', 'admin menu', 'super-pages' ),
			'name_admin_bar'     => _x( 'Super Page', 'add new on admin bar', 'super-pages' ),
			'add_new'            => _x( 'Add New', 'Super Page', 'super-pages' ),
			'add_new_item'       => __( 'Add New Super Page', 'super-pages' ),
			'new_item'           => __( 'New Super Page', 'super-pages' ),
			'edit_item'          => __( 'Edit Super Page', 'super-pages' ),
			'view_item'          => __( 'View Super Page', 'super-pages' ),
			'all_items'          => __( 'All Super Pages', 'super-pages' ),
			'search_items'       => __( 'Search Super Pages', 'super-pages' ),
			'parent_item_colon'  => __( 'Parent Super Pages:', 'super-pages' ),
			'not_found'          => __( 'No Super Pages found.', 'super-pages' ),
			'not_found_in_trash' => __( 'No Super Pages found in Trash.', 'super-pages' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite' 			 => apply_filters( 'sp_superpages_posttype_rewrite_args', array( 'slug' => false, 'with_front' => true) ),
			'capability_type'    => 'page',
			'has_archive'        => true,
			'hierarchical'       => false,
			'can_export' 	     => true,
			'menu_icon'			 => 'dashicons-schedule',
			'menu_position'      => null,
			'supports'			 => array('title', 'custom-fields', 'revisions'),
			'taxonomies'		 => array( 'category')
		);

		register_post_type( 'super_pages', $args );	

	}
	
	public function sp_single_template( $single ) {
	
		global $post;

		/* Checks for single template by post type */
		if ($post->post_type == "super_pages"){

			if( file_exists( SP_PLUGIN_CLASS_DIR. 'single-super_pages.php' ) )
		
			return SP_PLUGIN_CLASS_DIR . 'single-super_pages.php';
		
		}
		
			return $single;
		
	}
	

	/**
	 * Remove the slug from published post permalinks.
	 */
	public function df_custom_post_type_link( $post_link, $id = 0 ) {  

		$post = get_post( $id );  

		if ( is_wp_error( $post ) || 'super_pages' != $post->post_type || empty( $post->post_name ) )  
        
			return $post_link;  

		return home_url( user_trailingslashit( "$post->post_name" ) );  
	}


	/**
	 * Some hackery to have WordPress match postname to any of our public post types
	 * All of our public post types can have /post-name/ as the slug, so they better be unique across all posts
	 * Typically core only accounts for posts and pages where the slug is /post-name/
	 */
	public function df_custom_rewrite_rule() {
    
		add_rewrite_rule( '(.*?)$', 'index.php?super_pages=$matches[1]', 'top' );
	
	}
	
	
	
}
$SuperPages = new SuperPages_Class();

//Shortcode for Count down
add_shortcode( 'sp-countdown', 'sp_counter_shortcode');	
function sp_counter_shortcode($atts, $content=null){
	
	$atts_array = shortcode_atts(array(
	 'date' => '',
	 'width' => ''
	),$atts);
	
	//Enqueueing the Actual JS for Countdown When shortcode is rendered only
	$superpages_plugin_directory = plugin_dir_url( __FILE__ );
	wp_enqueue_script( 'superpages-counter-js', $superpages_plugin_directory . 'source/jquery.countdown.js');
	wp_enqueue_style( 'superpages-counter-css', $superpages_plugin_directory . 'css/jquery.countdown.css');
	wp_enqueue_script( 'superpages-counter-active-js', $superpages_plugin_directory . 'source/counter-active.js');
	wp_localize_script('superpages-counter-active-js','counter_atts',$atts_array);
	
ob_start();

?>
<div class="countdownHolder" style="width:<?php echo $atts['width']; ?>;">
<span id="clock"></span>
<input type="hidden" name="spcd_date" id="spcd_date" value="<?php echo $atts['date']; ?>">
</div>	
<?php

$content = ob_get_clean();

return $content;
}	
