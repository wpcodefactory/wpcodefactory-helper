<?php
/*
Plugin Name: WPFactory Helper
Plugin URI: https://wpfactory.com/
Description: Plugin helps you manage subscriptions for your products from WPFactory.com.
Version: 1.3.1
Author: Algoritmika Ltd
Author URI: https://wpfactory.com
Text Domain: wpcodefactory-helper
Domain Path: /langs
Copyright: © 2021 Algoritmika Ltd.
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ALG_WPCODEFACTORY_HELPER_UPDATE_SERVER' ) ) {
	/**
	 * ALG_WPCODEFACTORY_HELPER_UPDATE_SERVER
	 *
	 * @version 1.2.1
	 */
	define( 'ALG_WPCODEFACTORY_HELPER_UPDATE_SERVER', 'https://wpfactory.com' );
}

if ( ! class_exists( 'Alg_WPCodeFactory_Helper' ) ) :

/**
 * Main Alg_WPCodeFactory_Helper Class
 *
 * @version 1.3.1
 * @since   1.0.0
 *
 * @class   Alg_WPCodeFactory_Helper
 */
final class Alg_WPCodeFactory_Helper {

	/**
	 * Plugin version.
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	public $version = '1.3.1';

	/**
	 * @var   Alg_WPCodeFactory_Helper The single instance of the class
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Main Alg_WPCodeFactory_Helper Instance
	 *
	 * Ensures only one instance of Alg_WPCodeFactory_Helper is loaded or can be loaded.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 *
	 * @static
	 * @return  Alg_WPCodeFactory_Helper - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Alg_WPCodeFactory_Helper Constructor.
	 *
	 * @version 1.3.1
	 * @since   1.0.0
	 *
	 * @access  public
	 *
	 * @todo    [next] (dev) update POT file
	 * @todo    [later] (dev) do not overwrite old check value on "server error"
	 * @todo    [later] (dev) add "recheck licence now" (e.g. on "server error")
	 * @todo    [later] (dev) `update_server_text` as constant
	 * @todo    [later] (dev) wp-update-server - json_encode unicode issue
	 * @todo    [maybe] (dev) check http://w-shadow.com/blog/2011/06/02/automatic-updates-for-commercial-themes/
	 */
	function __construct() {

		// Core properties
		$this->update_server      = ALG_WPCODEFACTORY_HELPER_UPDATE_SERVER;
		$this->update_server_text = 'WPFactory.com';
		$this->site_url           = str_replace( array( 'http://', 'https://' ), '', site_url() );

		// Set up localisation
		add_action( 'init', array( $this, 'localize' ) );

		// Include required files
		$this->includes();

		// Admin
		if ( is_admin() ) {
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
		}
	}

	/**
	 * localize.
	 *
	 * @version 1.3.1
	 * @since   1.3.1
	 */
	function localize() {
		load_plugin_textdomain( 'wpcodefactory-helper', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function includes() {
		if ( is_admin() && get_option( 'alg_wpcodefactory_helper_version', '' ) !== $this->version ) {
			update_option( 'alg_wpcodefactory_helper_version', $this->version );
		}
		require_once( 'includes/alg-wpcodefactory-helper-site-key-functions.php' );
		$this->plugins_updater = require_once( 'includes/class-alg-wpcodefactory-helper-plugins-updater.php' );
		require_once( 'includes/class-alg-wpcodefactory-helper-site-key-manager.php' );
		require_once( 'includes/class-alg-wpcodefactory-helper-crons.php' );
	}

	/**
	 * Show action links on the plugin screen.
	 *
	 * @version 1.0.1
	 * @since   1.0.0
	 *
	 * @param   mixed $links
	 * @return  array
	 */
	function action_links( $links ) {
		$custom_links = array();
		$custom_links[] = '<a href="' . admin_url( 'options-general.php?page=wpcodefactory-helper' ) . '">' . __( 'Settings', 'wpcodefactory-helper' ) . '</a>';
		return array_merge( $custom_links, $links );
	}

	/**
	 * Get the plugin url.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 *
	 * @return  string
	 */
	function plugin_url() {
		return untrailingslashit( plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 *
	 * @return  string
	 */
	function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get the plugin file.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function plugin_file() {
		return __FILE__;
	}

}

endif;

if ( ! function_exists( 'alg_wpcodefactory_helper' ) ) {
	/**
	 * Returns the main instance of Alg_WPCodeFactory_Helper to prevent the need to use globals.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 *
	 * @return  Alg_WPCodeFactory_Helper
	 *
	 * @todo    [next] (dev) on `plugins_loaded`?
	 */
	function alg_wpcodefactory_helper() {
		return Alg_WPCodeFactory_Helper::instance();
	}
}

alg_wpcodefactory_helper();
