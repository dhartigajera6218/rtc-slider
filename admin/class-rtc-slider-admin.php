<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Rtc_Slider
 * @subpackage Rtc_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rtc_Slider
 * @subpackage Rtc_Slider/admin
 * @author     Dharti Gajera <dhartigajera6218@gmail.com>
 */
class Rtc_Slider_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rtc_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rtc_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtc-slider-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rtc_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rtc_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rtc-slider-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jquery-ui.js', array( 'jquery' ), $this->version, false );

	}
	
	public function rtc_admin_custom_menu() { 
		add_menu_page('RTC Slider', 'RTC Slider', 'administrator', 'rtc-slider', array($this, 'rtc_slider_function'), 'dashicons-media-spreadsheet' );
		//call register settings function
		add_action('admin_init', array($this, 'register_rtc_slider_settings'));
	}
	
	/* register rtc_slider function */
		
	public function register_rtc_slider_settings() {
		register_setting('rtc_slider-settings-group', 'rtc_image');
	}
	
	/* rtc_slider function */

	public function rtc_slider_function() { 
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

}
