<?php
add_action( 'customize_register', '_wp_theme_settings' );
function _wp_theme_settings( $wp_customize ){
	// SITE LOGO
	$wp_customize->add_setting( 'site_logo', array(
		'default'    => '',
		'capability' => 'edit_theme_options'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo', array(
		'label'       => 'Site Logo',
		'section'     => 'title_tagline', // site identity section
		'settings'    => 'site_logo',
		'description' => ''
	) ) );

	// PLACEHOLDER
	$wp_customize->add_setting( 'placeholder_img', array(
		'default'    => '',
		'capability' => 'edit_theme_options'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'placeholder_img', array(
		'label'       => 'Placeholder',
		'section'     => 'title_tagline', // site identity section
		'settings'    => 'placeholder_img',
		'description' => ''
	) ) );


	// CUSTOM JAVASCRIPT
	$wp_customize->add_section( 'custom_js_section' , array(
	    'title' => __( 'Additional Javascript', 'mytheme' )
	) );
	$wp_customize->add_setting( 'custom_js' , array(
        'default'    => '',
        'capability' => 'edit_theme_options'
    ) );
    $wp_customize->add_control( 'custom_js', array(
    	'label'       => '',
    	'type'        => 'textarea',
    	'section'     => 'custom_js_section',
    	'description' => 'Insert your custom javascript codes here.'
    ) );

	// ARCHIVE SETTINGS
	$wp_customize->add_section( 'archive_settings_section' , array(
	    'title' => 'Archive & Category Options'
	) );
	$wp_customize->add_setting( 'archive_settings' , array(
        'default'    => '',
        'capability' => 'edit_theme_options'
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'archive_settings', array(
		'label'       => 'Background Image',
		'section'     => 'archive_settings_section', // site identity section
		'settings'    => 'archive_settings',
		'description' => 'Background image for archive, 404, search and category templates.'
	) ) );
}