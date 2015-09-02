<?php 
/*
* Template for Single SuperPages
*
*/
get_header(); 

if (have_posts()) : while (have_posts()) : the_post(); 
// post_password_required adds support for Password protection
	if ( !post_password_required() ){ ?>
<section id="content" class="superpage">
	<style>
		<?php 
			$showHeader = get_field("sp-show-header");
			if ($showHeader): else :
		?>
		#site-header,
		#site-nav{
			display:none !important;}
		<?php 
			endif;
			$spBgChoice = get_field("sp_default_bg_choice");
			if ( $spBgChoice == 'custom' ) : 
				$spBgImgId = get_field("sp_default_bg");
				$spBgSize = "page-background";
				$spBgImgArray = wp_get_attachment_image_src( $spBgImgId , $spBgSize );
				$spBgImgUrl = $spBgImgArray[0];
		?>
		body{
			background-image:url('<?php echo $spBgImgUrl; ?>') !important;
			background-size:cover;}
		<?php 
			elseif ($spBgChoice == 'none') :
		?>
		body{
			background:transparent !important;}
		<?php 
			endif;
		?>
	</style>

	<?php 
		function spBgImg($imgID, $imgAttach) {	
			if ( $imgID ){
				$bg_size = "page-background"; // (thumbnail, medium, large, full or custom size)
				$bg_img = wp_get_attachment_image_src( $imgID , $bg_size );
				if ( $imgAttach == 'scroll' ){	
					$bg_img_string = "style='background-image:url(" . $bg_img[0] . ");'";
					echo $bg_img_string;
				} else {
					$bg_parallax_string = 'data-parallax="scroll" data-image-src="' . $bg_img[0] . '"';
					echo $bg_parallax_string;
				}
			} else {
				return false;
			}
		}
		function spBgImgCredit($imgCred, $imgCredUrl) {	
			if ( $imgCred ){
				if ($imgCredUrl){
					$bg_cred_link_open = '<a href="' . $bg_cred_link_front . '" target="_blank">';
					$bg_cred_link_close = '</a>'; 
				}
				$bg_cred_string = '<div class="section-img-credit">' . $bg_cred_link_open . $imgCred . $bg_cred_link_close . '</div>';
				echo $bg_cred_string;
			} else {
				return false;
			}
		}

		if( have_rows( "sp-sections" ) ): while( have_rows( "sp-sections" ) ): the_row(); 
		$id = get_sub_field("sp-id");
		$bgcolor = get_sub_field("sp-bg-color");
		$padding = get_sub_field("sp-padding");
		$width = get_sub_field("sp-width");
		$bg_attachment_id = get_sub_field('sp-bg-image');
		if ( $bg_attachment_id ){
			$bg_img_status = 'on'; }
		else {
			$bg_img_status = 'off'; }
		$bg_img_size = get_sub_field('sp-bg-image-size');
		$bg_img_attach = get_sub_field('sp-bg-image-attach');
		$bg_img_repeat = get_sub_field('sp-bg-image-repeat');
		$bg_img_credit = get_sub_field('sp-bg-image-credit');
		$bg_img_credit_url = get_sub_field('sp-bg-image-credit-url');
		$classes = "box-" . $bgcolor . " bg-repeat-" . $bg_img_repeat . " bg-image-" . $bg_img_status . " bg-attach-" . $bg_img_attach . " bg-size-". $bg_img_size . " width-" . $width . " padding-" . $padding;

		if(get_row_layout() == "sp-section-texthtml"): // layout: Text/HTML ?>
			<div <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section text-html <?php echo $classes; ?>" id="<?php echo $id; ?>">
				<div class="section-inner text-html-inner">
				<?php the_sub_field("sp-section-content"); ?>
				<br class="clear">
				</div>
				<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
			</div>
			
		<?php elseif(get_row_layout() == "sp-section-code") : ?>
			<div <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section code <?php echo $classes; ?>" id="<?php echo $id; ?>">
				<div class="section-inner code-inner">
				<?php echo apply_filters('acf-run-shortcodes', get_sub_field("sp-section-content"), true); ?>
				<br class="clear">
				</div>
				<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
			</div>

		<?php elseif(get_row_layout() == "sp-section-ticker") : ?>
		
			<div <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> id="news-ticker">
				<div class="section-inner code-inner <?php echo $classes; ?>" id="<?php echo $id; ?>">
				<?php if(function_exists('ditty_news_ticker')){ditty_news_ticker(3256);} ?>
				</div>
				<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
			</div>

		<?php elseif(get_row_layout() == "sp-section-actionkit") : ?>
		
			<div <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section action-kit <?php echo $classes; ?>" id="<?php echo $id; ?>">
				<div id="action-kit-inner" class="section-inner code-inner">
					<h3 style="text-align:center;"><strong><?php echo get_sub_field('sp-actionkit-title'); ?></strong></h3>
			<?php $akpage = get_sub_field( 'sp-section-actionkit' ); ?>
				<?php if ($akpage == '') { ?>
					<p><strong>Error:</strong> Insert your ActionKit Page ID in the widget settings to activate this form.</p>
				<?php }else{ 
			$actionk_title = get_sub_field( 'sp-actionkit-title' );
			$actionk_intro =  get_sub_field( 'sp-actionkit-intro' );
			$actionk_submit = get_sub_field( 'sp-actionkit-submit' );
			$actionk_name = get_sub_field( 'sp-actionkit-name' ); 
			$actionk_name_label = get_sub_field( 'sp-actionkit-name-label' );
			$actionk_email = get_sub_field( 'sp-actionkit-email' ); 
			$actionk_email_label = get_sub_field( 'sp-actionkit-email-label' ); 
			$actionk_city = get_sub_field( 'sp-actionkit-city' );
			$actionk_city_label = get_sub_field( 'sp-actionkit-city-label' );
			$actionk_phone = get_sub_field( 'sp-actionkit-phone' );
			$actionk_phone_label = get_sub_field( 'sp-actionkit-phone-label' );
			$actionk_zip = get_sub_field( 'sp-actionkit-zip' );
			$actionk_zip_label = get_sub_field( 'sp-actionkit-zip-label' );
			$actionk_postal = get_sub_field( 'sp-actionkit-postal' );
			$actionk_postal_label = get_sub_field( 'sp-actionkit-postal-label' );
			$actionk_country = get_sub_field( 'sp-actionkit-country' );
			$actionk_country_label = get_sub_field( 'sp-actionkit-country-label' );
			$actionk_confirm = get_sub_field( 'sp-actionkit-confirmation' );
			$actionk_custom = get_sub_field( 'sp-actionkit-custom' );
			$input_text_class = ( get_sub_field('sp-actionkit-horizontal') ) ? "c2" : "input text";
			$input_select_class = ( get_sub_field('sp-actionkit-horizontal') ) ? "c2" : "input select";
			$input_submit_class = ( get_sub_field('sp-actionkit-horizontal') ) ? "c2" : " ";
			?>
			<form class="actionkit-widget" style="text-align:center;" name="signup" action="https://act.350.org/act/" onsubmit="this.submitted=1; return false;">
			<div class="ak-preform-text" style="margin-bottom:1em;">
				<?php echo stripslashes($actionk_intro) ?>
			</div>
			<input type="hidden" name="page" value="<?=$akpage?>">
			
			<?php if ($actionk_name) { ?>
				<div class="<?php echo $input_text_class; ?> name">
					<input value="" id="actionk_name" type="text" name="name" placeholder="<?php echo ( $actionk_name_label ) ? $actionk_name_label : "Name";?>"/> 
				</div>		
			<?php } ?>
				<div class="<?php echo $input_text_class; ?> email">
					<input value="" id="actionk_email" type="text" name="email" placeholder="<?php echo ( $actionk_email_label ) ? $actionk_email_label : "Email";?>"/> 
				</div>
			<?php if ($actionk_city) { ?>
				<div class="<?php echo $input_text_class; ?> city">
					<input value="" id="actionk_city" type="text" name="city" placeholder="<?php echo ( $actionk_city_label ) ? $actionk_city_label : "City";?>"/> 
				</div>
			<?php }; ?>
			<?php if ($actionk_postal) { ?>
				<div class="<?php echo $input_text_class; ?> postal">
					<input value="" id="actionk_postal" type="text" name="postal" placeholder="<?php echo ( $actionk_postal_label ) ? $actionk_postal_label : "Postal";?>"/> 
				</div>
			<?php }; ?>
			<?php if ($actionk_zip) { ?>
				<div class="<?php echo $input_text_class; ?> zip">
					<input value="" id="actionk_zip" type="text" name="zip" placeholder="<?php echo ( $actionk_zip_label ) ? $actionk_zip_label : "Zip";?>"/> 
				</div>
			<?php }; ?>
			<?php if ($actionk_phone) { ?>
				<div class="<?php echo $input_text_class; ?> phone">
					<input value="" id="actionk_phone" type="text" name="phone" placeholder="<?php echo ( $actionk_phone_label ) ? $actionk_phone_label : "Phone";?>" /> 
				</div>
			<?php }; ?>
			<div class="<?php echo $input_select_class; ?> country">
		
			<select class="country" name="country" id="actionk_country" title="<?php echo ( $actionk_country_label ) ? $actionk_country_label : "Select Country";?>" >
			<option selected><?php echo ( $actionk_country_label ) ? $actionk_country_label : "Select Country";?></option>
			<option>United States</option>
			<option>Afghanistan</option>
			<option>Albania</option>
			<option>Algeria</option>
			<option>American Samoa</option>
			<option>Andorra</option>
			<option>Angola</option>
			<option>Anguilla</option>
			<option>Antigua and Barbuda</option>
			<option>Argentina</option>
			<option>Armenia</option>
			<option>Aruba</option>
			<option>Australia</option>
			<option>Austria</option>
			<option>Azerbaijan</option>
			<option>Bahamas</option>
			<option>Bahrain</option>
			<option>Bangladesh</option>
			<option>Barbados</option>
			<option>Belarus</option>
			<option>Belgium</option>
			<option>Belize</option>
			<option>Benin</option>
			<option>Bermuda</option>
			<option>Bhutan</option>
			<option>Bolivia</option>
			<option>Bonaire</option>
			<option>Bosnia and Herzegovina</option>
			<option>Botswana</option>
			<option>Brazil</option>
			<option>British Indian Ocean Territory</option>
			<option>British Virgin Islands</option>
			<option>Brunei Darussalam</option>
			<option>Bulgaria</option>
			<option>Burkina Faso</option>
			<option>Burundi</option>
			<option>Cambodia</option>
			<option>Cameroon</option>
			<option>Canada</option>
			<option>Cape Verde</option>
			<option>Cayman Islands</option>
			<option>Central African Republic</option>
			<option>Chad</option>
			<option>Chile</option>
			<option>China</option>
			<option>Christmas Island</option>
			<option>Cocos Islands</option>
			<option>Colombia</option>
			<option>Comoros</option>
			<option>Congo - Brazzaville</option>
			<option>Congo - Kinshasa (DRC)</option>
			<option>Cook Islands</option>
			<option>Costa Rica</option>
			<option>Cote D'Ivoire</option>
			<option>Croatia</option>
			<option>Cuba</option>
			<option>Curacao</option>
			<option>Cyprus</option>
			<option>Czech Republic</option>
			<option>Denmark</option>
			<option>Djibouti</option>
			<option>Dominica</option>
			<option>Dominican Republic</option>
			<option>East Timor</option>
			<option>Ecuador</option>
			<option>Egypt</option>
			<option>El Salvador</option>
			<option>Equatorial Guinea</option>
			<option>Eritrea</option>
			<option>Estonia</option>
			<option>Ethiopia</option>
			<option>Falkland Islands</option>
			<option>Faroe Islands</option>
			<option>Federated States of Micronesia</option>
			<option>Fiji</option>
			<option>Finland</option>
			<option>France</option>
			<option>French Guiana</option>
			<option>French Polynesia</option>
			<option>Gabon</option>
			<option>Gambia</option>
			<option>Georgia</option>
			<option>Germany</option>
			<option>Ghana</option>
			<option>Gibraltar</option>
			<option>Greece</option>
			<option>Greenland</option>
			<option>Grenada</option>
			<option>Guadeloupe</option>
			<option>Guam</option>
			<option>Guatemala</option>
			<option>Guernsey</option>
			<option>Guinea</option>
			<option>Guinea-Bissau</option>
			<option>Guyana</option>
			<option>Haiti</option>
			<option>Honduras</option>
			<option>Hong Kong</option>
			<option>Hungary</option>
			<option>Iceland</option>
			<option>India</option>
			<option>Indonesia</option>
			<option>Iran</option>
			<option>Iraq</option>
			<option>Ireland</option>
			<option>Israel</option>
			<option>Italy</option>
			<option>Jamaica</option>
			<option>Japan</option>
			<option>Jordan</option>
			<option>Kazakhstan</option>
			<option>Kenya</option>
			<option>Kiribati</option>
			<option>Kosovo</option>
			<option>Kuwait</option>
			<option>Kyrgyzstan</option>
			<option>Laos</option>
			<option>Latvia</option>
			<option>Lebanon</option>
			<option>Lesotho</option>
			<option>Liberia</option>
			<option>Libya</option>
			<option>Liechtenstein</option>
			<option>Lithuania</option>
			<option>Luxembourg</option>
			<option>Macau</option>
			<option>Madagascar</option>
			<option>Malawi</option>
			<option>Malaysia</option>
			<option>Maldives</option>
			<option>Mali</option>
			<option>Malta</option>
			<option>Marshall Islands</option>
			<option>Martinique</option>
			<option>Mauritania</option>
			<option>Mauritius</option>
			<option>Mexico</option>
			<option>Moldova</option>
			<option>Monaco</option>
			<option>Mongolia</option>
			<option>Montenegro</option>
			<option>Montserrat</option>
			<option>Morocco</option>
			<option>Mozambique</option>
			<option>Myanmar / Burma</option>
			<option>Namibia</option>
			<option>Nauru</option>
			<option>Nepal</option>
			<option>Netherlands</option>
			<option>Netherlands Antilles</option>
			<option>New Caledonia</option>
			<option>New Zealand</option>
			<option>Nicaragua</option>
			<option>Niger</option>
			<option>Nigeria</option>
			<option>Niue</option>
			<option>North Korea</option>
			<option>Northern Mariana Islands</option>
			<option>Norway</option>
			<option>Oman</option>
			<option>Pakistan</option>
			<option>Palau</option>
			<option>Palestine</option>
			<option>Panama</option>
			<option>Papua New Guinea</option>
			<option>Paraguay</option>
			<option>Peru</option>
			<option>Philippines</option>
			<option>Pitcairn</option>
			<option>Poland</option>
			<option>Portugal</option>
			<option>Puerto Rico</option>
			<option>Qatar</option>
			<option>Republic of Macedonia</option>
			<option>Reunion</option>
			<option>Romania</option>
			<option>Russia</option>
			<option>Rwanda</option>
			<option>Saint Helena</option>
			<option>Saint Kitts and Nevis</option>
			<option>Saint Lucia</option>
			<option>Saint Pierre and Miquelon</option>
			<option>Saint Vincent and The Grenadines</option>
			<option>Samoa</option>
			<option>San Marino</option>
			<option>Sao Tome and Principe</option>
			<option>Saudi Arabia</option>
			<option>Senegal</option>
			<option>Serbia</option>
			<option>Seychelles</option>
			<option>Sierra Leone</option>
			<option>Singapore</option>
			<option>Slovakia</option>
			<option>Slovenia</option>
			<option>Solomon Islands</option>
			<option>Somalia</option>
			<option>Somaliland</option>
			<option>South Africa</option>
			<option>South Georgia and the South Sandwich Islands</option>
			<option>South Korea</option>
			<option>South Sudan</option>
			<option>Spain</option>
			<option>Sri Lanka</option>
			<option>Sudan</option>
			<option>Suriname</option>
			<option>Swaziland</option>
			<option>Sweden</option>
			<option>Switzerland</option>
			<option>Syrian Arab Republic</option>
			<option>Taiwan</option>
			<option>Tajikistan</option>
			<option>Tanzania</option>
			<option>Thailand</option>
			<option>Togo</option>
			<option>Tokelau</option>
			<option>Tonga</option>
			<option>Trinidad and Tobago</option>
			<option>Tunisia</option>
			<option>Turkey</option>
			<option>Turkmenistan</option>
			<option>Turks and Caicos Islands</option>
			<option>Tuvalu</option>
			<option>U.S. Virgin Islands</option>
			<option>Uganda</option>
			<option>Ukraine</option>
			<option>United Arab Emirates</option>
			<option>United Kingdom</option>
			<option>United States</option>
			<option>Uruguay</option>
			<option>Uzbekistan</option>
			<option>Vanuatu</option>
			<option>Vatican City State</option>
			<option>Venezuela</option>
			<option>Vietnam</option>
			<option>Wallis and Futuna</option>
			<option>Western Sahara</option>
			<option>Yemen</option>
			<option>Zambia</option>
			<option>Zimbabwe</option>
			</select>
			</div>
			<?php if ($actionk_custom){?>
			<div class="custom_html">
				<?php echo $actionk_custom; ?>
			</div>
			<?php } ?>
			<div class="<?php echo $input_submit_class; ?>">
			<input class="submit <?php if ( get_sub_field("sp-bg-color") ==="orange" ) echo "blue";?>"	type="submit" value="<?php echo $actionk_submit; ?>" onClick="ga('send','event', {eventCategory: 'email', eventAction: 'superpage-action', eventLabel: <?php echo $akpage; ?>'});" >
			</div>
		</form>
		<?php } ?>
		<div id="signup-replacement" style="display: none;">
			<p><?php echo stripslashes($actionk_confirm) ?></p>
		</div>
		<script src="http://act.350.org/samples/widget.js"></script>
		<br class="clear">
				</div>
				<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
			</div>			
		<?php elseif(get_row_layout() == "sp-section-posts") : ?>
			<?php 
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$showposts = get_sub_field('sp-posts-num');
				$catslug = get_sub_field('sp-posts-cat');
				$posts_args = array(
					'posts_per_page'=> $showposts,
					'category_name' => $catslug,
					'paged' => $paged, 
				);
				$posts_query = new WP_query($posts_args);
			?>
			<?php if ($posts_query->have_posts()) : ?>
			<div id="blog" <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section posts <?php echo $classes; ?>" id="<?php echo $id; ?>">
				<div id="blog-inner" class="section-inner posts-inner">
					<h3 class="section-title"><?php echo get_sub_field('sp-section-title'); ?></h3>
					<?php 
						while ($posts_query->have_posts()) : $posts_query->the_post();
							get_template_part('content','post');
						endwhile;
					?>
					<p class="button"><?php next_posts_link('Older Posts', $posts_query->max_num_pages); ?></p>
					<br class="clear">
				</div>
				<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
			</div>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		<?php elseif(get_row_layout() == "sp-section-grid") : ?>
			<?php $columns = get_sub_field('grid-square-columns'); ?>
			<?php 
				if( have_rows('grid-square') ): ?>
				<div id="<?php echo $id; ?>" <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section img-grid <?php echo $classes; ?>">
					<div class="section-inner img-grid-inner">
				    <?php while ( have_rows('grid-square') ) : the_row(); ?>
					<?php 
						$attachment_id = get_sub_field('grid-square-img');
						$size = "grid-square"; // (thumbnail, medium, large, full or custom size)
						$grid_img = wp_get_attachment_image_src($attachment_id, $size );
						$grid_img_full = wp_get_attachment_image_src($attachment_id, 'full' );
					?>
					<div class="img-grid-square <?php echo $columns; ?>">
				    	<a rel="image_grid" href="<?php ( the_sub_field('grid-square-link') ) ? the_sub_field('grid-square-link') : $grid_img_full[0]; ?>" class="<?php echo ( the_sub_field('grid-square-link') == '' ) ? "fancybox": ''; ?>">
				    		<span class="img-grid-square-img">
				    			
								<img data-src="<?php echo $grid_img[0] ?>" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"/>
								<noscript>
									<img class="img-grid-square-nojs-image" src="<?php echo $grid_img[0] ?>"/>
								</noscript>
				    		</span>
				    		<?php if (get_sub_field('grid-square-title')): ?>
				    		<span class="img-grid-square-title">
				    			<span>
				    				<span><?php the_sub_field('grid-square-title'); ?></span>
				    			</span>
				    		</span>
				    		<?php endif; ?>
				        </a>
						</div>
				    <?php endwhile; ?>
				    <div class="clear"></div>
					</div>
					<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
				</div>
				<?php 
				else :
				 // no rows found
				endif;
			?>

		<?php elseif(get_row_layout() == "sp-section-nav") : ?>
		
			<nav <?php spBgImg($bg_attachment_id, $bg_img_attach); ?> class="section nav <?php echo $classes; ?>" id="<?php echo $id; ?>">
				<div class="section-inner nav-inner">
				<?php 
					$navslug = get_sub_field("sp-section-navslug"); 
					wp_nav_menu(array(
						'menu' => $navslug,	
						'fallback_cb' => '',
					));
				?>
				</div>
				<?php spBgImgCredit($bg_img_credit, $bg_img_credit_url); ?>
			</nav>
		
		<?php endif; ?>
		
	<?php 
	
	endwhile;
	
	endif; // end ACF flex field loop
	
	?>
	
</section>

<?php 
} else { 
// if password protect is enabled, get the pw form ?>
		<section id="content" class="box-white section">
			<div class="section-inner">
				<?php
					echo get_the_password_form();
				?>
			</div>
		</section>
<?php }

endwhile; 

endif; // end WP post loop

get_footer(); 
