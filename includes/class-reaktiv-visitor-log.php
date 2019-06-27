<?php

/**
* The file that defines the core plugin class
*
* A class definition that includes attributes and functions used across both the
* public-facing side of the site and the admin area.
*
* @link       http://www.trevorpolischuk.com
* @since      1.0.0
*
* @package    Reaktiv_Visitor_Log
* @subpackage Reaktiv_Visitor_Log/includes
*/

/**
* The core plugin class.
*
* This is used to define internationalization, admin-specific hooks, and
* public-facing site hooks.
*
* Also maintains the unique identifier of this plugin as well as the current
* version of the plugin.
*
* @since      1.0.0
* @package    Reaktiv_Visitor_Log
* @subpackage Reaktiv_Visitor_Log/includes
* @author     Trevor Polischuk <trevorpolischuk@gmail.com>
*/
class Reaktiv_Visitor_Log {

	/**
	* The loader that's responsible for maintaining and registering all hooks that power
	* the plugin.
	*
	* @since    1.0.0
	* @access   protected
	* @var      Reaktiv_Visitor_Log_Loader    $loader    Maintains and registers all hooks for the plugin.
	*/
	protected $loader;

	/**
	* The unique identifier of this plugin.
	*
	* @since    1.0.0
	* @access   protected
	* @var      string    $plugin_name    The string used to uniquely identify this plugin.
	*/
	protected $plugin_name;

	/**
	* The current version of the plugin.
	*
	* @since    1.0.0
	* @access   protected
	* @var      string    $version    The current version of the plugin.
	*/
	protected $version;

