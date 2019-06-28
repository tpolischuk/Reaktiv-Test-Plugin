<?php

/**
* Provide a public-facing view for the plugin
*
* This file is used to markup the public-facing aspects of the plugin.
*
* @link       http://www.trevorpolischuk.com
* @since      1.0.0
*
* @package    Reaktiv_Visitor_Log
* @subpackage Reaktiv_Visitor_Log/public/partials
*/

get_header();

global $wpdb;

$table_name = "reaktiv_visitor_log_employees";

$employee_data = $wpdb->get_results( "SELECT * FROM $table_name" );

$visitable_employees = '';

foreach ($employee_data as $employee) {
	$visitable_employees .= '<option value="' . $employee->name .' - '. $employee->desk . '">'. $employee->name .' - '. $employee->desk . '</option>';
}

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="entry-content">
    <div class="form-container">
      <form id="visitor-login-form" action="<?php echo esc_url( admin_url('admin-post.php') ) ?>">
        <h3>Visitor Registration Form</h3>
        <input type="text" required placeholder="Your Name" name="guest" />

        <input type="email" required placeholder="Your E-mail" name="email" />

        <select required name="host">
          <?php echo $visitable_employees; ?>
        </select>

        <input type="hidden" name="action" value="visitor_login_form">
        <input id="visitor-submit" type="submit" value="Submit" />
      </form>
    </div>
  </div>


</article><!-- #post-<?php the_ID(); ?> -->


  <?php
  get_footer();
