<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       francis.li
 * @since      1.0.0
 *
 * @package    Site_Analytics
 * @subpackage Site_Analytics/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Site_Analytics
 * @subpackage Site_Analytics/admin
 * @author     Francis Li <me@francis.li>
 */
class Site_Analytics_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'site_analytics';
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Site_Analytics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Site_Analytics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/site-analytics-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Site_Analytics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Site_Analytics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/site-analytics-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Add an Options Page
	 *
	 * @since    1.0.0
	 */
	 public function add_options_page() {
	 	$this->plugin_screen_hook_suffix = add_options_page(
	 		__( 'Site Analytics Settings', 'site-analytics' ),
			__( 'Site Analytics Settings', 'site-analytics' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	 }
	 
	/**
	 * Render the Options Page
	 *
	 * @since    1.0.0
	 */
	 public function display_options_page() {
		include_once 'partials/site-analytics-admin-display.php'; 
	 }
	 
	 /**
	 * Register Settings for the Options Page
	 *
	 * @since    1.0.0
	 */
	 public function register_setting() {
		 /*
		 * Create the Settings Sections
		 */
		 // Add Settings section
		add_settings_section(
			$this->option_name . '_setup',
			__( 'Setup', 'site-analytics' ),
			array( $this, $this->option_name . '_section_callback' ),
			$this->plugin_name
		);
		 // Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'site-analytics' ),
			array( $this, $this->option_name . '_section_callback' ),
			$this->plugin_name
		);
		// Form Sections
		add_settings_section(
			$this->option_name . '_forms',
			__( 'Forms', 'site-analytics' ),
			array( $this, $this->option_name . '_section_callback' ),
			$this->plugin_name
		);
		// Ecommerce Section
		add_settings_section(
			$this->option_name . '_ecommerce',
			__( 'Ecommerce', 'site-analytics' ),
			array( $this, $this->option_name . '_section_callback' ),
			$this->plugin_name
		);
		
		/*
		*	Create Settings Fields
		*/
		$fields = array(
			array(
				'uid' => '_after_body_installed',
				'label' => 'After Body Tag',
				'section' => '_setup',
				'type' => 'checkbox',
				'options' => false,
				'placeholder' => '',
				'helper' => 'Yes, the hook has been installed.',
				'supplemental' => "If checked, you claim that you have manually installed the <strong>&lt;?php do_action('site_analytics_after_body'); ?&gt;</strong> hook into the theme's header file right after the &lt;body&gt; tag",
				'default' => 0
			),
			array(
				'uid' => '_ga_id',
				'label' => 'Google Analytics',
				'section' => '_setup',
				'type' => 'text',
				'options' => false,
				'placeholder' => 'UA-XXXXXXXX-X',
				'helper' => '',
				'supplemental' => 'Google Analytics > Admin > Property > Tracking Info > Tracking Code',
				'default' => ''
			),
			array(
				'uid' => '_ga_enable',
				'label' => 'Install Google Analytics',
				'section' => '_setup',
				'type' => 'checkbox',
				'options' => false,
				'placeholder' => '',
				'helper' => 'Run Google Analytics Script?',
				'supplemental' => 'If checked, the Google Analytics Script will be fired on the page.',
				'default' => 0
			),
			array(
				'uid' => '_gtm_id',
				'label' => 'Google Tag Manager',
				'section' => '_setup',
				'type' => 'text',
				'options' => false,
				'placeholder' => 'GTM-XXXXXXX',
				'helper' => '',
				'supplemental' => 'Google Tag Manager > Container',
				'default' => ''
			),
			array(
				'uid' => '_gtm_enable',
				'label' => 'Install Google Tag Manager',
				'section' => '_setup',
				'type' => 'checkbox',
				'options' => false,
				'placeholder' => '',
				'helper' => 'Run Google Tag Manager Script?',
				'supplemental' => "If checked, the Google Tag Manager Script will be fired on the page.",
				'default' => 0
			),
			array(
				'uid' => '_header_scripts',
				'label' => 'Header Scripts',
				'section' => '_general',
				'type' => 'textarea',
				'options' => false,
				'placeholder' => '',
				'helper' => '',
				'supplemental' => "These scripts will run inside the &lt;head&gt; tag and after Google Analytics and Google Tag Manager",
				'default' => ''
			),
			array(
				'uid' => '_after_body_scripts',
				'label' => 'After Body Scripts',
				'section' => '_general',
				'type' => 'textarea',
				'options' => false,
				'placeholder' => '',
				'helper' => '',
				'supplemental' => "These scripts will run after the &lt;body&gt; and after Google Tag Manager's &lt;noscript&gt; code",
				'default' => ''
			),
			array(
				'uid' => '_footer_scripts',
				'label' => 'Footer Scripts',
				'section' => '_general',
				'type' => 'textarea',
				'options' => false,
				'placeholder' => '',
				'helper' => '',
				'supplemental' => "These scripts will run at the &lt;head&gt; after Google Analytics and Google Tag Manager",
				'default' => ''
			),
			array(
				'uid' => '_form_submit_dl_name',
				'label' => 'Data Layer: Submit Event',
				'section' => '_forms',
				'type' => 'text',
				'options' => false,
				'placeholder' => '',
				'helper' => '',
				'supplemental' => "This will be the name of the data layer event upon submit",
				'default' => 'Form Submit'
			),
			array(
				'uid' => '_form_submit_ga_name',
				'label' => 'Google Analytics: Submit Event Name',
				'section' => '_forms',
				'type' => 'text',
				'options' => false,
				'placeholder' => '',
				'helper' => '',
				'supplemental' => "This will be the name of the Google Analytics event",
				'default' => 'Form Interaction'
			),
			array(
				'uid' => '_form_submit_ga_action_name',
				'label' => 'Google Analytics: Submit Event Action',
				'section' => '_forms',
				'type' => 'text',
				'options' => false,
				'placeholder' => '',
				'helper' => '',
				'supplemental' => "This will be the name of the Google Analytics event action",
				'default' => 'Submit'
			),
			array(
				'uid' => '_form_submit_ga_label_name',
				'label' => 'Google Analytics: Submit Event Label',
				'section' => '_forms',
				'type' => 'select',
				'options' => array(
					'form_name' 	=> 		'Form Name',
					//'form_url'		=>		'Form URL',		
				),
				'placeholder' => '',
				'helper' => '',
				'supplemental' => "This will be the label of the Google Analytics submit event",
				'default' => 'form_name'
			),
		);
		
		// Loops through each fields from above
		foreach( $fields as $field ){
			//add_settings_field( $id, $title, $callback, $page, $section, $args );
			add_settings_field( 
				$this->option_name . $field['uid'],						 	// $id
				__($field['label'], 'site-analytics'), 						// $title
				array( $this, $this->option_name . '_field_callback' ), 	// $callback
				$this->plugin_name, 										// $page
				$this->option_name . $field['section'], 					// $section
				$field 														// $args
			);
			//register_setting( $option_group, $option_name, $sanitize_callback );
			register_setting( 
				$this->plugin_name, 										// $option_group
				$this->option_name . $field['uid'] 							// $option_name
			);
		}
		
	 }
	 /**
	 * Render the text for the settings sections
	 *
	 * @since  1.0.0
	 */
	public function site_analytics_section_callback($args) {
		switch ($args['id']) {
			// Section 0
			case $this->option_name . '_setup':
				echo __( 'Settings for Installation', 'site-analytics' );
				break;
			// Section 1
			case $this->option_name . '_general':
				echo __( 'Site tracking and scripts to be implemented into the site', 'site-analytics' );
				break;
			// Section 2
			case $this->option_name . '_forms':
				echo __( 'Current forms suppported: Contact Form 7, Gravity Forms', 'site-analytics' );
				break;
			// Section 3
			case $this->option_name . '_ecommerce':
				echo __( 'Ecommerce platforms supported: Woocommerce', 'site-analytics' );
				break;
		}
	}
	/**
	 * Render the text for the settings fields
	 *
	 * @since  1.0.0
	 */
	 public function site_analytics_field_callback($args) {
		$value = get_option( $this->option_name . $args['uid'] ); // Get the current value, if there is one
    	if( ! $value ) { // If no value exists
        	$value = $args['default']; // Set to our default
   		}
		// Check which type of field we want
    	switch( $args['type'] ){
			// Textboxes
        	case 'text':
        	    printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $this->option_name . $args['uid'], $args['type'], $args['placeholder'], $value );
          	break;
			// Text Areas
			case 'textarea': 
				printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $this->option_name . $args['uid'], $args['placeholder'], $value );
			break;
			// Select Dropdown
			case 'select':
				if( ! empty ( $args['options'] ) && is_array( $args['options'] ) ){
					$options_markup = '';
					foreach( $args['options'] as $key => $label ){
						$options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value, $key, false ), $label );
					}
					printf( '<select name="%1$s" id="%1$s">%2$s</select>', $this->option_name . $args['uid'], $options_markup );
				}
			break;
			// Checkboxes
			case 'checkbox':
				if ( $value ) {
					$value = 'checked';
				}
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="1" %4$s/>', $this->option_name . $args['uid'], $args['type'], $args['placeholder'], $value );
			break;
   		}

		// If there is help text
    	if( $helper = $args['helper'] ){
        	printf( '<span class="helper"> %s</span>', $helper ); // Show it
    	}

		// If there is supplemental text
    	if( $supplemental = $args['supplemental'] ){
        	printf( '<p class="description">%s</p>', $supplemental ); // Show it
    	}
		
	 }


}
