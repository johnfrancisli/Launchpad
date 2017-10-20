<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              francis.li
 * @since             1.0.0
 * @package           Site_Analytics
 *
 * @wordpress-plugin
 * Plugin Name:       Site Analytics
 * Plugin URI:        siteanalytics.francis.li
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Francis Li
 * Author URI:        francis.li
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       site-analytics
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-site-analytics-activator.php
 */
function activate_site_analytics() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-site-analytics-activator.php';
	Site_Analytics_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-site-analytics-deactivator.php
 */
function deactivate_site_analytics() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-site-analytics-deactivator.php';
	Site_Analytics_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_site_analytics' );
register_deactivation_hook( __FILE__, 'deactivate_site_analytics' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-site-analytics.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_site_analytics() {

	$plugin = new Site_Analytics();
	$plugin->run();

}
run_site_analytics();
