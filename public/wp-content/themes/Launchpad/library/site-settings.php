<?php
/**
 * Created by PhpStorm.
 * User: franz
 * Date: 2017-08-05
 * Time: 3:50 PM
 */
class SiteSettings {

    public function __construct() {

        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'init_settings'  ) );

    }

    public function add_admin_menu() {

        add_options_page(
            esc_html__( 'Site Settings', 'leadeight' ),
            esc_html__( 'Site Settings', 'leadeight' ),
            'manage_options',
            'site_settings',
            array( $this, 'page_layout' )
        );

    }

    public function init_settings() {

        register_setting(
            'settings_group',
            'site_settings'
        );

        add_settings_section(
            'site_settings_section',
            '',
            false,
            'site_settings'
        );

        add_settings_field(
            'phone_number',
            __( 'Phone Number', 'leadeight' ),
            array( $this, 'render_phone_number_field' ),
            'site_settings',
            'site_settings_section'
        );
        add_settings_field(
            'header_scripts',
            __( 'Header Scripts', 'leadeight' ),
            array( $this, 'render_header_scripts_field' ),
            'site_settings',
            'site_settings_section'
        );
        add_settings_field(
            'after_body_scripts',
            __( 'After Body Scripts', 'leadeight' ),
            array( $this, 'render_after_body_scripts_field' ),
            'site_settings',
            'site_settings_section'
        );
        add_settings_field(
            'footer_scripts',
            __( 'Footer Scripts', 'leadeight' ),
            array( $this, 'render_footer_scripts_field' ),
            'site_settings',
            'site_settings_section'
        );
        add_settings_field(
            'logo_url',
            __( 'Logo URL', 'leadeight' ),
            array( $this, 'render_logo_url_field' ),
            'site_settings',
            'site_settings_section'
        );

    }

    public function page_layout() {

        // Check required user capability
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'leadeight' ) );
        }

        // Admin Page Layout
        echo '<div class="wrap">' . "\n";
        echo '	<h1>' . get_admin_page_title() . '</h1>' . "\n";
        echo '	<form action="options.php" method="post">' . "\n";

        settings_fields( 'settings_group' );
        do_settings_sections( 'site_settings' );
        submit_button();

        echo '	</form>' . "\n";
        echo '</div>' . "\n";

    }

    function render_phone_number_field() {

        // Retrieve data from the database.
        $options = get_option( 'site_settings' );

        // Set default value.
        $value = isset( $options['phone_number'] ) ? $options['phone_number'] : '';

        // Field output.
        echo '<input type="text" name="site_settings[phone_number]" class="regular-text phone_number_field" placeholder="' . esc_attr__( 'Phone Number', 'leadeight' ) . '" value="' . esc_attr( $value ) . '">';
        echo '<p class="description">' . __( 'Enter the global phone number you would like to use for the site', 'leadeight' ) . '</p>';

    }

    function render_header_scripts_field() {

        // Retrieve data from the database.
        $options = get_option( 'site_settings' );

        // Set default value.
        $value = isset( $options['header_scripts'] ) ? $options['header_scripts'] : '';

        // Field output.
        echo '<textarea name="site_settings[header_scripts]" class="regular-text header_scripts_field" placeholder="' . esc_attr__( '', 'leadeight' ) . '">' . $value . '</textarea>';
        echo '<p class="description">' . __( 'Scripts that run at wp_head', 'leadeight' ) . '</p>';

    }

    function render_after_body_scripts_field() {

        // Retrieve data from the database.
        $options = get_option( 'site_settings' );

        // Set default value.
        $value = isset( $options['after_body_scripts'] ) ? $options['after_body_scripts'] : '';

        // Field output.
        echo '<textarea name="site_settings[after_body_scripts]" class="regular-text after_body_scripts_field" placeholder="' . esc_attr__( '', 'leadeight' ) . '">' . $value . '</textarea>';
        echo '<p class="description">' . __( 'Scripts that are run right after body', 'leadeight' ) . '</p>';

    }

    function render_footer_scripts_field() {

        // Retrieve data from the database.
        $options = get_option( 'site_settings' );

        // Set default value.
        $value = isset( $options['footer_scripts'] ) ? $options['footer_scripts'] : '';

        // Field output.
        echo '<textarea name="site_settings[footer_scripts]" class="regular-text footer_scripts_field" placeholder="' . esc_attr__( '', 'leadeight' ) . '">' . $value . '</textarea>';

    }

    function render_logo_url_field() {

        // Retrieve data from the database.
        $options = get_option( 'site_settings' );

        // Set default value.
        $value = isset( $options['logo_url'] ) ? $options['logo_url'] : '';

        // Field output.
        echo '<input type="text" name="site_settings[logo_url]" class="regular-text logo_url_field" placeholder="' . esc_attr__( '', 'leadeight' ) . '" value="' . esc_attr( $value ) . '">';
        echo '<p class="description">' . __( 'Relative to the theme file.', 'leadeight' ) . '</p>';

    }

}

new SiteSettings;

/*
 * Retrieve this value with:
 * $site_settings_options = get_option( 'site_settings' ); // Array of All Options
 * $phone_number = $site_settings_options['phone_number']; // Phone Number
 * $header_scripts = $site_settings_options['header_scripts']; // Header Scripts
 * $after_body_scripts = $site_settings_options['after_body_scripts']; // After Body Scripts
 * $footer_scripts = $site_settings_options['footer_scripts']; // Footer Scripts
 * $logo_url = $site_settings_options['logo_url']; // Logo
 */

/*
 *
 * Run Scripts on Page Locations
 *
 */
add_action('wp_head', 'render_header_scripts');
function render_header_scripts() {
    $site_settings_options = get_option( 'site_settings_option_name' );
    echo $site_settings_options['header_scripts'];
}
/*
 *
 * Phone Number Shortcode
 *
 */
add_shortcode('phone-number', 'phone_number_render');
function phone_number_render($atts) {
    // Get Page Settings
    $site_settings_options = get_option( 'site_settings_option_name' );
    $atts = shortcode_atts( array(
        'phone' => $site_settings_options['phone_number'],
        'link'  => true,
        'icon'  => 'fa-phone',
        'class' => 'animate',
    ), $atts, 'phone-number' );


    // Phone Number
    $phone_number = $atts['phone'];
    // Add Icon if exists
    if (isset($atts['icon'])) {
        $phone_number = '<i class="fa '.$atts["icon"].'"></i> '.$phone_number;
    }
    // Adds a link if necessary
    if ($atts['link'] == true) {
        $phone_number = '<a class="phone-number '.$atts['class'].'" href="tel:'.$site_settings_options['phone_number'].'">'.$phone_number.'</a>';
    }
    return $phone_number;
}

/*
 *
 * Year Shortcode
 *
 */
add_shortcode('year', 'year_render');
function year_render() {
    return date("Y");
}

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');


/*
 *
 * Add Image Sizes for Featured Images
 * FoundationPress Settings:
 *   small: 0,
  medium: 640px,
  large: 1024px,
  xlarge: 1200px,
  xxlarge: 1440px,
 */
//add_image_size('hero-small', '640', '650', array('left', 'top'));
//add_image_size('hero-medium', '1024', '650', array('left', 'top'));
//add_image_size('hero-large', '1200', '650', array('left', 'top'));
//add_image_size('hero-xlarge', '1600', '650', array('left', 'top'));