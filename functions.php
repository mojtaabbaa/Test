<?php
/**
 * Codegen Pro Theme Functions
 * 
 * @package Codegen_Pro
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('CODEGEN_PRO_VERSION', '2.0.0');
define('CODEGEN_PRO_THEME_DIR', get_template_directory());
define('CODEGEN_PRO_THEME_URL', get_template_directory_uri());
define('CODEGEN_PRO_THEME_PATH', get_template_directory());

// Autoloader for theme classes
spl_autoload_register(function ($class) {
    $prefix = 'Codegen_Pro\\';
    $base_dir = CODEGEN_PRO_THEME_DIR . '/inc/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relative_class = substr($class, $len);
    $file = $base_dir . 'class-' . str_replace('\\', '/', strtolower(str_replace('_', '-', $relative_class))) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

/**
 * Initialize theme
 */
function codegen_pro_init() {
    // Initialize main theme class
    if (class_exists('Codegen_Pro\\Theme')) {
        new Codegen_Pro\Theme();
    }
}
add_action('after_setup_theme', 'codegen_pro_init');

/**
 * Fallback for when classes are not loaded
 */
function codegen_pro_fallback_setup() {
    // Basic theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'codegen-pro'),
        'footer' => esc_html__('Footer Menu', 'codegen-pro'),
    ));
    
    // Enqueue basic styles
    wp_enqueue_style('codegen-pro-style', get_stylesheet_uri(), array(), CODEGEN_PRO_VERSION);
}

// Fallback if main class doesn't exist
if (!class_exists('Codegen_Pro\\Theme')) {
    add_action('after_setup_theme', 'codegen_pro_fallback_setup');
}

