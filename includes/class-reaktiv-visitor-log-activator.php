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
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$form = '<h3>Visitor Registration Form</h3>

		<form id="login-form" action="' . esc_url( admin_url('admin-post.php') ) .'">

		<input type="text" required placeholder="Your Name" name="guest" />

		<input type="text" required placeholder="Your E-mail" name="email" />

		<select required name="host">

		<option value="Bob">Bob</option>
		<option value="Susan">Susan</option>
		<option value="Josephine">Josephine</option>

		</select>

		<input type="hidden" name="action" value="visitor_login_form">
		<input type="submit" value="Submit" />

		</form>';

    $generated_visitor_page = array(
      'post_title'    => wp_strip_all_tags( 'Visit' ),
      'post_content'  => $form,
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type'     => 'page',
    );

    wp_insert_post( $generated_visitor_page );
	}

}
