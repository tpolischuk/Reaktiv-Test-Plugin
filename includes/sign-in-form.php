<?php


$rendered_form = '
<h3>Visitor Registration Form</h3>

<form id="login-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">

<input type="text" placeholder="Your Name" name="guest" />

<input type="text" placeholder="Your E-mail" name="email" />

<select>

<option value="Bob">Bob</option>
<option value="Susan">Susan</option>
<option value="Josephine">Josephine</option>

</select>

<input type="hidden" name="action" value="visitor_login_form">
<input type="submit" value="Submit" />

</form>';
