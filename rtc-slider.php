<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Rtc_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       Slideshow
 * Description:       you can use shortcode for [rtc_slider].
 * Version:           1.0.0
 * Author:            Dharti Gajera
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rtc-slider
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'RTC_SLIDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rtc-slider-activator.php
 */
function activate_rtc_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rtc-slider-activator.php';
	Rtc_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rtc-slider-deactivator.php
 */
function deactivate_rtc_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rtc-slider-deactivator.php';
	Rtc_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rtc_slider' );
register_deactivation_hook( __FILE__, 'deactivate_rtc_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rtc-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rtc_slider() {

	$plugin = new Rtc_Slider();
	$plugin->run();

}
run_rtc_slider();
