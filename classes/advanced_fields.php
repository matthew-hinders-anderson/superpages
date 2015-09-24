<?php
/*
* Advanced Custom Fields for SuperPages Plugin
@ Depends on ACF WP Plugin
*
*/

/* Check for site_colors option, use default 350 colors if not present */
$site_colors_json = get_option('site_colors');
if ( $site_colors_json ){
	/* json_decode doesn't work on WPEngine's PHP v4.x :((
	$sp_colors = json_decode( $site_colors_json, true);
	... so do it the old-fashioned way: */
	$sp_colors = array();
	// break the string by comma
	$colors = explode(',', $site_colors_json);
	// iterate through the lines.
	foreach( $colors as $color )
	{ 
	    // just make sure that the line's whitespace is cleared away
	    $color = trim( $color );
	    if( $color ) 
	    {
	        // break the line at the colon
	        $pieces = explode( ":", $color );
	        // the first piece now serves as the index. 
	        // The second piece as the value.
	        $sp_colors[ $pieces[ 0 ] ] = $pieces[ 1 ];
	    }
	}
} else {
	$sp_colors = array (
		'white' => 'White',
		'orange' => 'Orange',
		'blue' => 'Blue',
		'ltgray' => 'Light Gray',
		'dkgray' => 'Dark Gray',
		'-' => 'Transparent',
	);
}