	/**
	* Define the core functionality of the plugin.
	*
	* Set the plugin name and the plugin version that can be used throughout the plugin.
	* Load the dependencies, define the locale, and set the hooks for the admin area and
	* the public-facing side of the site.
	*
	* @since    1.0.0
	*/
	public function __construct() {
		if ( defined( 'REAKTIV_VISITOR_LOG_VERSION' ) ) {
			$this->version = REAKTIV_VISITOR_LOG_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'reaktiv-visitor-log';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->create_visitor_page_template();

	}

	/**
	* Load the required dependencies for this plugin.
	*
	* Include the following files that make up the plugin:
	*
	* - Reaktiv_Visitor_Log_Loader. Orchestrates the hooks of the plugin.
	* - Reaktiv_Visitor_Log_i18n. Defines internationalization functionality.
	* - Reaktiv_Visitor_Log_Admin. Defines all hooks for the admin area.
	* - Reaktiv_Visitor_Log_Public. Defines all hooks for the public side of the site.
	*
	* Create an instance of the loader which will be used to register the hooks
	* with WordPress.
	*
	* @since    1.0.0
	* @access   private
	*/
	private function load_dependencies() {

		/**
		* The class responsible for orchestrating the actions and filters of the
		* core plugin.
		*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-reaktiv-visitor-log-loader.php';

		/**
		* The class responsible for defining internationalization functionality
		* of the plugin.
		*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-reaktiv-visitor-log-i18n.php';

		/**
		* The class responsible for defining all actions that occur in the admin area.
		*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-reaktiv-visitor-log-admin.php';

		/**
		* The class responsible for defining all actions that occur in the public-facing
		* side of the site.
		*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-reaktiv-visitor-log-public.php';

		$this->loader = new Reaktiv_Visitor_Log_Loader();

	}

	/**
	* Define the locale for this plugin for internationalization.
	*
	* Uses the Reaktiv_Visitor_Log_i18n class in order to set the domain and to register the hook
	* with WordPress.
	*
	* @since    1.0.0
	* @access   private
	*/
	private function set_locale() {

		$plugin_i18n = new Reaktiv_Visitor_Log_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	* Register all of the hooks related to the admin area functionality
	* of the plugin.
	*
	* @since    1.0.0
	* @access   private
	*/
	private function define_admin_hooks() {

		$plugin_admin = new Reaktiv_Visitor_Log_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		//Adding the custom post type to the init action
		$this->loader->add_action( 'init', $plugin_admin, 'visitor_log_custom_post_type' );
		$this->loader->add_action( 'plugins_loaded', $plugin_admin, array( 'PageTemplater', 'get_instance' ) );

	}

	/**
	* Register all of the hooks related to the public-facing functionality
	* of the plugin.
	*
	* @since    1.0.0
	* @access   private
	*/
	private function define_public_hooks() {

		$plugin_public = new Reaktiv_Visitor_Log_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		//Registering the POST/GET processing the visitor form
		$this->loader->add_action( 'admin_post_nopriv_visitor_login_form', $plugin_public, 'process_visitor_login_form' );
		$this->loader->add_action( 'admin_post_visitor_login_form', $plugin_public, 'process_visitor_login_form' );

	}

	/**
	* Register a custom page template for the visitor login form.
	* Credit insipiration to https://github.com/wpexplorer/page-templater
	*
	* @since    1.0.0
	* @access   private
	*/
	private function create_visitor_page_template() {
		$this->templates = array();
		// Add a filter to the attributes metabox to inject template into the cache.
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
			add_filter(
				'page_attributes_dropdown_pages_args',
				array( $this, 'register_project_templates' )
			);
		} else {
			add_filter(
				'theme_page_templates', array( $this, 'add_new_template' )
			);
		}
		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data',
			array( $this, 'register_project_templates' )
		);
		// Add a filter to the template include to determine if the page has our
		// template assigned and return it's path
		add_filter(
			'template_include',
			array( $this, 'view_project_template')
		);
		// Add your templates to this array.
		$this->templates = array(
			'../public/partials/reaktiv-visitor-log-public-display.php' => 'Visitor Log Form',
		);
	}

	/**
	* Run the loader to execute all of the hooks with WordPress.
	*
	* @since    1.0.0
	*/
	public function run() {
		$this->loader->run();
	}

	/**
	* The name of the plugin used to uniquely identify it within the context of
	* WordPress and to define internationalization functionality.
	*
	* @since     1.0.0
	* @return    string    The name of the plugin.
	*/
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	* The reference to the class that orchestrates the hooks with the plugin.
	*
	* @since     1.0.0
	* @return    Reaktiv_Visitor_Log_Loader    Orchestrates the hooks of the plugin.
	*/
	public function get_loader() {
		return $this->loader;
	}

	/**
	* Retrieve the version number of the plugin.
	*
	* @since     1.0.0
	* @return    string    The version number of the plugin.
	*/
	public function get_version() {
		return $this->version;
	}

	/**
	* Adds our template to the page dropdown for v4.7+
	*
	* @since    1.0.0
	* @access   public
	*/
	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}
	/**
	* Adds our template to the pages cache in order to trick WordPress
	* into thinking the template file exists where it doens't really exist.
	* @since    1.0.0
	* @access   public
	*/
	public function register_project_templates( $atts ) {
		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}
		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');
		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );
		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );
		return $atts;
	}
	/**
	* Checks if the template is assigned to the page
	* @since    1.0.0
	* @access   public
	*/
	public function view_project_template( $template ) {
		// Return the search template if we're searching (instead of the template for the first result)
		if ( is_search() ) {
			return $template;
		}
		// Get global post
		global $post;
		// Return template if post is empty
		if ( ! $post ) {
			return $template;
		}
		// Return default template if we don't have a custom one defined
		if ( ! isset( $this->templates[get_post_meta(
			$post->ID, '_wp_page_template', true
			)] ) ) {
				return $template;
			}
			// Allows filtering of file path
			$filepath = apply_filters( 'page_templater_plugin_dir_path', plugin_dir_path( __FILE__ ) );
			$file =  $filepath . get_post_meta(
				$post->ID, '_wp_page_template', true
			);
			// Just to be safe, we check if the file exist first
			if ( file_exists( $file ) ) {
				return $file;
			} else {
				echo $file;
			}
			// Return template
			return $template;
		}


	}
