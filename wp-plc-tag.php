<?php
/**
 * Plugin main file.
 *
 * @package   OnePlace\Tag
 * @copyright 2020 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch
 *
 * @wordpress-plugin
 * Plugin Name: WP PLC Tag
 * Plugin URI:  https://1plc.ch/wordpress-plugins/tag
 * Description: onePlace Tags for Wordpress. Widgets and Shortcodes for onePlace Tags
 * Version:     1.0.1
 * Author:      Verein onePlace
 * Author URI:  https://1plc.ch
 * License:     GNU General Public License, version 2
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * Text Domain: wp-plc-tag
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define Version and directories for further use in plugin
define( 'WPPLC_TAG_VERSION', '1.0.1' );
define( 'WPPLC_TAG_MAIN_FILE', __FILE__ );
define( 'WPPLC_TAG_MAIN_DIR', __DIR__ );

/**
 * Handles plugin activation.
 *
 * Throws an error if the plugin is activated on an older version than PHP 5.4.
 *
 * @access private
 *
 * @param bool $network_wide Whether to activate network-wide.
 */
function wpplc_tag_activate_plugin( $network_wide ) {
    // check php version
    if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
        // show error if version is below 5.4
        wp_die(
            esc_html__( 'WP PLC Article requires PHP version 5.4.', 'wp-plc-tag' ),
            esc_html__( 'Error Activating', 'wp-plc-tag' )
        );
    }

    // check if oneplace connect is already loaded
    if ( ! defined('WPPLC_CONNECT_VERSION') ) {
        // show error if version cannot be determined
        wp_die(
            esc_html__( 'WP PLC Tag requires WP PLC Connect', 'wp-plc-tag' ),
            esc_html__( 'Error Activating', 'wp-plc-tag' )
        );
    }

    // we currently support multisite - so we just activate on network wide
}
register_activation_hook( __FILE__, 'wpplc_tag_activate_plugin' );

/**
 * Handles plugin deactivation.
 *
 * @access private
 *
 * @param bool $network_wide Whether to deactivate network-wide.
 */
function wpplc_tag_deactivate_plugin( $network_wide ) {
    if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
        return;
    }

    // deactivation network wide is the same for now
}
register_deactivation_hook( __FILE__, 'wpplc_tag_deactivate_plugin' );

// make sure php version is up2date
if ( version_compare( PHP_VERSION, '5.4.0', '>=' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/loader.php';
}