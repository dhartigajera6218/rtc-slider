<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Rtc_Slider
 * @subpackage Rtc_Slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rtc_Slider
 * @subpackage Rtc_Slider/public
 * @author     Dharti Gajera <dhartigajera6218@gmail.com>
 */
class Rtc_Slider_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/owl.carousel.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtc-slider-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jquery.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/owl.carousel.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rtc-slider-public.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Slider section callback
	 */
	public function rtc_slider_section( $atts = array() ) {
		
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

}
