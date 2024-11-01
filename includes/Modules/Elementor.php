<?php

/**
 * Elementor Integration for OnePlace Tag
 *
 * @package   OnePlace\Tag\Modules
 * @copyright 2020 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/tag
 */

namespace OnePlace\Tag\Modules;

use OnePlace\Tag\Plugin;

final class Elementor {
    /**
     * Main instance of the module
     *
     * @var Plugin|null
     * @since 1.0.0
     */
    private static $instance = null;

    /**
     * Shop Elementor Integration
     *
     * @since 1.0.0
     */
    public function register() {
        // Register Settings
        add_action( 'admin_init', [ $this, 'registerSettings' ] );

        // create category for elementor
        add_action( 'elementor/elements/categories_registered', [$this,'addElementorWidgetCategories'] );

        // register elementor widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'initElementorWidgets' ] );

        // enqueue slider custom scripts for frontend
        add_action( 'wp_enqueue_scripts', [$this,'enqueueScripts'] );
    }

    /**
     * Enqueue Elementor Widget Frontend Custom Scripts
     *
     * @since 1.0.0
     */
    public function enqueueScripts() {
    }

    /**
     * Initialize Elementor Widgets if activated
     *
     * @since 1.0.0
     */
    public function initElementorWidgets() {
        # Load Article Slider if active
        if(get_option( 'plctag_elementor_tag_list_active') == 1) {
            require_once(__DIR__ . '/../elementor/widgets/tag-list.php');
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \WPPLC_Tag_List());
        }
    }

    /**
     * Create Category for our Elementor
     * Widgets
     *
     * @since 1.0.0
     */
    public function addElementorWidgetCategories( $elements_manager ) {
        $elements_manager->add_category(
            'wp-plc-tag',
            [
                'title' => __( 'OnePlace Tag', 'wp-plc-tag' ),
                'icon' => 'fa fa-tags',
            ]
        );
    }

    /**
     * Register Elementor specific settings
     *
     * @since 1.0.0
     */
    public function registerSettings() {
        // Widgets
        register_setting( 'wpplc_tag_elementor', 'plctag_elementor_tag_list_active', false );
    }

    /**
     * Loads the module main instance and initializes it.
     *
     * @return bool True if the plugin main instance could be loaded, false otherwise.
     * @since 1.0.0
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