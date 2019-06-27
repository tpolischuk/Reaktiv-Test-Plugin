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
	* TODO update this to reflect the new functionality
	*
	* @since    1.0.0
	*/
	public static function activate() {

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
