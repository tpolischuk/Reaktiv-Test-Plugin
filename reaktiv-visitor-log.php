<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.trevorpolischuk.com
 * @since             1.0.0
 * @package           Reaktiv_Visitor_Log
 *
 * @wordpress-plugin
 * Plugin Name:       Reaktiv Visitor Log
 * Plugin URI:        https://reaktivstudios.com/
 * Description:       This plugin creates a page for users track visitors.
 * Version:           1.0.0
 * Author:            Trevor Polischuk
 * Author URI:        http://www.trevorpolischuk.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       reaktiv-visitor-log
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'REAKTIV_VISITOR_LOG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-reaktiv-visitor-log-activator.php
 */
function activate_reaktiv_visitor_log() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-reaktiv-visitor-log-activator.php';
	Reaktiv_Visitor_Log_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-reaktiv-visitor-log-deactivator.php
 */
function deactivate_reaktiv_visitor_log() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-reaktiv-visitor-log-deactivator.php';
	Reaktiv_Visitor_Log_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_reaktiv_visitor_log' );
register_deactivation_hook( __FILE__, 'deactivate_reaktiv_visitor_log' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-reaktiv-visitor-log.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_reaktiv_visitor_log() {

	$plugin = new Reaktiv_Visitor_Log();
	$plugin->run();

}
run_reaktiv_visitor_log();
