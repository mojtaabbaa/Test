<?php
/**
 * Codegen Pro functions and definitions
 *
 * @package Codegen_Pro
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define theme constants
 */
define('CODEGEN_PRO_VERSION', '1.0.0');
define('CODEGEN_PRO_THEME_DIR', get_template_directory());
define('CODEGEN_PRO_THEME_URI', get_template_directory_uri());

/**
 * Theme setup
 */
function codegen_pro_setup() {
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
        'script',
    ));

    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => '0a0a0a',
    ));

    // Add support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'codegen-pro'),
        'footer'  => esc_html__('Footer Menu', 'codegen-pro'),
    ));

    // Add support for Elementor
    add_theme_support('elementor');
}
add_action('after_setup_theme', 'codegen_pro_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet
 */
function codegen_pro_content_width() {
    $GLOBALS['content_width'] = apply_filters('codegen_pro_content_width', 1200);
}
add_action('after_setup_theme', 'codegen_pro_content_width', 0);

/**
 * Enqueue scripts and styles
 */
function codegen_pro_scripts() {
    // Main theme stylesheet
    wp_enqueue_style('codegen-pro-style', get_stylesheet_uri(), array(), CODEGEN_PRO_VERSION);

    // Additional theme styles
    wp_enqueue_style('codegen-pro-main', CODEGEN_PRO_THEME_URI . '/assets/css/main.css', array(), CODEGEN_PRO_VERSION);

    // Google Fonts
    wp_enqueue_style('codegen-pro-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);

    // Main theme script
    wp_enqueue_script('codegen-pro-main', CODEGEN_PRO_THEME_URI . '/assets/js/main.js', array('jquery'), CODEGEN_PRO_VERSION, true);

    // Animation script
    wp_enqueue_script('codegen-pro-animations', CODEGEN_PRO_THEME_URI . '/assets/js/animations.js', array('jquery'), CODEGEN_PRO_VERSION, true);

    // Localize script for AJAX
    wp_localize_script('codegen-pro-main', 'codegen_pro_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('codegen_pro_nonce'),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'codegen_pro_scripts');

/**
 * Enqueue admin scripts and styles
 */
function codegen_pro_admin_scripts($hook) {
    // Only load on theme options page
    if ('appearance_page_codegen-pro-options' !== $hook) {
        return;
    }

    wp_enqueue_style('codegen-pro-admin', CODEGEN_PRO_THEME_URI . '/assets/css/admin-style.css', array(), CODEGEN_PRO_VERSION);
    wp_enqueue_script('codegen-pro-admin', CODEGEN_PRO_THEME_URI . '/assets/js/admin-script.js', array('jquery'), CODEGEN_PRO_VERSION, true);
}
add_action('admin_enqueue_scripts', 'codegen_pro_admin_scripts');

/**
 * Register widget areas
 */
function codegen_pro_widgets_init() {
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
add_action('widgets_init', 'codegen_pro_widgets_init');

/**
 * Include theme files
 */
if (file_exists(CODEGEN_PRO_THEME_DIR . '/inc/theme-setup.php')) {
    require_once CODEGEN_PRO_THEME_DIR . '/inc/theme-setup.php';
}

if (file_exists(CODEGEN_PRO_THEME_DIR . '/inc/customizer.php')) {
    require_once CODEGEN_PRO_THEME_DIR . '/inc/customizer.php';
}

if (file_exists(CODEGEN_PRO_THEME_DIR . '/inc/theme-options.php')) {
    require_once CODEGEN_PRO_THEME_DIR . '/inc/theme-options.php';
}

// Include Elementor support if Elementor is active
if (defined('ELEMENTOR_VERSION') && file_exists(CODEGEN_PRO_THEME_DIR . '/inc/elementor-support.php')) {
    require_once CODEGEN_PRO_THEME_DIR . '/inc/elementor-support.php';
}

/**
 * Custom excerpt length
 */
function codegen_pro_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'codegen_pro_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function codegen_pro_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'codegen_pro_excerpt_more');

/**
 * Add custom body classes
 */
function codegen_pro_body_classes($classes) {
    // Add class for Elementor
    if (defined('ELEMENTOR_VERSION')) {
        $classes[] = 'elementor-enabled';
    }

    // Add class for front page
    if (is_front_page()) {
        $classes[] = 'front-page';
    }

    return $classes;
}
add_filter('body_class', 'codegen_pro_body_classes');

/**
 * Add preloader HTML
 */
function codegen_pro_preloader() {
    if (get_theme_mod('enable_preloader', true)) {
        echo '<div id="preloader">
            <div class="preloader-content">
                <div class="spinner"></div>
                <p>Loading...</p>
            </div>
        </div>';
    }
}
add_action('wp_body_open', 'codegen_pro_preloader');

/**
 * Custom comment form
 */
function codegen_pro_comment_form($args) {
    $args['class_submit'] = 'btn btn-primary';
    $args['class_form'] = 'comment-form';
    return $args;
}
add_filter('comment_form_defaults', 'codegen_pro_comment_form');

/**
 * Add custom CSS for theme customizations
 */
function codegen_pro_custom_css() {
    $custom_css = '';
    
    // Primary color
    $primary_color = get_theme_mod('primary_color', '#00d4ff');
    if ($primary_color !== '#00d4ff') {
        $custom_css .= "
        .btn-primary,
        .text-gradient,
        .hero-title {
            background: linear-gradient(135deg, {$primary_color} 0%, " . codegen_pro_darken_color($primary_color, 20) . " 100%);
        }
        .btn-primary:hover {
            box-shadow: 0 10px 25px " . codegen_pro_hex_to_rgba($primary_color, 0.3) . ";
        }
        ";
    }
    
    // Secondary color
    $secondary_color = get_theme_mod('secondary_color', '#1a1a1a');
    if ($secondary_color !== '#1a1a1a') {
        $custom_css .= "
        .feature-card,
        .testimonial-card {
            background: {$secondary_color};
        }
        ";
    }
    
    if (!empty($custom_css)) {
        echo '<style type="text/css">' . $custom_css . '</style>';
    }
}
add_action('wp_head', 'codegen_pro_custom_css');

/**
 * Helper function to darken color
 */
function codegen_pro_darken_color($hex, $percent) {
    $hex = str_replace('#', '', $hex);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    $r = max(0, min(255, $r - ($r * $percent / 100)));
    $g = max(0, min(255, $g - ($g * $percent / 100)));
    $b = max(0, min(255, $b - ($b * $percent / 100)));
    
    return sprintf('#%02x%02x%02x', $r, $g, $b);
}

/**
 * Helper function to convert hex to rgba
 */
function codegen_pro_hex_to_rgba($hex, $alpha = 1) {
    $hex = str_replace('#', '', $hex);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    return "rgba({$r}, {$g}, {$b}, {$alpha})";
}

/**
 * Add theme support for Gutenberg
 */
function codegen_pro_gutenberg_support() {
    // Add support for editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => esc_html__('Primary', 'codegen-pro'),
            'slug'  => 'primary',
            'color' => '#00d4ff',
        ),
        array(
            'name'  => esc_html__('Secondary', 'codegen-pro'),
            'slug'  => 'secondary',
            'color' => '#1a1a1a',
        ),
        array(
            'name'  => esc_html__('White', 'codegen-pro'),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
        array(
            'name'  => esc_html__('Black', 'codegen-pro'),
            'slug'  => 'black',
            'color' => '#0a0a0a',
        ),
    ));

    // Add support for custom font sizes
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_html__('Small', 'codegen-pro'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__('Regular', 'codegen-pro'),
            'size' => 16,
            'slug' => 'regular'
        ),
        array(
            'name' => esc_html__('Large', 'codegen-pro'),
            'size' => 24,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__('Extra Large', 'codegen-pro'),
            'size' => 32,
            'slug' => 'extra-large'
        )
    ));
}
add_action('after_setup_theme', 'codegen_pro_gutenberg_support');

/**
 * Security enhancements
 */
function codegen_pro_security() {
    // Remove WordPress version from head
    remove_action('wp_head', 'wp_generator');
    
    // Remove RSD link
    remove_action('wp_head', 'rsd_link');
    
    // Remove wlwmanifest link
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'codegen_pro_security');

/**
 * Performance optimizations
 */
function codegen_pro_performance() {
    // Remove emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'codegen_pro_performance');

/**
 * Remove jQuery migrate
 */
function codegen_pro_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', 'codegen_pro_remove_jquery_migrate');
