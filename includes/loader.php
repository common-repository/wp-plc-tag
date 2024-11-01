<?php
/**
 * Plugin loader.
 *
 * @package   OnePlace\Tag
 * @copyright 2020 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/article
 */

namespace OnePlace\Tag;

/**
 * Load composer autoload files
 *
 * we currently don't have any external libs
 *
require __DIR__ . '/vendor/autoload.php';Settings.php
 **/

// Load Plugin
require_once __DIR__.'/Plugin.php';

// Load Modules
require_once __DIR__.'/Modules/Settings.php';
require_once __DIR__.'/Modules/Elementor.php';

Plugin::load(WPPLC_TAG_MAIN_FILE);