$sp_actionkit_title = array (
	'key' => 'field_549704ed2d911',
	'label' => 'Title:',
	'name' => 'sp-actionkit-title',
	'type' => 'text',
	'instructions' => '',
	'column_width' => '',
	'default_value' => '',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_actionkit_intro = array (
	'key' => 'field_549704ed2d912',
	'label' => 'Introductory Text:',
	'name' => 'sp-actionkit-intro',
	'type' => 'wysiwyg',
	'instructions' => '',
	'column_width' => '',
	'default_value' => '',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_actionkit_submit = array (
	'key' => 'field_549704ed2d921',
	'label' => 'Submit Button Text:',
	'name' => 'sp-actionkit-submit',
	'type' => 'text',
	'instructions' => '',
	'column_width' => '',
	'default_value' => 'Sign Up',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_actionkit_confirmation = array (
	'key' => 'field_549704ed2d922',
	'label' => 'Confirmation Message:',
	'name' => 'sp-actionkit-confirmation',
	'type' => 'textarea',
	'instructions' => 'Replaces the form once data is successfully submitted.',
	'column_width' => '',
	'default_value' => 'Thank You for Signing Up!',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);

$sp_actionkit_custom = array (
	'key' => 'field_549704ed2d923',
	'label' => 'Custom Field HTML:',
	'name' => 'sp-actionkit-custom',
	'type' => 'textarea',
	'instructions' => 'HTML for additional custom input fields.',
	'column_width' => '',
	'default_value' => '',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_actionkit_translate = array (
	'key' => 'field_549704ed2d9100',
	'label' => 'Translate',
	'name' => 'sp-actionkit-translate',
	'type' => 'checkbox',
	'instructions' => 'Translate',
	'choices' => array (
		'true' => 'Translate the Labels',
	),
	'default_value' => '',
);
$sp_actionkit_name = array (
	'key' => 'field_549704ed2d913',
	'label' => 'Name',
	'name' => 'sp-actionkit-name',
	'type' => 'checkbox',
	'instructions' => 'Check to Ask for Name',
	'choices' => array (
		'true' => 'Ask for Name',
	),
	'default_value' => '',
);
$sp_actionkit_name_label = array (
	'key' => 'field_549704ed2d913a',
	'label' => 'Translate "NAME" Label',
	'name' => 'sp-actionkit-name-label',
	'type' => 'text',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_549704ed2d9100',
				'operator' => '==',
				'value' => 'true',
			),
		),
		'allorany' => 'all',
	),
	'instructions' => '',
	'column_width' => '',
	'default_value' => 'Name',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);

$sp_actionkit_email = array (
	'key' => 'field_549704ed2d914',
	'label' => 'Email',
	'name' => 'sp-actionkit-email',
	'type' => 'checkbox',
	'instructions' => 'Check to Ask for Email',
	'choices' => array (
		'true' => 'Ask for Email',
	),
	'default_value' => 'true',
);
$sp_actionkit_email_label = array (
	'key' => 'field_549704ed2d914a',
	'label' => 'Translate "Email" Label',
	'name' => 'sp-actionkit-email-label',
	'type' => 'text',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_549704ed2d9100',
				'operator' => '==',
				'value' => 'true',
			),
		),
		'allorany' => 'all',
	),
	'instructions' => '',
	'column_width' => '',
	'default_value' => 'Email',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_actionkit_city = array (
	'key' => 'field_549704ed2d915',
	'label' => 'City',
	'name' => 'sp-actionkit-city',
	'type' => 'checkbox',
	'instructions' => 'Check to Ask for City',
	'choices' => array (
		'true' => 'Ask for City',
	),
	'default_value' => '',
);
$sp_actionkit_city_label = array (
	'key' => 'field_549704ed2d915a',
	'label' => 'Translate "City" Label',
	'name' => 'sp-actionkit-city-label',
	'type' => 'text',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_549704ed2d9100',
				'operator' => '==',
				'value' => 'true',
			),
		),
		'allorany' => 'all',
	),
	'instructions' => '',
	'column_width' => '',
	'default_value' => 'City',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_actionkit_postal = array (
	'key' => 'field_549704ed2d916',
	'label' => 'Postal',
	'name' => 'sp-actionkit-postal',
	'type' => 'checkbox',
	'instructions' => 'Check to Ask for Postal',
	'choices' => array (
		'true' => 'Ask for Postal',
	),
	'default_value' => '',
);
$sp_actionkit_postal_label = array (
	'key' => 'field_549704ed2d916a',
	'label' => 'Translate "Postal" Label',
	'name' => 'sp-actionkit-postal-label',
	'type' => 'text',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_549704ed2d9100',
				'operator' => '==',
				'value' => 'true',
			),
		),
		'allorany' => 'all',
	),
	'instructions' => '',
	'column_width' => '',
	'default_value' => 'Postal',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_actionkit_zip = array (
	'key' => 'field_549704ed2d917',
	'label' => 'Zip',
	'name' => 'sp-actionkit-zip',
	'type' => 'checkbox',
	'instructions' => 'Check to Ask for Zip (U.S)',
	'choices' => array (
		'true' => 'Ask for (U.S)',
	),
	'default_value' => '',
);
$sp_actionkit_zip_label = array (
	'key' => 'field_549704ed2d917a',
	'label' => 'Translate "ZIP" Label',
	'name' => 'sp-actionkit-zip-label',
	'type' => 'text',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_549704ed2d9100',
				'operator' => '==',
				'value' => 'true',
			),
		),
		'allorany' => 'all',
	),
	'instructions' => '',
	'column_width' => '',
	'default_value' => 'ZIP',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_actionkit_phone = array (
	'key' => 'field_549704ed2d918',
	'label' => 'Phone',
	'name' => 'sp-actionkit-phone',
	'type' => 'checkbox',
	'instructions' => 'Check to Ask for Phone',
	'choices' => array (
		'true' => 'Ask for Phone',
	),
	'default_value' => '',
);
$sp_actionkit_phone_label = array (
	'key' => 'field_549704ed2d918a',
	'label' => 'Translate "Phone" Label',
	'name' => 'sp-actionkit-phone-label',
	'type' => 'text',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_549704ed2d9100',
				'operator' => '==',
				'value' => 'true',
			),
		),
		'allorany' => 'all',
	),
	'instructions' => '',
	'column_width' => '',
	'default_value' => 'Phone',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_actionkit_country = array (
	'key' => 'field_549704ed2d919',
	'label' => 'Country',
	'name' => 'sp-actionkit-country',
	'type' => 'checkbox',
	'instructions' => 'Check to Ask for Country',
	'choices' => array (
		'true' => 'Ask for Country',
	),
	'default_value' => 'true',	
);
$sp_actionkit_country_label = array (
	'key' => 'field_549704ed2d919a',
	'label' => 'Translate "Country" Label',
	'name' => 'sp-actionkit-country-label',
	'type' => 'text',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_549704ed2d9100',
				'operator' => '==',
				'value' => 'true',
			),
		),
		'allorany' => 'all',
	),
	'instructions' => '',
	'column_width' => '',
	'default_value' => 'Country',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_actionkit_horizontal = array (
	'key' => 'field_549704ed2d920',
	'label' => 'Form Orientation',
	'name' => 'sp-actionkit-horizontal',
	'type' => 'checkbox',
	'instructions' => 'Check to Make Form Horizontal',
	'choices' => array (
		'true' => 'Check to Make Form Horizontal',
	),
	'default_value' => '',
);

