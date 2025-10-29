<?php
/**
 * Main Theme Class
 *
 * @package Codegen_Pro
 */

namespace Codegen_Pro;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main Theme Class
 */
class Theme {
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->init_hooks();
        $this->init_components();
    }
    
    /**
     * Initialize hooks
     */
    private function init_hooks() {
        add_action('after_setup_theme', array($this, 'setup'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('widgets_init', array($this, 'widgets_init'));
        add_action('init', array($this, 'init'));
    }
    
    /**
     * Initialize theme components
     */
    private function init_components() {
        // Initialize Assets Manager
        new Assets();
        
        // Initialize Elementor Manager if Elementor is active
        if (did_action('elementor/loaded')) {
            new Elementor\Elementor_Manager();
        }
    }
    
    /**
     * Theme setup
     */
    public function setup() {
        // Make theme available for translation
        load_theme_textdomain('codegen-pro', CODEGEN_PRO_THEME_DIR . '/languages');
        
        // Add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');
        
        // Let WordPress manage the document title
        add_theme_support('title-tag');
        
        // Enable support for Post Thumbnails on posts and pages
        add_theme_support('post-thumbnails');
        
        // Add support for responsive embedded content
        add_theme_support('responsive-embeds');
        
        // Add support for editor styles
        add_theme_support('editor-styles');
        
        // Add support for full and wide align images
        add_theme_support('align-wide');
        
        // Add support for custom logo
        add_theme_support('custom-logo', array(
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
        ));
        
        // Add support for HTML5 markup
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script'
        ));
        
        // Add support for selective refresh for widgets
        add_theme_support('customize-selective-refresh-widgets');
        
        // Add support for post formats
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'audio'
        ));
        
        // Register navigation menus
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'codegen-pro'),
            'footer' => esc_html__('Footer Menu', 'codegen-pro'),
        ));
        
        // Add custom image sizes
        add_image_size('codegen-pro-featured', 800, 600, true);
        add_image_size('codegen-pro-thumbnail', 300, 300, true);
        add_image_size('codegen-pro-large', 1200, 800, true);
    }
    
    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts() {
        // Main theme stylesheet
        wp_enqueue_style(
            'codegen-pro-style',
            get_stylesheet_uri(),
            array(),
            CODEGEN_PRO_VERSION
        );
        
        // Main theme styles
        wp_enqueue_style(
            'codegen-pro-main',
            CODEGEN_PRO_THEME_URL . '/assets/css/codegen-style.css',
            array(),
            CODEGEN_PRO_VERSION
        );
        
        // Google Fonts - Inter
        wp_enqueue_style(
            'codegen-pro-fonts',
            'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap',
            array(),
            null
        );
        
        // Main theme script
        wp_enqueue_script(
            'codegen-pro-main',
            CODEGEN_PRO_THEME_URL . '/assets/js/codegen-scripts.js',
            array('jquery'),
            CODEGEN_PRO_VERSION,
            true
        );
        
        // Localize script
        wp_localize_script('codegen-pro-main', 'codegenPro', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('codegen_pro_nonce'),
            'themeUrl' => CODEGEN_PRO_THEME_URL,
        ));
        
        // Comment reply script
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
    
    /**
     * Register widget areas
     */
    public function widgets_init() {
        register_sidebar(array(
            'name'          => esc_html__('Sidebar', 'codegen-pro'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'codegen-pro'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
        
        register_sidebar(array(
            'name'          => esc_html__('Footer 1', 'codegen-pro'),
            'id'            => 'footer-1',
            'description'   => esc_html__('Add widgets here.', 'codegen-pro'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        
        register_sidebar(array(
            'name'          => esc_html__('Footer 2', 'codegen-pro'),
            'id'            => 'footer-2',
            'description'   => esc_html__('Add widgets here.', 'codegen-pro'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
        
        register_sidebar(array(
            'name'          => esc_html__('Footer 3', 'codegen-pro'),
            'id'            => 'footer-3',
            'description'   => esc_html__('Add widgets here.', 'codegen-pro'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
    
    /**
     * Initialize theme
     */
    public function init() {
        // Security enhancements
        $this->security_enhancements();
        
        // Performance optimizations
        $this->performance_optimizations();
    }
    
    /**
     * Security enhancements
     */
    private function security_enhancements() {
        // Remove WordPress version from head
        remove_action('wp_head', 'wp_generator');
        
        // Remove RSD link
        remove_action('wp_head', 'rsd_link');
        
        // Remove wlwmanifest link
        remove_action('wp_head', 'wlwmanifest_link');
        
        // Remove shortlink
        remove_action('wp_head', 'wp_shortlink_wp_head');
    }
    
    /**
     * Performance optimizations
     */
    private function performance_optimizations() {
        // Remove emoji scripts
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');
        
        // Remove jQuery migrate
        add_action('wp_default_scripts', array($this, 'remove_jquery_migrate'));
    }
    
    /**
     * Remove jQuery migrate
     */
    public function remove_jquery_migrate($scripts) {
        if (!is_admin() && isset($scripts->registered['jquery'])) {
            $script = $scripts->registered['jquery'];
            if ($script->deps) {
                $script->deps = array_diff($script->deps, array('jquery-migrate'));
            }
        }
    }
}
