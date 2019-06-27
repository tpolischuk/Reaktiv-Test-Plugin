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
?>

<section id="primary" class="content-area">
  <main id="main" class="site-main">

    <div class="form-container">
      <form id="visitor-login-form" action="<?php echo esc_url( admin_url('admin-post.php') ) ?>">
        <h3>Visitor Registration Form</h3>
        <input type="text" required placeholder="Your Name" name="guest" />

        <input type="email" required placeholder="Your E-mail" name="email" />

        <h1>Put employee data here</h1>
        <select required name="host">

        </select>

        <input type="hidden" name="action" value="visitor_login_form">
        <input id="visitor-submit" type="submit" value="Submit" />
      </form>
    </div>

    </main><!-- #main -->
  </section><!-- #primary -->

  <?php
  get_footer();
