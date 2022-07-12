<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    rtc-slider
 * @subpackage rtc-slider/includes
 */


function rtc_activate_deactivate_plugin() {

    register_activation_hook(RTC_PLUGIN_FILE, array("RTCSliderActivation", "rtc_slider_activate"));
    register_uninstall_hook(RTC_PLUGIN_FILE, array("RTCSliderActivation", "rtc_slider_uninstall"));
}


/* plugin active function */

function rtc_slider_activate() {
    
}


/* plugin deactive function */

function rtc_slider_uninstall() {
    
}


/* admin css and js */
function rtc_admin_register_scripts() {
    
    wp_enqueue_style('rtc-admin', plugins_url() . '/rtc-slider/assets/css/admin-style.css');
    wp_enqueue_script('rtc-admin-js', plugins_url() . '/rtc-slider/assets/js/admin-js.js');
    wp_enqueue_script('rtc-jquery-ui-js', plugins_url() . '/rtc-slider/assets/js/jquery-ui.js');
}

add_action('admin_enqueue_scripts', 'rtc_admin_register_scripts', 10);


/* front css and js */
function rtc_register_scripts() {
    
    wp_enqueue_style('rtc-carousel', plugins_url() . '/rtc-slider/assets/css/owl.carousel.min.css');
    wp_enqueue_style('rtc-style', plugins_url() . '/rtc-slider/assets/css/style.css');
    
    wp_enqueue_script('rtc-jquery-js', plugins_url() . '/rtc-slider/assets/js/jquery.min.js');
    wp_enqueue_script('rtc-carousel-js', plugins_url() . '/rtc-slider/assets/js/owl.carousel.min.js');
    wp_enqueue_script('rtc-style-js', plugins_url() . '/rtc-slider/assets/js/style.js');
}

add_action('wp_enqueue_scripts', 'rtc_register_scripts', 10);

  
/* rtc_slider menu function */

add_action('admin_menu', 'rtc_admin_custom_menu');

function rtc_admin_custom_menu() { 
    add_menu_page('RTC Slider', 'RTC Slider', 'administrator', 'rtc-slider', 'rtc_slider_function', 'dashicons-media-spreadsheet' );
    //call register settings function
    add_action('admin_init', 'register_rtc_slider_settings');
}


/* register rtc_slider function */

if (!function_exists('register_rtc_slider_settings')) {
    
    function register_rtc_slider_settings() {
        register_setting('rtc_slider-settings-group', 'rtc_image');
    }
}


/* rtc_slider function */

function rtc_slider_function() { 
    wp_enqueue_media();
    
    ?>
    <h2><?php _e('RTC Slider'); ?></h2> 
    <div>
        <form method='post' action='options.php' class="form-wrap">
            <?php
            settings_fields('rtc_slider-settings-group');
            do_settings_sections('rtc_slider-settings-group');
            
            if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == "true") {  //show update msg if data updated
                ?>
                <div class='updated settings-error hide_class' id='setting-error-settings_updated'>
                    <p><strong><?php  _e('Images uploaded successfully.'); ?></strong></p>
                </div>
            <?php } ?>
            <div class="slider-div">
                <label for=""><?php _e('Slider Images Upload :'); ?></label>
                <input type="button" class="button image-upload" value="Upload Images">
            </div>

             <div class="rtc-image-upload">
                <ul>
                    <?php $silder_imgs = get_option('rtc_image'); 
                    if(!empty($silder_imgs)){
                        foreach($silder_imgs as $i => $silder_img){
                            ?>
                            <li>
                                <span class="image-preview">
                                    <img src="<?php echo $silder_img; ?>">
                                    <input type="hidden" name="rtc_image[]" id="rtc_image_<?php echo $i; ?>" class="meta-image" value="<?php echo $silder_img; ?>">
                                </span>
                                <i class=" dashicons dashicons-no delete-img"></i>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php submit_button(); ?>
        </form>
    </div>

    <?php
}