$sp_default_bg_choice_key = 'field_5474d5edc0b0a';
$sp_default_bg_key = 'field_5474d5edc0b99';

$sp_adv_opt = array (
	'key' => 'field_5496fea74a333',
	'label' => 'Show Advanced Options',
	'name' => 'sp-show-advanced-options',
	'type' => 'true_false',
	'column_width' => '',
	'message' => '',
	'default_value' => 0,
);
$sp_bg_color = array (
	'key' => 'field_5496fecd4a333',
	'label' => 'Background Color',
	'name' => 'sp-bg-color',
	'type' => 'select',
	'column_width' => '',
	'choices' => $sp_colors,
	'default_value' => 'white',
	'allow_null' => 0,
	'multiple' => 0,
);
$sp_bg_img = array (
	'key' => 'field_549704ed2d333',
	'label' => 'Background Image',
	'name' => 'sp-bg-image',
	'type' => 'image',
	'column_width' => '',
	'save_format' => 'id',
	'preview_size' => 'medium',
	'library' => 'all',
);
$sp_bg_img_credit = array (
	'key' => 'field_549704ed2d195',
	'label' => 'Image Credit/source',
	'name' => 'sp-bg-image-credit',
	'type' => 'text',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_5496fea74a333',
				'operator' => '==',
				'value' => '1',
			),
		),
		'allorany' => 'all',
	),
	'instructions' => 'Optional.',
	'column_width' => '',
	'default_value' => '',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_bg_img_credit_url = array (
	'key' => 'field_549704ed2d134',
	'label' => 'Image Credit/source URL',
	'name' => 'sp-bg-image-credit-url',
	'type' => 'text',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_5496fea74a333',
				'operator' => '==',
				'value' => '1',
			),
		),
		'allorany' => 'all',
	),
	'instructions' => 'Optional.',
	'column_width' => '',
	'default_value' => '',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);
