<?php

/**
 * WP PLC Tag Settings
 *
 * @package   OnePlace\Tag\Modules
 * @copyright 2020 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/tag
 */

namespace OnePlace\Tag\Modules;

use OnePlace\Tag\Plugin;

final class Settings {
    /**
     * Main instance of the module
     *
     * @since 0.1-stable
     * @var Plugin|null
     */
    private static $instance = null;

    /**
     * Disable wordpress comments entirely
     *
     * @since 0.1-stable
     */
    public function register() {
        // Add submenu page for settings
        add_action("admin_menu", [ $this, 'addSubMenuPage' ], 99);

        // Register Settings
        add_action( 'admin_init', [ $this, 'registerSettings' ] );

        // Add Plugin Languages
        add_action('plugins_loaded', [ $this, 'loadTextDomain' ] );

        // enqueue slider custom scripts for frontend
        add_action( 'wp_enqueue_scripts', [$this,'enqueueScripts'] );
    }

    /**
     * load text domain (translations)
     *
     * @since 1.0.0
     */
    public function loadTextDomain() {
        load_plugin_textdomain( 'wp-plc-tag', false, dirname( plugin_basename(WPPLC_TAG_MAIN_FILE) ) . '/language/' );
    }

    /**
     * Register Plugin Settings in Wordpress
     *
     * @since 1.0.0
     */
    public function registerSettings() {
        // Core Settings

        // Sub Module Handling
        register_setting( 'wpplc_tag', 'plctag_elementor_active', false );
    }

    /**
     * Add Submenu Page to OnePlace Settings Menu
     *
     * @since 1.0.0
     */
    public function addSubMenuPage() {
        add_submenu_page( 'oneplace-connect', 'OnePlace Tag', 'Tag',
            'manage_options', 'oneplace-tag',  [$this,'renderTagSettingsPage'] );
    }

    /**
     * Enqueue Elementor Widget Frontend Custom Scripts
     *
     * @since 1.0.0
     */
    public function enqueueScripts() {
    }

    /**
     * Render Settings Page for Plugin
     *
     * @since 1.0.0
     */
    public function renderTagSettingsPage() {
        require_once __DIR__.'/../view/settings.php';
    }

    /**
     * Loads the module main instance and initializes it.
     *
     * @since 0.1-stable
     *
     * @return bool True if the plugin main instance could be loaded, false otherwise.
     */
    public static function load() {
        if ( null !== static::$instance ) {
            return false;
        }
        static::$instance = new self();
        static::$instance->register();
        return true;
    }
}