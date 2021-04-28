<?php
/**
 *
 * Plugin Name:     Plugin Name
 * Plugin URI:      @TODO
 * Description:     @TODO
 * Version:         1.0.0
 * Author:
 * Author URI:
 * Text Domain:
 * License:         GPL 2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.0
 */

use MyPackage\WP\Plugin\Plugin;

require_once __DIR__ . '/Plugin.php';

$plugin = new Plugin(sp_container());
$plugin->run();