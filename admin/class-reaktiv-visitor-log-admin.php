<?php

/**
* The admin-specific functionality of the plugin.
*
* @link       http://www.trevorpolischuk.com
* @since      1.0.0
*
* @package    Reaktiv_Visitor_Log
* @subpackage Reaktiv_Visitor_Log/admin
*/

/**
* The admin-specific functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the admin-specific stylesheet and JavaScript.
*
* @package    Reaktiv_Visitor_Log
* @subpackage Reaktiv_Visitor_Log/admin
* @author     Trevor Polischuk <trevorpolischuk@gmail.com>
*/
class Reaktiv_Visitor_Log_Admin {

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
		* defined in Reaktiv_Visitor_Log_Loader as all of the hooks are defined
		* in that particular class.
		*
		* The Reaktiv_Visitor_Log_Loader will then create the relationship
		* between the defined hooks and the functions defined in this
		* class.
		*/

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/reaktiv-visitor-log-admin.css', array(), $this->version, 'all' );

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
		* defined in Reaktiv_Visitor_Log_Loader as all of the hooks are defined
		* in that particular class.
		*
		* The Reaktiv_Visitor_Log_Loader will then create the relationship
		* between the defined hooks and the functions defined in this
		* class.
		*/

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/reaktiv-visitor-log-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	* Register Visitor Log custom post type.
	*
	* @since    1.0.0
	*/
	public function visitor_log_custom_post_type() {
		register_post_type('visitor_log',
		array(
			'labels'      => array(
				'name'               => __('Visitor Log'),
				'singular_name'      => __('Visitor Log Entry'),
				'menu_name'          => _x( 'Visitor Log', 'admin menu' ),
				'name_admin_bar'     => _x( 'Visitor Log', 'add new on admin bar'),
				'add_new'            => _x( 'Add New Visitor', 'visitor log entry'),
				'add_new_item'       => __( 'Add New Visitor Log Entry'),
				'new_item'           => __( 'New Visitor Log Entry'),
				'edit_item'          => __( 'Edit Visitor Log Entry'),
				'view_item'          => __( 'View Visitor Log Entry'),
				'all_items'          => __( 'All Visitors'),
				'search_items'       => __( 'Search Visitor Log Entries'),
				'parent_item_colon'  => __( 'Parent Visitor Log Entries:'),
				'not_found'          => __( 'No visitor log entries found.'),
				'not_found_in_trash' => __( 'No visitor log entries found in Trash.')
			),
			'public'      => true,
			'has_archive' => true,
		)
	);
}

}
