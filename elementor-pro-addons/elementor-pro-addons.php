<?php
/**
 * Plugin Name: Elementor Pro Addons
 * Plugin URI: https://example.com/elementor-pro-addons
 * Description: مجموعه‌ای از ویجت‌های حرفه‌ای و پرکاربرد برای Elementor با پنل مدیریت کامل
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * Text Domain: elementor-pro-addons
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 * Elementor tested up to: 3.18
 * Elementor Pro tested up to: 3.18
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define plugin constants
define('ELEMENTOR_PRO_ADDONS_VERSION', '1.0.0');
define('ELEMENTOR_PRO_ADDONS_FILE', __FILE__);
define('ELEMENTOR_PRO_ADDONS_PATH', plugin_dir_path(__FILE__));
define('ELEMENTOR_PRO_ADDONS_URL', plugin_dir_url(__FILE__));
define('ELEMENTOR_PRO_ADDONS_ASSETS', ELEMENTOR_PRO_ADDONS_URL . 'assets/');

/**
 * Main Elementor Pro Addons Class
 */
final class Elementor_Pro_Addons {

    /**
     * Plugin Version
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

    /**
     * Minimum PHP Version
     */
    const MINIMUM_PHP_VERSION = '7.4';

    /**
     * Instance
     */
    private static $_instance = null;

    /**
     * Instance
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Initialize the plugin
     */
    public function init() {
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Load plugin files
        $this->load_files();

        // Initialize plugin
        add_action('elementor/init', [$this, 'elementor_init']);

        // Load textdomain
        add_action('init', [$this, 'load_textdomain']);

        // Add plugin action links
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), [$this, 'plugin_action_links']);
    }

    /**
     * Load plugin files
     */
    private function load_files() {
        // Load admin class
        require_once ELEMENTOR_PRO_ADDONS_PATH . 'includes/admin/class-admin.php';
        
        // Load widgets manager
        require_once ELEMENTOR_PRO_ADDONS_PATH . 'includes/class-widgets-manager.php';
        
        // Load helper functions
        require_once ELEMENTOR_PRO_ADDONS_PATH . 'includes/helper-functions.php';
    }

    /**
     * Initialize Elementor
     */
    public function elementor_init() {
        // Initialize widgets manager
        new \Elementor_Pro_Addons\Widgets_Manager();
        
        // Initialize admin
        if (is_admin()) {
            new \Elementor_Pro_Addons\Admin\Admin();
        }
    }

    /**
     * Load textdomain
     */
    public function load_textdomain() {
        load_plugin_textdomain('elementor-pro-addons', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Plugin action links
     */
    public function plugin_action_links($links) {
        $settings_link = sprintf(
            '<a href="%s">%s</a>',
            admin_url('admin.php?page=elementor-pro-addons'),
            __('تنظیمات', 'elementor-pro-addons')
        );
        array_unshift($links, $settings_link);
        return $links;
    }

    /**
     * Admin notice - Missing main plugin
     */
    public function admin_notice_missing_main_plugin() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            esc_html__('"%1$s" نیاز به "%2$s" دارد تا نصب و فعال باشد.', 'elementor-pro-addons'),
            '<strong>' . esc_html__('Elementor Pro Addons', 'elementor-pro-addons') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-pro-addons') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice - Minimum Elementor version
     */
    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            esc_html__('"%1$s" نیاز به "%2$s" نسخه %3$s یا بالاتر دارد.', 'elementor-pro-addons'),
            '<strong>' . esc_html__('Elementor Pro Addons', 'elementor-pro-addons') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-pro-addons') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice - Minimum PHP version
     */
    public function admin_notice_minimum_php_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            esc_html__('"%1$s" نیاز به PHP نسخه %2$s یا بالاتر دارد. نسخه فعلی شما %3$s است.', 'elementor-pro-addons'),
            '<strong>' . esc_html__('Elementor Pro Addons', 'elementor-pro-addons') . '</strong>',
            self::MINIMUM_PHP_VERSION,
            PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
}

// Initialize the plugin
Elementor_Pro_Addons::instance();

