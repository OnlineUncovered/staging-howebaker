<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package
 *
 * @wordpress-plugin
 * Plugin Name:       The7 White-Label Tool
 * Description:       Enables The7 white-label features.
 * Version:           1.0.1
 * Author:            Dream-Theme
 * Author URI:        http://dream-theme.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dt-dev-tools
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'DT_Dev_Tools' ) ) :

	/**
	 * Base class.
	 */
	class DT_Dev_Tools {

		public static $instance;

		public $plugin_dir;
		protected $admin;

		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __construct() {
			$this->load_dependencies();
			$this->execute();
		}

		protected function load_dependencies() {
			if ( ! $this->plugin_dir ) {
				$this->plugin_dir = plugin_dir_path( __FILE__ );
			}

			require $this->plugin_dir . 'class-dt-dev-tool-admin.php';
			$this->admin = new DT_DevToolAdmin();
		}

		protected function execute() {
			if ( is_admin() ) {

				// Setup options.
				add_action( 'admin_init', array( $this->admin, 'init_admin_page' ) );

				// Create admin page.
				add_action( 'admin_menu', array( $this->admin, 'setup_admin_page_action' ) );
			}
		}
	}

	DT_Dev_Tools::get_instance();

endif;