$sp_bg_img_size = array (
	'key' => 'field_5496ff614ae00',
	'label' => 'Background Size',
	'name' => 'sp-bg-image-size',
	'type' => 'select',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_5496fea74a333',
				'operator' => '==',
				'value' => '1',
			),
		),
		'allorany' => 'all',
	),
	'column_width' => '',
	'choices' => array (
		'cover' => 'Cover',
		'full-width' => 'Full width, auto height',
		'normal' => 'No Resizing (as uploaded)',
	),
	'default_value' => 'cover',
	'allow_null' => 0,
	'multiple' => 0,
);
$sp_bg_img_attach = array (
	'key' => 'field_5496ff614ae10',
	'label' => 'Background Attachment',
	'name' => 'sp-bg-image-attach',
	'type' => 'select',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_5496fea74a333',
				'operator' => '==',
				'value' => '1',
			),
		),
		'allorany' => 'all',
	),
	'column_width' => '',
	'choices' => array (
		'scroll' => 'Normal',
		'fixed' => 'Fixed',
		'parallax' => 'Parallax'
	),
	'default_value' => 'scroll',
	'allow_null' => 0,
	'multiple' => 0,
);
$sp_bg_img_repeat = array (
	'key' => 'field_5496ff614ff99',
	'label' => 'Background Repeat',
	'name' => 'sp-bg-image-repeat',
	'type' => 'select',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_5496fea74a333',
				'operator' => '==',
				'value' => '1',
			),
		),
		'allorany' => 'all',
	),
	'column_width' => '',
	'choices' => array (
		'none' => 'None',
		'x' => 'Repeat Horizontally',
		'y' => 'Repeat Vertically',
		'both' => 'Repeat Both',
	),
	'default_value' => 'none',
	'allow_null' => 0,
	'multiple' => 0,
);
$sp_width = array (
	'key' => 'field_5496ff614a333',
	'label' => 'Width',
	'name' => 'sp-width',
	'type' => 'select',
	'column_width' => '',
	'choices' => array (
		'narrow' => 'Narrow',
		'normal' => 'Normal',
		'wide' => 'Wide',
		'full' => 'Full-width',
	),
	'default_value' => 'normal',
	'allow_null' => 0,
	'multiple' => 0,
);
$sp_margins = array (
	'key' => 'field_549702784a333',
	'label' => 'Margins',
	'name' => 'sp-padding',
	'type' => 'select',
	'column_width' => '',
	'choices' => array (
		'none' => 'None',
		'small' => 'Small',
		'medium' => 'Medium',
		'large' => 'Large',
		'huge' => 'Huge',
		'gigantic' => 'Gigantic',
	),
	'default_value' => 'medium',
	'allow_null' => 0,
	'multiple' => 0,
);
$sp_notch = array (
	'key' => 'field_549702895a444',
	'label' => 'Add Top Notch',
	'name' => 'sp-notch',
	'type' => 'true_false',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_5496fea74a333',
				'operator' => '==',
				'value' => '1',
			),
		),
		'allorany' => 'all',
	),
	'column_width' => '',
	'message' => '',
	'default_value' => 0,
);
$sp_id = array (
	'key' => 'field_54970b9a2d717',
	'label' => 'ID',
	'name' => 'sp-id',
	'type' => 'text',
	'conditional_logic' => array (
		'status' => 1,
		'rules' => array (
			array (
				'field' => 'field_5496fea74a333',
				'operator' => '==',
				'value' => '1',
			),
		),
		'allorany' => 'all',
	),
	'instructions' => 'for CSS and anchor linking.',
	'column_width' => '',
	'default_value' => '',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'formatting' => 'html',
	'maxlength' => '',
);


