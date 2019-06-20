<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.trevorpolischuk.com
 * @since      1.0.0
 *
 * @package    Reaktiv_Visitor_Log
 * @subpackage Reaktiv_Visitor_Log/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Reaktiv_Visitor_Log
 * @subpackage Reaktiv_Visitor_Log/includes
 * @author     Trevor Polischuk <trevorpolischuk@gmail.com>
 */
class Reaktiv_Visitor_Log_Deactivator {

	/**
	 * Removes Visitor Log functionality. (use period)
	 *
	 * Deletes the /visit/ page and unregisters the custom post type.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$page = get_page_by_path( 'visit' );
		wp_delete_post($page->ID);
    unregister_post_type( 'Visitor Log' );
	}

}
