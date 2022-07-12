<?php
/**
 * Plugin Name: RTC Slider
 * Description: you can use shortcode for [rtc_slider].
 * Author: Dharti Gajera
 * Version: 1.0.0
 * 
 */
defined('ABSPATH') or die('No script kiddies please!');


define('RTC_PLUGIN_FILE', __FILE__);
define('RTC_PLUGIN_DIR', __DIR__);


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/slider-portal.php';
require plugin_dir_path(__FILE__) . 'shortcode/slider-shortcode.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    4.0.0
 */
