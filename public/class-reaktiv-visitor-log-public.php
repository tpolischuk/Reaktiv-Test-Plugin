<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.trevorpolischuk.com
 * @since      1.0.0
 *
 * @package    Reaktiv_Visitor_Log
 * @subpackage Reaktiv_Visitor_Log/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Reaktiv_Visitor_Log
 * @subpackage Reaktiv_Visitor_Log/public
 * @author     Trevor Polischuk <trevorpolischuk@gmail.com>
 */
class Reaktiv_Visitor_Log_Public {

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
		 * defined in Reaktiv_Visitor_Log_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Reaktiv_Visitor_Log_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/reaktiv-visitor-log-public.css', array(), $this->version, 'all' );

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
		 * defined in Reaktiv_Visitor_Log_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Reaktiv_Visitor_Log_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/reaktiv-visitor-log-public.js', array( 'jquery' ), $this->version, false );

	}
	/**
	 * Process the visitor form
	 *
	 * @since    1.0.0
	 */
	public function process_visitor_login_form() {
		/**
		 * At this point, $_GET/$_POST variable are available
		 *
		 * We can do our normal processing here
		 */

		 print('hello');
		 var_dump($_GET);
		 exit;

	}

	/**
	 * Render the visitor log page
	 *
	 * @since  1.0.0
	 */
	// public function display_visitor_log_form() {
	// 	include_once 'partials/reaktiv-visitor-log-public-display.php';
	// }

}