// Add ACF custom fields for editing Superpages
if ( function_exists( "register_field_group" ) )
{
	register_field_group(array (
		'id' => 'acf_superpages-plugin',
		'title' => 'Superpages',
		'fields' => array (
			array (
				'key' => 'field_5474d5edc0333',
				'label' => 'Show site header',
				'name' => 'sp-show-header',
				'type' => 'checkbox',
				'instructions' => 'Check to show the site\'s header, leave unchecked to hide it.',
				'choices' => array (
					'true' => 'Show Header',
				),
				'default_value' => '',
				'layout' => 'vertical',
			),
			array (
				'key' => $sp_default_bg_choice_key,
				'label' => 'Page Background',
				'name' => 'sp_default_bg_choice',
				'type' => 'radio',
				'instructions' => 'Optional: Background for the entire superpage. Does not affect section backgrounds.',
				'choices' => array (
					'none' => 'None',
					'custom' => 'Upload an image',
					'default' => 'Site default background',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'none',
				'layout' => 'vertical',
			),
			array (
				'key' => $sp_default_bg_key,
				'label' => 'Page Background Image',
				'name' => 'sp_default_bg',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => $sp_default_bg_choice_key,
							'operator' => '==',
							'value' => 'custom',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_539b2819ed333',
				'label' => 'Sections',
				'name' => 'sp-sections',
				'type' => 'flexible_content',
				'required' => 1,
				'layouts' => array (
					array (
						'label' => 'Text/HTML',
						'name' => 'sp-section-texthtml',
						'display' => 'row',
						'min' => '',
						'max' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_539b288ded333',
								'label' => 'Content',
								'name' => 'sp-section-content',
								'type' => 'wysiwyg',
								'column_width' => '',
								'default_value' => '',
								'toolbar' => 'full',
								'media_upload' => 'yes',
							),
							$sp_adv_opt,
							$sp_bg_color,
							$sp_bg_img,
							$sp_bg_img_credit,
							$sp_bg_img_credit_url,
							$sp_bg_img_size,
							$sp_bg_img_attach,
							$sp_bg_img_repeat,
							$sp_width,
							$sp_margins,
							$sp_notch,
							$sp_id,
						),
					),
					array (
						'label' => 'Code',
						'name' => 'sp-section-code',
						'display' => 'row',
						'min' => '',
						'max' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_539b29874c333',
								'label' => 'Code',
								'name' => 'sp-section-content',
								'type' => 'textarea',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'maxlength' => '',
								'rows' => '',
								'formatting' => 'html',
							),
							$sp_adv_opt,
							$sp_bg_color,
							$sp_bg_img,
							$sp_bg_img_credit,
							$sp_bg_img_credit_url,
							$sp_bg_img_size,
							$sp_bg_img_attach,
							$sp_bg_img_repeat,
							$sp_width,
							$sp_margins,
							$sp_notch,
							$sp_id,
						),
					),
					array (
						'label' => 'ActionKit',
						'name' => 'sp-section-actionkit',
						'display' => 'row',
						'min' => '',
						'max' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_539b29874c444',
								'label' => 'ActionKit Page Shortname (required)',
								'name' => 'sp-section-actionkit',
								'type' => 'text',
								'instructions' => 'Controls which ActionKit page data is submitted to.',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'maxlength' => '',
								'rows' => '',
								'formatting' => 'html',
							),
							$sp_actionkit_title,
							$sp_actionkit_intro,
							$sp_actionkit_translate,
							$sp_actionkit_name,
							$sp_actionkit_name_label,
							$sp_actionkit_email,
							$sp_actionkit_email_label,
							$sp_actionkit_city,
							$sp_actionkit_city_label,
							$sp_actionkit_postal,
							$sp_actionkit_postal_label,
							$sp_actionkit_zip,
							$sp_actionkit_zip_label,
							$sp_actionkit_phone,
							$sp_actionkit_phone_label,
							$sp_actionkit_country,
							$sp_actionkit_country_label,
							$sp_actionkit_horizontal,
							$sp_actionkit_submit,
							$sp_actionkit_confirmation,
							$sp_actionkit_custom,
							$sp_adv_opt,
							$sp_bg_color,
							$sp_bg_img,
							$sp_bg_img_credit,
							$sp_bg_img_credit_url,
							$sp_bg_img_size,
							$sp_bg_img_attach,
							$sp_bg_img_repeat,
							$sp_width,
							$sp_margins,
							$sp_notch,
							$sp_id,
						),
					),					
					array (
						'label' => 'Blog Posts',
						'name' => 'sp-section-posts',
						'display' => 'row',
						'min' => '',
						'max' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_53cf04a000333',
								'label' => 'Number of posts to display',
								'name' => 'sp-posts-num',
								'type' => 'number',
								'column_width' => '',
								'default_value' => 5,
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'min' => 1,
								'max' => 20,
								'step' => 1,
							),
							array (
								'key' => 'field_53cf059d00333',
								'label' => 'Category (Optional)',
								'name' => 'sp-posts-cat',
								'type' => 'text',
								'instructions' => 'Optionally filter posts by category. Enter a category "slug" (the all-lowercase, URL-friendly category name). Leave blank to include posts from all categories.',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
							array (
								'key' => 'field_53cf09d3f8333',
								'label' => 'Section Title',
								'name' => 'sp-section-title',
								'type' => 'text',
								'instructions' => 'A label that appears above the posts. "Latest Updates" or "News", etc.',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							$sp_adv_opt,
							$sp_bg_color,
							$sp_bg_img,
							$sp_bg_img_credit,
							$sp_bg_img_credit_url,
							$sp_bg_img_size,
							$sp_bg_img_attach,
							$sp_bg_img_repeat,
							$sp_width,
							$sp_margins,
							$sp_notch,
							$sp_id,
						),
					),
					array (
						'label' => 'Nav Bar',
						'name' => 'sp-section-nav',
						'display' => 'row',
						'min' => '',
						'max' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_539b29a64c333',
								'label' => 'Menu Name',
								'name' => 'sp-section-navslug',
								'type' => 'text',
								'instructions' => 'The name of the menu you wish to include. See \'Menus\' under \'Appearance\' to make a menu.',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							$sp_adv_opt,
							$sp_bg_color,
							$sp_bg_img,
							$sp_bg_img_credit,
							$sp_bg_img_credit_url,
							$sp_bg_img_size,
							$sp_bg_img_attach,
							$sp_bg_img_repeat,
							$sp_width,
							$sp_margins,
							$sp_notch,
							$sp_id,
						),
					),
					array (
						'label' => 'Image Grid',
						'name' => 'sp-section-grid',
						'display' => 'row',
						'min' => '',
						'max' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_542324c96b333',
								'label' => 'Images',
								'name' => 'grid-square',
								'type' => 'repeater',
								'sub_fields' => array (
									array (
										'key' => 'field_542325156c333',
										'label' => 'Image',
										'name' => 'grid-square-img',
										'type' => 'image',
										'instructions' => '400px square. If larger, the image will be cropped down to that size.',
										'column_width' => '',
										'save_format' => 'id',
										'preview_size' => 'thumbnail-square',
										'library' => 'all',
									),
									array (
										'key' => 'field_5423257b6b333',
										'label' => 'Title',
										'name' => 'grid-square-title',
										'type' => 'text',
										'instructions' => '(1-3 words)',
										'column_width' => '',
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									),
									array (
										'key' => 'field_542325b46b333',
										'label' => 'Link',
										'name' => 'grid-square-link',
										'type' => 'text',
										'instructions' => '',
										'column_width' => '',
										'default_value' => '',
										'placeholder' => 'http://www.example.com (Optional)',
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									),
								),
								'row_min' => '',
								'row_limit' => '',
								'layout' => 'row',
								'button_label' => 'Add Image',
							),
							array (
								'key' => 'field_5423344b5f333',
								'label' => 'Columns',
								'name' => 'grid-square-columns',
								'type' => 'radio',
								'instructions' => 'Only applies at desktop browser widths.',
								'column_width' => '',
								'choices' => array (
									'c5' => 2,
									'c3_3' => 3,
									'c2_5' => 4,
									'c2' => 5,
								),
								'other_choice' => 0,
								'save_other_choice' => 0,
								'default_value' => 'c2_5',
								'default_value' => '',
								'layout' => 'horizontal',
							),
							$sp_adv_opt,
							$sp_bg_color,
							$sp_bg_img,
							$sp_bg_img_credit,
							$sp_bg_img_credit_url,
							$sp_bg_img_size,
							$sp_bg_img_attach,
							$sp_bg_img_repeat,
							$sp_width,
							$sp_margins,
							$sp_notch,
							$sp_id,
						),
					),
					/* array (
						'label' => 'Ticker',
						'name' => 'sp-section-ticker',
						'display' => 'row',
						'min' => '',
						'max' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_539b29a64c444',
								'label' => 'Ticker ID',
								'name' => 'sp-ticker-id',
								'type' => 'text',
								'instructions' => 'The 4-digit ID of the ticker to include',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							$sp_adv_opt,
							$sp_bg_color,
							$sp_bg_img,
							$sp_bg_img_credit,
							$sp_bg_img_credit_url,
							$sp_bg_img_size,
							$sp_bg_img_attach,
							$sp_bg_img_repeat,
							$sp_width,
							$sp_margins,
							$sp_id,
						),
					),*/
				),
				'button_label' => 'Add Row',
				'min' => '',
				'max' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'super_pages',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));
}