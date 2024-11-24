<?php

/**
 * Plugin Name: Elementor Agency Addon
 * Description: Custom Elementor addon for agency theme.
 * Plugin URI:  https://techtohid.com/
 * Version:     1.0.0
 * Author:      Tohidur Rahman
 * Author URI:  https://techtohid.com/
 * Text Domain: elmntr-agency
 * Domain Path: /languages
 */


if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Elementor_Agency_Addon
{

    /**
     * Plugin Version
     *
     * @since 1.0.0
     *
     * @var string The plugin version.
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     *
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     *
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     * @var Elementor_Agency_Addon The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     * @return Elementor_Agency_Addon An instance of the class.
     */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct()
    {

        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n()
    {

        load_plugin_textdomain('elmntr-agency', FALSE, basename(dirname(__FILE__)) . '/languages/');
    }



    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_main_plugin()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elmntr-agency'),
            '<strong>' . esc_html__('Elementor Common Extension', 'elmntr-agency') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elmntr-agency') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_elementor_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elmntr-agency'),
            '<strong>' . esc_html__('Elementor Common Extension', 'elmntr-agency') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elmntr-agency') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elmntr-agency'),
            '<strong>' . esc_html__('Elementor Common Extension', 'elmntr-agency') . '</strong>',
            '<strong>' . esc_html__('PHP', 'elmntr-agency') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }


    /**
     * Initialize the plugin
     *
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed load the files required to run the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init()
    {

        // Check if Elementor installed and activated
        if (! did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (! version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        add_action('elementor/frontend/after_enqueue_styles', [$this, 'widget_styles']);

        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'widget_scripts']);


        // Add Plugin actions
        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
        add_action('elementor/controls/controls_registered', [$this, 'init_controls']);

        // Category Init
        add_action('elementor/elements/categories_registered', [$this, 'elementor_agency_category']);
    }

    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_widgets($widgets_manager)
    {

        require_once(__DIR__ . '/widgets/agency-section-title.php');
        require_once(__DIR__ . '/widgets/agency-about.php');
        require_once(__DIR__ . '/widgets/agency-slider.php');
        require_once(__DIR__ . '/widgets/agency-faq.php');
        require_once(__DIR__ . '/widgets/agency-services.php');
        require_once(__DIR__ . '/widgets/agency-counter.php');
        require_once(__DIR__ . '/widgets/agency-team.php');
        require_once(__DIR__ . '/widgets/agency-testimonial.php');
        require_once(__DIR__ . '/widgets/agency-blog.php');
        require_once(__DIR__ . '/widgets/agency-cta.php');
        require_once(__DIR__ . '/widgets/agency-gallery.php');
        require_once(__DIR__ . '/widgets/agency-contact.php');

        // added by EWA - EWA own Register widgets, loading all widget names
        $widgets_manager->register( new \Agency_Section_Title() );
        $widgets_manager->register( new \Agency_About_Section() );
        $widgets_manager->register( new \Agency_Slider_Section() );
        $widgets_manager->register( new \Agency_FAQ_Section() );
        $widgets_manager->register( new \Agency_Services_Section() );
        $widgets_manager->register( new \Agency_Counter_Section() );
        $widgets_manager->register( new \Agency_Team_Section() );
        $widgets_manager->register( new \Agency_Blog_Section() );
        $widgets_manager->register( new \Agency_CTA_Section() );
        $widgets_manager->register( new \Agency_Gallery_Section() );
        $widgets_manager->register( new \Agency_Contact_Section() );
    }

    /**
     * Init Controls
     *
     * Include controls files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_controls()
    {

        /*
		* Todo: this block needs to be commented out when the custom control is ready
		*
		*
		// Include Control files
		require_once( __DIR__ . '/controls/test-control.php' );

		// Register control
		\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );
		*/
    }

    // Custom CSS
    public function widget_styles()
    {
        wp_register_style('agency-owl', plugins_url('assets/css/owl.carousel.css', __FILE__));
        wp_enqueue_style('agency-owl');
        wp_register_style('agency-magnific', plugins_url('assets/css/magnific-popup.css', __FILE__));
        wp_enqueue_style('agency-magnific');
    }

    // Custom JS
    public function widget_scripts()
    {
        wp_register_script('agency-owl-js', plugins_url('assets/js/owl.carousel.min.js', __FILE__));
        wp_enqueue_script('agency-owl-js');
        wp_register_script('agency-magnific-js', plugins_url('assets/js/jquery.magnific-popup.min.js', __FILE__));
        wp_enqueue_script('agency-magnific-js');
    }

    // Custom Category
    public function elementor_agency_category($elements_manager)
    {

        $elements_manager->add_category(
            'elementor_agency_addon',
            [
                'title' => __('Agency Category', 'elmntr-agency'),
                'icon' => 'fa fa-plug', //default icon
            ],
            2 // position
        );
    }
}

Elementor_Agency_Addon::instance();
