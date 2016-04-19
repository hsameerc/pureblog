<?php
/**
 * pureblog Theme Customizer
 *
 * @package WordPress
 * @subpackage Pureblog
 * @since Pureblog 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pureblog_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'pureblog_customize_register' );


/**
 * Options for Pureblog Theme Customizer.
 */
function pureblog_customizer( $wp_customize ) {
// logo
    $wp_customize->add_setting( 'header_logo', array(
        'default' => '',
        'transport'   => 'refresh',
        'sanitize_callback' => 'pureblog_sanitize_number'
    ) );
    $wp_customize->add_control(new WP_Customize_Media_Control( $wp_customize, 'header_logo', array(
        'label' => __( 'Logo', 'pureblog' ),
        'section' => 'title_tagline',
        'mime_type' => 'image',
        'priority'  => 10,
    ) ) );


    global $header_show;
    $wp_customize->add_setting('header_show', array(
        'default' => 'logo-text',
        'sanitize_callback' => 'pureblog_sanitize_radio_header'
    ));
    $wp_customize->add_control('header_show', array(
        'type' => 'radio',
        'label' => __('Show', 'pureblog'),
        'section' => 'title_tagline',
        'choices' => $header_show
    ));
    $wp_customize->add_panel('pureblog_main_options', array(
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Pureblog Settings', 'pureblog'),
        'description' => __('Panel to update pureblog theme options', 'pureblog'), // Include html tags such as <p>.
        'priority' => 10 // Mixed with top-level-section hierarchy.
    ));
    // Add Sections in Main Panel
    $wp_customize->add_section( 'pureblog_general_section' , array(
        'title'      => esc_html__( 'General Settings', 'pureblog' ),
        'priority'   => 10,
        'panel' => 'pureblog_main_options'
    ) );
    $wp_customize->add_section( 'pureblog_styling_section' , array(
        'title'      => esc_html__( 'Styling Settings', 'pureblog' ),
        'priority'   => 20,
        'panel' => 'pureblog_main_options'
    ) );
    $wp_customize->add_section( 'pureblog_social_section' , array(
        'title'      => esc_html__( 'Social Settings', 'pureblog' ),
        'priority'   => 30,
        'panel' => 'pureblog_main_options'
    ) );
    $wp_customize->add_section( 'pureblog_contact_section' , array(
        'title'      => esc_html__( 'Contact Settings', 'pureblog' ),
        'priority'   => 50,
        'panel' => 'pureblog_main_options'
    ) );
    $wp_customize->add_section( 'pureblog_footer_section' , array(
        'title'      => esc_html__( 'Footer Settings', 'pureblog' ),
        'priority'   => 50,
        'panel' => 'pureblog_main_options'
    ) );


    // Pureblog Main Options
    $wp_customize->add_setting( 'pureblog_excerpts', array(
        'default'           => 1,
        'sanitize_callback' => 'pureblog_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'pureblog_excerpts', array(
        'label'     => esc_html__( 'Show post excerpts?', 'pureblog' ),
        'section'   => 'pureblog_general_section',
        'priority'  => 10,
        'type'      => 'checkbox'
    ) );

    $wp_customize->add_setting( 'pureblog_page_comments', array(
        'default' => 1,
        'sanitize_callback' => 'pureblog_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'pureblog_page_comments', array(
        'label'		=> esc_html__( 'Display Comments on Static Pages?', 'pureblog' ),
        'section'	=> 'pureblog_general_section',
        'priority'	=> 20,
        'type'      => 'checkbox',
    ) );

    /* pureblog Styling Options */
    $wp_customize->add_setting( 'site_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'pureblog_sanitize_hexcolor',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_color', array(
        'label' => __( 'Site Color', 'pureblog' ),
        'section' => 'pureblog_styling_section',
    ) ) );

    $wp_customize->add_setting( 'link_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'pureblog_sanitize_hexcolor',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
        'label' => __( 'Link Color', 'pureblog' ),
        'section' => 'pureblog_styling_section',
    ) ) );
    $wp_customize->add_setting( 'link_hover_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'pureblog_sanitize_hexcolor',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
        'label' => __( 'Link Hover Color', 'pureblog' ),
        'section' => 'pureblog_styling_section',
    ) ) );

    $wp_customize->add_setting('custom_css', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ));
    $wp_customize->add_control('custom_css', array(
        'label' => __('Custom CSS', 'pureblog'),
        'description' => sprintf(__('Additional CSS', 'pureblog')),
        'section' => 'pureblog_styling_section',
        'type' => 'textarea'
    ));

    // Pureblog Footer Section Options
    $wp_customize->add_setting( 'pureblog_footer_copyright', array(
        'default' => '',
        'transport'   => 'refresh',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ) );
    $wp_customize->add_control( 'pureblog_footer_copyright', array(
        'label' => 'Copyright Text',
        'section' => 'pureblog_footer_section',
        'description' => sprintf(__('Copyright text that appears in footer.', 'pureblog')),
        'type' => 'textarea',
    ) );
    $wp_customize->add_setting( 'pureblog_footer_trackingcode', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ) );
    $wp_customize->add_control( 'pureblog_footer_trackingcode', array(
        'label' => 'Google Analytics',
        'section' => 'pureblog_footer_section',
        'description' => sprintf(__('Enter Google Analytics Code here!.', 'pureblog')),
        'type' => 'textarea',
    ) );



    //Pureblog Contact Section
    $wp_customize->add_setting('pureblog_contact_phone', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ));
    $wp_customize->add_control( 'pureblog_contact_phone', array(
        'label' => 'Phone Number',
        'section' => 'pureblog_contact_section',
        'description' => sprintf(__('Your Phone Number', 'pureblog')),
        'type' => 'text',
    ) );
    $wp_customize->add_setting('pureblog_contact_fax', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ));
    $wp_customize->add_control( 'pureblog_contact_fax', array(
        'label' => 'FAX.',
        'section' => 'pureblog_contact_section',
        'description' => sprintf(__('Your FAX Number', 'pureblog')),
        'type' => 'text',
    ) );
    $wp_customize->add_setting('pureblog_contact_email', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ));
    $wp_customize->add_control( 'pureblog_contact_email', array(
        'label' => 'Email',
        'section' => 'pureblog_contact_section',
        'description' => sprintf(__('Your Email', 'pureblog')),
        'type' => 'text',
    ) );
    $wp_customize->add_setting('pureblog_contact_address', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ));
    $wp_customize->add_control( 'pureblog_contact_address', array(
        'label' => 'Address',
        'section' => 'pureblog_contact_section',
        'description' => sprintf(__('Your Address', 'pureblog')),
        'type' => 'textarea',
    ) );

    //Pureblog Social Section
    $wp_customize->add_setting('pureblog_social_facebook', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ));
    $wp_customize->add_control( 'pureblog_social_facebook', array(
        'label' => 'Facebook Url',
        'section' => 'pureblog_social_section',
        'type' => 'text',
    ) );
    $wp_customize->add_setting('pureblog_social_twitter', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ));
    $wp_customize->add_control( 'pureblog_social_twitter', array(
        'label' => 'Twitter Url.',
        'section' => 'pureblog_social_section',
        'type' => 'text',
    ) );
    $wp_customize->add_setting('pureblog_social_rssfeed', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ));
    $wp_customize->add_control( 'pureblog_social_rssfeed', array(
        'label' => 'RSS Feed URL',
        'section' => 'pureblog_social_section',
        'type' => 'text',
    ) );
    $wp_customize->add_setting('pureblog_social_linkedin', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ));
    $wp_customize->add_control( 'pureblog_social_linkedin', array(
        'label' => 'Linkedin URL',
        'section' => 'pureblog_social_section',
        'type' => 'text',
    ) );
    $wp_customize->add_setting('pureblog_social_youtube', array(
        'default' => '',
        'sanitize_callback' => 'pureblog_sanitize_strip_slashes'
    ));
    $wp_customize->add_control( 'pureblog_social_youtube', array(
        'label' => 'Youtube URL',
        'section' => 'pureblog_social_section',
        'type' => 'text',
    ) );

}
add_action( 'customize_register', 'pureblog_customizer' );

