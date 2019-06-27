<?php
/**
* Fired during plugin activation
*
* @link       http://www.trevorpolischuk.com
* @since      1.0.0
*
* @package    Reaktiv_Visitor_Log
* @subpackage Reaktiv_Visitor_Log/includes
*/
/**
* Fired during plugin activation.
*
* This class defines all code necessary to run during the plugin's activation.
*
* @since      1.0.0
* @package    Reaktiv_Visitor_Log
* @subpackage Reaktiv_Visitor_Log/includes
* @author     Trevor Polischuk <trevorpolischuk@gmail.com>
*/
class Reaktiv_Visitor_Log_Activator {
	/**
	* Creates a custom table and inserts the employee data.
	* Creates a custom page at /visit/.
	*
	* @since    1.0.0
	*/
	public static function activate() {

		// Create a database table for storing the employee data

		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE reaktiv_visitor_log_employees (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				name varchar(55) NOT NULL,
				desk mediumint(9) NOT NULL,
				UNIQUE KEY id (id)
		) $charset_collate;";

		if ( ! function_exists('dbDelta') ) {
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		}

		dbDelta( $sql );

		// Save DB version, if we need to do schema updates in the future
		add_option( 'reaktiv_visitor_log_db_version', '1.0' );

		// Retrieve the employee data from the remote JSON file
		$employee_url = "https://gist.githubusercontent.com/jjeaton/21f04d41287119926eb4/raw/4121417bda0860f662d471d1d22b934a0af56eca/coworkers.json";

		$response = wp_remote_get( $employee_url );
		if ( is_array( $response ) ) {
			$body = $response['body'];
		}

		$employee_data = json_decode($body);

		//Insert the data into the custom table
		foreach ($employee_data as $employee) {
			$wpdb->insert("reaktiv_visitor_log_employees",array(
				"name" => $employee->name,
				"desk"=>$employee->desk
			));
		};

		$generated_visitor_page = array(
			'post_title'    => wp_strip_all_tags( 'Visit' ),
			'post_content'  => '',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_type'     => 'page'
		);

		wp_insert_post( $generated_visitor_page );
	}

}
