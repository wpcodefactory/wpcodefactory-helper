<?php
/**
 * WPFactory Helper - Admin - Crons
 *
 * @version 1.1.0
 * @since   1.0.0
 *
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WPCodeFactory_Helper_Crons' ) ) :

class Alg_WPCodeFactory_Helper_Crons {

	/**
	 * Constructor.
	 *
	 * @version 1.1.0
	 * @since   1.0.0
	 *
	 * @todo    [next] (dev) unschedule events?
	 */
	function __construct() {
		// Check sites keys
		add_action( 'init',                 array( $this, 'schedule_check_sites_keys' ) );
		add_action( 'admin_init',           array( $this, 'schedule_check_sites_keys' ) );
		add_action( 'alg_check_sites_keys', array( $this, 'check_sites_keys' ) );
		// Get plugins list
		add_action( 'init',                 array( $this, 'schedule_get_plugins_list' ) );
		add_action( 'admin_init',           array( $this, 'schedule_get_plugins_list' ) );
		add_action( 'alg_get_plugins_list', array( $this, 'get_plugins_list' ) );
		// Get themes list
		add_action( 'init',                 array( $this, 'schedule_get_themes_list' ) );
		add_action( 'admin_init',           array( $this, 'schedule_get_themes_list' ) );
		add_action( 'alg_get_themes_list',  array( $this, 'get_themes_list' ) );
	}

	/**
	 * schedule_check_sites_keys.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function schedule_check_sites_keys() {
		$event_timestamp = wp_next_scheduled( 'alg_check_sites_keys', array( 'daily' ) );
		update_option( 'alg_check_sites_keys_cron_time_schedule', $event_timestamp );
		if ( ! $event_timestamp ) {
			wp_schedule_event( time(), 'daily', 'alg_check_sites_keys', array( 'daily' ) );
		}
	}

	/**
	 * check_sites_keys.
	 *
	 * @version 1.1.0
	 * @since   1.0.0
	 */
	function check_sites_keys( $interval ) {
		update_option( 'alg_check_sites_keys_cron_time_last_run', time() );
		$items = alg_wpcodefactory_helper()->plugins_updater->items_to_update;
		foreach ( $items as $item_slug ) {
			alg_wpcfh_check_site_key( $item_slug );
		}
	}

	/**
	 * schedule_get_plugins_list.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function schedule_get_plugins_list() {
		$event_timestamp = wp_next_scheduled( 'alg_get_plugins_list', array( 'daily' ) );
		update_option( 'alg_get_plugins_list_cron_time_schedule', $event_timestamp );
		if ( ! $event_timestamp ) {
			wp_schedule_event( time(), 'daily', 'alg_get_plugins_list', array( 'daily' ) );
		}
	}

	/**
	 * get_plugins_list.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function get_plugins_list() {
		update_option( 'alg_get_plugins_list_cron_time_last_run', time() );
		$url = alg_wpcodefactory_helper()->update_server . '/?alg_get_plugins_list';
		if ( ! function_exists( 'download_url' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}
		$response_file_name = download_url( $url );
		if ( ! is_wp_error( $response_file_name ) ) {
			if ( $response = file_get_contents( $response_file_name ) ) {
				update_option( 'alg_wpcodefactory_helper_plugins', json_decode( $response ) );
			}
			unlink( $response_file_name );
		}
	}

	/**
	 * schedule_get_themes_list.
	 *
	 * @version 1.1.0
	 * @since   1.1.0
	 */
	function schedule_get_themes_list() {
		$event_timestamp = wp_next_scheduled( 'alg_get_themes_list', array( 'daily' ) );
		update_option( 'alg_get_themes_list_cron_time_schedule', $event_timestamp );
		if ( ! $event_timestamp ) {
			wp_schedule_event( time(), 'daily', 'alg_get_themes_list', array( 'daily' ) );
		}
	}

	/**
	 * get_themes_list.
	 *
	 * @version 1.1.0
	 * @since   1.1.0
	 */
	function get_themes_list() {
		update_option( 'alg_get_themes_list_cron_time_last_run', time() );
		$url = alg_wpcodefactory_helper()->update_server . '/?alg_get_themes_list';
		if ( ! function_exists( 'download_url' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}
		$response_file_name = download_url( $url );
		if ( ! is_wp_error( $response_file_name ) ) {
			if ( $response = file_get_contents( $response_file_name ) ) {
				update_option( 'alg_wpcodefactory_helper_themes', json_decode( $response ) );
			}
			unlink( $response_file_name );
		}
	}

}

endif;

return new Alg_WPCodeFactory_Helper_Crons();
