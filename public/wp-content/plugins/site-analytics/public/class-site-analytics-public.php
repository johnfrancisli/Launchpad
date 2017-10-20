<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       francis.li
 * @since      1.0.0
 *
 * @package    Site_Analytics
 * @subpackage Site_Analytics/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Site_Analytics
 * @subpackage Site_Analytics/public
 * @author     Francis Li <me@francis.li>
 */
class Site_Analytics_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/site-analytics-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		// wp_enqueue_script( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/site-analytics-public.js', array( 'jquery' ), $this->version, false );
		// Contact Form 7 Integrations
		wp_enqueue_script( $this->plugin_name . "_wpcf7", plugin_dir_url( __FILE__ ) . 'js/site-analytics-public-wpcf7.js', array( 'jquery' ), $this->version, false );
		// Gravity Form Integrations
		wp_enqueue_script( $this->plugin_name . "_wpgf", plugin_dir_url( __FILE__ ) . 'js/site-analytics-public-wpgf.js', array( 'jquery' ), $this->version, false );
	}
	/**
	 * Install Header Scripts
	 *
	 * @since    1.0.0
	 */
	public function install_header_scripts() {
		
		/*
		* If Google Analytics is Enabled, Install Google Analytics Code
		*/
		if (get_option('site_analytics_ga_enable')) {
				echo "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '".get_option('site_analytics_ga_id')."', 'auto');
  ga('send', 'pageview');

</script>";
		} // Install Google Analytics Code
		
		/*
		* If Google Tag Manager is Enabled, Install Google Tag Manager
		*/
		if (get_option('site_analytics_gtm_enable')) {
				echo "<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','".get_option('site_analytics_gtm_id')."');</script>
<!-- End Google Tag Manager -->";
		} // Install Google Tag Manager Code
		/*
		* Run Header Scripts
		*/
		echo get_option('site_analytics_header_scripts');
	}
	
	
	/**
	 * Install Footer Scripts
	 *
	 * @since    1.0.0
	 */
	public function install_footer_scripts() {
		echo get_option('site_analytics_footer_scripts');
	}
	
	public function install_after_body_scripts() {
		/*
		* If Google Tag Manager is Enabled, Install Google Tag Manager
		*/
		if (get_option('site_analytics_gtm_enable')) {
				echo '<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id='.get_option('site_analytics_gtm_id').'"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->';
		} // Install Google Tag Manager Code
		// Install After Body Scripts
		echo get_option('site_analytics_after_body_scripts');
	}
	
	/**
	 * Parse the GA Cookie
	 *
	 * @since    1.0.0
	 */
	 private function ga_parse_cookie() {
		if (isset($_COOKIE['_ga'])) {
			list($version, $domainDepth, $cid1, $cid2) = explode('.', $_COOKIE["_ga"], 4);
			$contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1 . '.' . $cid2);
			$cid = $contents['cid'];
		} else {
			$cid = $this->ga_generate_uuid();
		}
		return $cid;
	}
	/**
	 * Parse the GA Cookie
	 *
	 * @since    1.0.0
	 */
	 private function ga_generate_uuid() {
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}
	/**
	 * Send Data to Google Analytics
	 *
	 * @since    1.0.0
	 */
	 private function ga_send_data($data) {
		 //https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide#event
		$getString = 'https://ssl.google-analytics.com/collect';
		$getString .= '?payload_data&';
		$getString .= http_build_query($data);
		$result = wp_remote_get($getString);
		return $result;
	 }
	 /**
	 * Send Pageview Function for Server-Side Google Analytics
	 *
	 * @since    1.0.0
	 */
	public function ga_send_pageview($hostname=null, $page=null, $title=null) {
		$data = array(
			'v' => 1,
			'tid' => get_option('site_analytics_ga_id'), //@TODO: Change this to your Google Analytics Tracking ID.
			'cid' => $this->ga_parse_cookie(),
			't' => 'pageview',
			'dh' => get_home_url(), //Document Hostname "gearside.com"
			'dp' => get_permalink(), //Page "/something"
			'dt' => get_the_title() //Title
		);
		$this->ga_send_data($data);
	}
	 /**
	 * Send Eveny Function for Server-Side Google Analytics
	 *
	 * @since    1.0.0
	 */
	 private function ga_send_event($category = null, $action = null, $label = null) {
		 $data = array(
			'v' => 1,
			'tid' => get_option('site_analytics_ga_id'), //@TODO: Change this to your Google Analytics Tracking ID.
			'cid' => $this->ga_parse_cookie(),
			't' => 'event',
			'ec' => $category, //Category (Required)
			'ea' => $action, //Action (Required)
			'el' => $label //Label
		);
		$this->ga_send_data($data);
	 }
	 /**
	 * Track Contact Form 7 - Form Submits
	 *
	 * @since    1.0.0
	 */
	 public function track_cf7_form_submit($form_data) {
		$form_title = $form_data->title;
		$this->ga_send_event(
			get_option('site_analytics_form_submit_ga_name'), 					// Event Category
			get_option('site_analytics_form_submit_ga_action_name'),			// Event Action
			$form_title);	 													// Event Label 
	 }
	 /**
	 * Track Gravity Forms - Form Submits
	 *
	 * @since    1.0.0
	 */
	 public function track_gf_form_submit($entry_data, $form_data) {
		$form_title = $form_data['title'];
		$this->ga_send_event(
			get_option('site_analytics_form_submit_ga_name'), 					// Event Category
			get_option('site_analytics_form_submit_ga_action_name'),			// Event Action
			$form_title); 	 													// Event Label
	 }
}