/**
 * Adds sanitization callback function: Strip Slashes
 * @package Pureblog
 */
function pureblog_sanitize_strip_slashes($input) {
    return wp_kses_stripslashes($input);
}

/**
 * Sanitzie checkbox for WordPress customizer
 */
function pureblog_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Adds sanitization callback function: Sidebar Layout
 * @package Pureblog
 */
function pureblog_sanitize_layout( $input ) {
    global $site_layout;
    if ( array_key_exists( $input, $site_layout ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: colors
 * @package Pureblog
 */
function pureblog_sanitize_hexcolor($color) {
    if ($unhashed = sanitize_hex_color_no_hash($color))
        return '#' . $unhashed;
    return $color;
}

/**
 * Adds sanitization callback function: Slider Category
 * @package Pureblog
 */
function pureblog_sanitize_slidecat( $input ) {

    if ( array_key_exists( $input, pureblog_cats()) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Radio Header
 * @package Pureblog
 */
function pureblog_sanitize_radio_header( $input ) {
    global $header_show;
    if ( array_key_exists( $input, $header_show ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Number
 * @package Pureblog
 */
function pureblog_sanitize_number($input) {
    if ( isset( $input ) && is_numeric( $input ) ) {
        return $input;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pureblog_customize_preview_js() {
    wp_enqueue_script( 'pureblog_customizer', get_template_directory_uri() . '/inc/lib/customizer.js', array( 'customize-preview' ), '20160217', true );
}
add_action( 'customize_preview_init', 'pureblog_customize_preview_js' );

/**
 * Add CSS for custom controls
 */
function pureblog_customizer_custom_control_css() {
    ?>
    <style>
        #customize-control-pureblog-main_body_typography-size select, #customize-control-pureblog-main_body_typography-face select,#customize-control-pureblog-main_body_typography-style select { width: 60%; }
    </style><?php
}
add_action( 'customize_controls_print_styles', 'pureblog_customizer_custom_control_css' );