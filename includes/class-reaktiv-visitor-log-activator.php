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
	* Visitor Log Form setup. (use period)
	*
	* This function downloads the remote JSON file to populate the employee dropdown.
	* Then, it creates a form, and creates the /visit/ page.
	*
	* @since    1.0.0
	*/
	public static function activate() {

		$employee_url = "https://gist.githubusercontent.com/jjeaton/21f04d41287119926eb4/raw/4121417bda0860f662d471d1d22b934a0af56eca/coworkers.json";

		$response = wp_remote_get( $employee_url );
		if ( is_array( $response ) ) {
			$body = $response['body'];
		}

		$employee_data = json_decode($body);

		$visitable_employees = '';

		foreach ($employee_data as $employee) {
			$visitable_employees .= '<option value="' . $employee->name .' - '. $employee->desk . '">'. $employee->name .' - '. $employee->desk . '</option>';
		}

		$form = '<div class="form-container">
		<form id="visitor-login-form" action="' . esc_url( admin_url('admin-post.php') ) .'">
		<h3>Visitor Registration Form</h3>
		<input type="text" required placeholder="Your Name" name="guest" />

		<input type="email" required placeholder="Your E-mail" name="email" />

		<select required name="host">
		' . $visitable_employees . '
		</select>

		<input type="hidden" name="action" value="visitor_login_form">
		<input id="visitor-submit" type="submit" value="Submit" />
		</form></div>';

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
