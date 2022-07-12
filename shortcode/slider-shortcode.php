<?php
/**
 * Slider section callback
 */
function rtc_slider_section( $atts ) {
    
    $a = shortcode_atts( array(
        'title' => __('Slider', 'rtc-theme'),
    ), $atts );
    
    ob_start(); 
    
    $silder_imgs = get_option('rtc_image'); 
    if(!empty($silder_imgs)){
    ?>
    <div class="slider-posts">
    
        <div class="content">
            <h3><?php _e('Slider'); ?></h3>
        </div>
        <div class="owl-carousel owl-theme">
        <?php foreach($silder_imgs as $silder_img){ ?>
            <div class="item">
                <div class="image">
                    <img src="<?php echo $silder_img; ?>" alt="<?php _e('image'); ?>">
                </div>
            </div>
            <?php } ?>
        </div>
        <?php 
            wp_reset_postdata();
        }
    ?>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode( 'rtc_slider', 'rtc_slider_section' );