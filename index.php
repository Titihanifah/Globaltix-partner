<?php
/**
 * Plugin Name:       GlobalTix Partner
 * Plugin URI:        
 * Description:       Integrate data products, tickets using API Globaltix
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Titi Hanifah
 * License:           GPL v2 or later
 * Text Domain:       globaltix-partner
 *
 * @package Globaltix Partner
 */

/**
 * Class Globaltix
 *
 * This class creates the option page and add the web app script
 */
class Globaltix {
	/**
	 * Set url & path, include files
	 */
	public function __construct() {
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}

		if ( ! defined( 'GLOBALTIX_URL' ) ) {
			define( 'GLOBALTIX_URL', plugin_dir_url( __FILE__ ) );
		}

		if ( ! defined( 'GLOBALTIX_PATH' ) ) {
			define( 'GLOBALTIX_PATH', plugin_dir_path( __FILE__ ) );
		}

		require GLOBALTIX_PATH . '/inc/helper.php';
	}
}

new Globaltix();