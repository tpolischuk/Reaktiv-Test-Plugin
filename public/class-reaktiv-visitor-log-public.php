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
	* Process the visitor form, check if the visitor has registered in the past day,
	* insert into Visitor Log custom post type, redirect upon success.
	*
	* @since    1.0.0
	*/
	public function process_visitor_login_form() {

		if (isset($_GET['guest'])) {
			$today = getdate();
			$args = array(
				'post_type' => 'visitor_log',
				'title' => sanitize_text_field($_GET['guest']),
				'date_query' => array(
					array(
						'year'  => $today['year'],
						'month' => $today['mon'],
						'day'   => $today['mday'],
					),
				),
			);
			$loop = new WP_Query( $args );

			while ( $loop->have_posts() ) : $loop->the_post();
				do_action('reaktiv_visitor_log_failed_time_check');
				wp_die('Only one visit allowed per day', 'Error', array(
					'response' 	=> 403,
					'back_link' => '/visit/',
				));
				return;
			endwhile;
		}

		$visitor_log_message = 'Is visiting ' . sanitize_text_field($_GET['host']) . ' on ' . current_time('l, F j Y - H:i:s') . '.';

		// Create entry in the custom post type
		$id = wp_insert_post(array(
			'post_title'=> sanitize_text_field($_GET['guest']),
			'post_type'=> 'visitor_log',
			'post_status' => 'publish',
			'post_content'=> apply_filters('reaktiv_visitor_log_successful_registration', $visitor_log_message)
		));

		wp_reset_postdata();
		wp_redirect( home_url('/visit?success=yes') );
	}

	/**
	* Overrides the default template path if we are usign the visitor form
	*
	* @since    1.0.0
	*/
	public function set_page_template_for_visitor_form() {
		// Check if we are on the visit page
		if( is_page('visit') ) {
			// Override to the template defined in th e plugin
			$template = WP_PLUGIN_DIR . '/reaktiv-visitor-log/public/partials/reaktiv-visitor-log-public-display.php';
			return $template;
		}
	}

}
