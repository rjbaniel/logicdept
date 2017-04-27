<?php
/**
 * Logic Department Theme Customizer.
 *
 * @package Logic_Department
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function logic_department_customize_register( $wp_customize ) {
	// We don't need these sections for this site
	$wp_customize->remove_section( 'colors' );
	//$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'widgets' );

	// Instant updates!
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Front Page options
	$wp_customize->add_setting( 'logic_department__front_page_statement', array(
		'type' => 'theme_mod',
	) );
	$wp_customize->add_control( 'logic_department__front_page_statement', array(
		'type' => 'textarea',
		'priority' => 10,
		'section' => 'front-page-options',
		'label' => __( 'Front Page Statement', 'logic-department' ),
		'active_callback' => 'is_front_page',
	) );
	$wp_customize->add_setting( 'logic_department__front_page_logo', array(
		'type' => 'theme_mod',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'logic_department__front_page_logo',
		array(
			'label' => esc_html__( 'Upload a logo file for the front page', 'logic-department' ),
			'section' => 'front-page-options',
			'logic_department__front_page_logo',
			'is_front_page',
		)
	) );

	for( $i = 0; $i < 4; $i++ ) {
		$image_num = $i;
		$image_num_display = $i + 1;
		$wp_customize->add_setting( 'logic_department__home-image-' . $image_num, array(
			'type' => 'theme_mod'
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'logic_department__home-image-' . $image_num,
			array(
				'label' => esc_html__( 'Upload for position ' . $image_num_display . ' on the homepage' , 'logic-department' ),
				'section' => 'front-page-options',
				'logic_department__home-image-' . $image_num,
			)
		) );
	}
	$wp_customize->add_section( 'front-page-options', array(
		'title' => esc_html__( 'Front Page Options', 'logic-department' ),
	) );

	// Services page options
	$services = get_categories( array( 'taxonomy' => 'service' ) );
	foreach( $services as $service ) {
		$service_name = $service->name;
		$wp_customize->add_setting( 'logic_department__service-' . $service_name . '-image', array(
			'type' => 'theme_mod',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'logic_department__service-' . $service_name . '-image',
			array(
				'label' => esc_html__( 'Upload an image for the "' . $service_name . '" service' , 'logic-department' ),
				'section' => 'services-page-options',
				'logic_department__service-' . $service_name . '-image',
			)
		) );
	}
	$wp_customize->add_section( 'services-page-options', array(
		'title' => esc_html__( 'Services Page Options', 'logic-department' ),
	) );


	// Case Studies options
	$wp_customize->add_setting( 'logic_department__case_studies_title', array(
		'type' => 'theme_mod',
	) );
	$wp_customize->add_control( 'logic_department__case_studies_title', array(
		'type' => 'text',
		'priority' => 5,
		'section' => 'case-studies-options',
		'label' => __( 'Title for Case Studies page', 'logic-department' ),
	) );
	$wp_customize->add_setting( 'logic_department__case_studies_description', array(
		'type' => 'theme_mod',
	) );
	$wp_customize->add_control( 'logic_department__case_studies_description', array(
		'type' => 'textarea',
		'priority' => 10,
		'section' => 'case-studies-options',
		'label' => __( 'Text for top of Case Studies page', 'logic-department' ),
	) );
	$wp_customize->add_section( 'case-studies-options', array(
		'title' => esc_html__( 'Case Studies Options', 'logic-department' ),
	) );

	// Contact Page settings
	$wp_customize->add_setting( 'logic_department__contact_logo', array(
		'type' => 'theme_mod',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'logic_department__contact_logo',
		array(
			'label' => esc_html__( 'Upload a logo file for the contact page', 'logic-department' ),
			'section' => 'contact-page-options',
			'logic_department__contact_logo',
		)
	) );

	$wp_customize->add_setting( 'logic_department__linked_in_link', array(
		'type' => 'theme_mod',
	) );
	$wp_customize->add_control( 'logic_department__linked_in_link', array(
		'type' => 'textfield',
		'priority' => 10,
		'section' => 'contact-page-options',
		'label' => __( 'Full link to your LinkedIn account', 'logic-department' ),
	) );

	$wp_customize->add_setting( 'logic_department__twitter_link', array(
		'type' => 'theme_mod',
	) );
	$wp_customize->add_control( 'logic_department__twitter_link', array(
		'type' => 'textfield',
		'priority' => 10,
		'section' => 'contact-page-options',
		'label' => __( 'Full link to your Twiter account', 'logic-department' ),
	) );
	$wp_customize->add_section( 'contact-page-options', array(
		'title' => esc_html__( 'Contact Page Options', 'logic-department' ),
	) );
}
add_action( 'customize_register', 'logic_department_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function logic_department_customize_preview_js() {
	wp_enqueue_script( 'logic_department_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'logic_department_customize_preview_js' );
