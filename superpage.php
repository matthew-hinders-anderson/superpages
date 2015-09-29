<?php
/*
Plugin Name: Super Pages
Plugin URI: http://walihassan.com
Description: Super Pages Plugin
Version: 1.1.4
Author: Wali Hassan, Matthew Anderson
Author URI: http://walihassan.com
GitHub Plugin URI: https://github.com/matthew-350/superpages
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
		add_action( 'init', array( $this, 'create_superpage_taxonomies') , 0 );
		add_action( 'init', array( $this, 'add_homepage_display_location') , 0 );
		
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
			'menu_position'		 => 4,
			'query_var'          => true,
			'rewrite' 			 => apply_filters( 'sp_superpages_posttype_rewrite_args', array( 'slug' => false, 'with_front' => true) ),
			'capability_type'    => 'page',
			'has_archive'        => true,
			'hierarchical'       => false,
			'can_export' 	     => true,
			'menu_icon'			 => 'dashicons-align-center',
			'menu_position'      => null,
			'supports'			 => array('title', 'custom-fields', 'revisions'),
			'taxonomies'		 => array( 'display-location')
		);

		register_post_type( 'super_pages', $args );	

	}
	// Create superpage taxonomies
function create_superpage_taxonomies() {
	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Display Locations', 'taxonomy general name' ),
		'singular_name'              => _x( 'Display Location', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Display Location' ),
		'popular_items'              => __( 'Popular Display Locations' ),
		'all_items'                  => __( 'All Display Locations' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Display Location' ),
		'update_item'                => __( 'Update Display Location' ),
		'add_new_item'               => __( 'Add New Display Location' ),
		'new_item_name'              => __( 'New Display Location Name' ),
		'separate_items_with_commas' => __( 'Separate locations with commas' ),
		'add_or_remove_items'        => __( 'Add or remove locations' ),
		'choose_from_most_used'      => __( 'Choose from the most used locations' ),
		'not_found'                  => __( 'No display locations found.' ),
		'menu_name'                  => __( 'Display Locations' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'display-location' ),
	);

	register_taxonomy( 'display-location', 'super_pages', $args );
}



// Pre-add 'Homepage' as an option, so people don't forget/mis-enter it
function add_homepage_display_location(){
	wp_insert_term( 'Homepage', 'display-location', array('description'=> 'Display this content on the homepage. If more than one superpage is marked, the newer one is displayed.','slug' => 'homepage'));
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
	

	/* ****** This is Wali's permalink code — breaks all non-superpage permalinks ******
	  Remove the slug from published post permalinks.
	  
	public function df_custom_post_type_link( $post_link, $id = 0 ) {  

		$post = get_post( $id );  

		if ( is_wp_error( $post ) || 'super_pages' != $post->post_type || empty( $post->post_name ) )  
        
			return $post_link;  

		return home_url( user_trailingslashit( "$post->post_name" ) );  
	}
	*/

	/*
	 * Some hackery to have WordPress match postname to any of our public post types
	 * All of our public post types can have /post-name/ as the slug, so they better be unique across all posts
	 * Typically core only accounts for posts and pages where the slug is /post-name/
	 *
	public function df_custom_rewrite_rule() {
    
		add_rewrite_rule( '(.*?)$', 'index.php?super_pages=$matches[1]', 'top' );
	
	}

	// Original, older permalink rewrite code

	*/
	//Some URL hackin' shit - To get custom post types to not use a slug, i.e. '350.org/my-custom-post', not '350.org/custom-post-type/my-custom-post'

	/**
	 * Remove the slug from published post permalinks.
	 */
	function custom_remove_cpt_slug_two( $post_link, $post, $leavename ) {
	 
	    if ( 'super_page' != $post->post_type || 'publish' != $post->post_status ) {
	        return $post_link;
	    }
	 	$current_blog;
		//$raw_blog_path = $current_blog->path;
		//trim the leading slash off
		//$blog_path = substr($raw_blog_path, 1, -1);
	    //$post_link = str_replace( $raw_blog_path . $post->post_type . '/', $raw_blog_path , $post_link );
		$post_link = str_replace( '/' . $post->post_type . '/', '/' , $post_link );
	 
	    return $post_link; global
	}
	add_filter( 'post_type_link', 'custom_remove_cpt_slug_two', 10, 3 );

	/**
	 * Some hackery to have WordPress match postname to any of our public post types
	 * All of our public post types can have /post-name/ as the slug, so they better be unique across all posts
	 * Typically core only accounts for posts and pages where the slug is /post-name/
	 */
	function custom_parse_request_tricksy_two( $query ) {
	 
	    // Only noop the main query
	    if ( ! $query->is_main_query() )
	        return;
	 
	    // Only noop our very specific rewrite rule match
	    if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
	        return;
	    }
	 
	    // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
	    if ( ! empty( $query->query['name'] ) ) {
	        $query->set( 'post_type', array( 'post', 'super_pages', 'page' ) );
	    }
	}
	add_action( 'pre_get_posts', 'custom_parse_request_tricksy_two' );
	
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
