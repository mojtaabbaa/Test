<?php
/**
 * WordPress Customizer functionality
 *
 * @package Codegen_Pro
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add customizer settings
 */
function codegen_pro_customize_register($wp_customize) {
    
    // Add custom colors section
    $wp_customize->add_section('codegen_pro_colors', array(
        'title'    => __('Theme Colors', 'codegen-pro'),
        'priority' => 30,
    ));

    // Primary color
    $wp_customize->add_setting('primary_color', array(
        'default'           => '#00d4ff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'    => __('Primary Color', 'codegen-pro'),
        'section'  => 'codegen_pro_colors',
        'settings' => 'primary_color',
    )));

    // Secondary color
    $wp_customize->add_setting('secondary_color', array(
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label'    => __('Secondary Color', 'codegen-pro'),
        'section'  => 'codegen_pro_colors',
        'settings' => 'secondary_color',
    )));

    // Hero section
    $wp_customize->add_section('codegen_pro_hero', array(
        'title'    => __('Hero Section', 'codegen-pro'),
        'priority' => 35,
    ));

    // Hero title
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'The OS for Code Agents',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('hero_title', array(
        'label'    => __('Hero Title', 'codegen-pro'),
        'section'  => 'codegen_pro_hero',
        'type'     => 'text',
    ));

    // Hero subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Deploy code agents that plan, build, and review with full context, robust integrations, and production-ready results. Backed by enterprise-grade support. Ship faster with Codegen.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('hero_subtitle', array(
        'label'    => __('Hero Subtitle', 'codegen-pro'),
        'section'  => 'codegen_pro_hero',
        'type'     => 'textarea',
    ));

    // Hero primary button text
    $wp_customize->add_setting('hero_primary_btn_text', array(
        'default'           => 'Get Started',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('hero_primary_btn_text', array(
        'label'    => __('Primary Button Text', 'codegen-pro'),
        'section'  => 'codegen_pro_hero',
        'type'     => 'text',
    ));

    // Hero primary button URL
    $wp_customize->add_setting('hero_primary_btn_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('hero_primary_btn_url', array(
        'label'    => __('Primary Button URL', 'codegen-pro'),
        'section'  => 'codegen_pro_hero',
        'type'     => 'url',
    ));

    // Hero secondary button text
    $wp_customize->add_setting('hero_secondary_btn_text', array(
        'default'           => 'Schedule Demo',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('hero_secondary_btn_text', array(
        'label'    => __('Secondary Button Text', 'codegen-pro'),
        'section'  => 'codegen_pro_hero',
        'type'     => 'text',
    ));

    // Hero secondary button URL
    $wp_customize->add_setting('hero_secondary_btn_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('hero_secondary_btn_url', array(
        'label'    => __('Secondary Button URL', 'codegen-pro'),
        'section'  => 'codegen_pro_hero',
        'type'     => 'url',
    ));

    // Header section
    $wp_customize->add_section('codegen_pro_header', array(
        'title'    => __('Header Settings', 'codegen-pro'),
        'priority' => 40,
    ));

    // Site title override
    $wp_customize->add_setting('site_title', array(
        'default'           => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('site_title', array(
        'label'    => __('Site Title', 'codegen-pro'),
        'section'  => 'codegen_pro_header',
        'type'     => 'text',
    ));

    // Header button 1 text
    $wp_customize->add_setting('header_btn_1_text', array(
        'default'           => 'Login',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('header_btn_1_text', array(
        'label'    => __('Header Button 1 Text', 'codegen-pro'),
        'section'  => 'codegen_pro_header',
        'type'     => 'text',
    ));

    // Header button 1 URL
    $wp_customize->add_setting('header_btn_1_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('header_btn_1_url', array(
        'label'    => __('Header Button 1 URL', 'codegen-pro'),
        'section'  => 'codegen_pro_header',
        'type'     => 'url',
    ));

    // Header button 2 text
    $wp_customize->add_setting('header_btn_2_text', array(
        'default'           => 'Get Started',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('header_btn_2_text', array(
        'label'    => __('Header Button 2 Text', 'codegen-pro'),
        'section'  => 'codegen_pro_header',
        'type'     => 'text',
    ));

    // Header button 2 URL
    $wp_customize->add_setting('header_btn_2_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('header_btn_2_url', array(
        'label'    => __('Header Button 2 URL', 'codegen-pro'),
        'section'  => 'codegen_pro_header',
        'type'     => 'url',
    ));

    // Footer section
    $wp_customize->add_section('codegen_pro_footer', array(
        'title'    => __('Footer Settings', 'codegen-pro'),
        'priority' => 45,
    ));

    // Copyright text
    $wp_customize->add_setting('copyright_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('copyright_text', array(
        'label'       => __('Copyright Text', 'codegen-pro'),
        'section'     => 'codegen_pro_footer',
        'type'        => 'text',
        'description' => __('Leave empty to use default copyright text.', 'codegen-pro'),
    ));

    // Show powered by
    $wp_customize->add_setting('show_powered_by', array(
        'default'           => false,
        'sanitize_callback' => 'codegen_pro_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('show_powered_by', array(
        'label'    => __('Show "Powered by" text', 'codegen-pro'),
        'section'  => 'codegen_pro_footer',
        'type'     => 'checkbox',
    ));

    // Social media section
    $wp_customize->add_section('codegen_pro_social', array(
        'title'    => __('Social Media', 'codegen-pro'),
        'priority' => 50,
    ));

    // Show social links
    $wp_customize->add_setting('show_social_links', array(
        'default'           => true,
        'sanitize_callback' => 'codegen_pro_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('show_social_links', array(
        'label'    => __('Show Social Links', 'codegen-pro'),
        'section'  => 'codegen_pro_social',
        'type'     => 'checkbox',
    ));

    // Social media URLs
    $social_platforms = array(
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter',
        'linkedin'  => 'LinkedIn',
        'instagram' => 'Instagram',
        'youtube'   => 'YouTube',
        'github'    => 'GitHub',
    );

    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting($platform . '_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control($platform . '_url', array(
            'label'    => $label . ' ' . __('URL', 'codegen-pro'),
            'section'  => 'codegen_pro_social',
            'type'     => 'url',
        ));
    }

    // General settings section
    $wp_customize->add_section('codegen_pro_general', array(
        'title'    => __('General Settings', 'codegen-pro'),
        'priority' => 55,
    ));

    // Enable preloader
    $wp_customize->add_setting('enable_preloader', array(
        'default'           => true,
        'sanitize_callback' => 'codegen_pro_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('enable_preloader', array(
        'label'    => __('Enable Preloader', 'codegen-pro'),
        'section'  => 'codegen_pro_general',
        'type'     => 'checkbox',
    ));

    // Show back to top button
    $wp_customize->add_setting('show_back_to_top', array(
        'default'           => true,
        'sanitize_callback' => 'codegen_pro_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('show_back_to_top', array(
        'label'    => __('Show Back to Top Button', 'codegen-pro'),
        'section'  => 'codegen_pro_general',
        'type'     => 'checkbox',
    ));
}
add_action('customize_register', 'codegen_pro_customize_register');

/**
 * Sanitize checkbox
 */
function codegen_pro_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Sanitize select
 */
function codegen_pro_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Sanitize number range
 */
function codegen_pro_sanitize_number_range($number, $setting) {
    $number = absint($number);
    $atts = $setting->manager->get_control($setting->id)->input_attrs;
    $min = (isset($atts['min']) ? $atts['min'] : $number);
    $max = (isset($atts['max']) ? $atts['max'] : $number);
    $step = (isset($atts['step']) ? $atts['step'] : 1);
    return ($min <= $number && $number <= $max && is_int($number / $step) ? $number : $setting->default);
}

/**
 * Customizer live preview
 */
function codegen_pro_customize_preview_js() {
    wp_enqueue_script('codegen-pro-customizer', CODEGEN_PRO_THEME_URI . '/assets/js/customizer.js', array('customize-preview'), CODEGEN_PRO_VERSION, true);
}
add_action('customize_preview_init', 'codegen_pro_customize_preview_js');

/**
 * Customizer controls script
 */
function codegen_pro_customize_controls_js() {
    wp_enqueue_script('codegen-pro-customizer-controls', CODEGEN_PRO_THEME_URI . '/assets/js/customizer-controls.js', array('customize-controls'), CODEGEN_PRO_VERSION, true);
}
add_action('customize_controls_enqueue_scripts', 'codegen_pro_customize_controls_js');

/**
 * Add custom CSS for customizer
 */
function codegen_pro_customizer_css() {
    ?>
    <style type="text/css">
        .customize-control-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .customize-control-description {
            font-style: italic;
            color: #666;
            margin-bottom: 10px;
        }
        
        .customize-section-title {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        
        .customize-control-color .wp-picker-container {
            margin-top: 5px;
        }
        
        .customize-control input[type="text"],
        .customize-control input[type="url"],
        .customize-control textarea {
            width: 100%;
            margin-top: 5px;
        }
        
        .customize-control textarea {
            min-height: 80px;
            resize: vertical;
        }
        
        .customize-control-checkbox input[type="checkbox"] {
            margin-right: 8px;
        }
    </style>
    <?php
}
add_action('customize_controls_print_styles', 'codegen_pro_customizer_css');

/**
 * Bind JS handlers to instantly live-preview changes
 */
function codegen_pro_customize_preview_init() {
    ?>
    <script type="text/javascript">
    (function($) {
        // Site title
        wp.customize('site_title', function(value) {
            value.bind(function(newval) {
                $('.site-logo a').text(newval);
            });
        });

        // Hero title
        wp.customize('hero_title', function(value) {
            value.bind(function(newval) {
                $('.hero-title').text(newval);
            });
        });

        // Hero subtitle
        wp.customize('hero_subtitle', function(value) {
            value.bind(function(newval) {
                $('.hero-subtitle').text(newval);
            });
        });

        // Hero primary button text
        wp.customize('hero_primary_btn_text', function(value) {
            value.bind(function(newval) {
                $('.hero-cta .btn-primary').text(newval);
            });
        });

        // Hero secondary button text
        wp.customize('hero_secondary_btn_text', function(value) {
            value.bind(function(newval) {
                $('.hero-cta .btn-secondary').text(newval);
            });
        });

        // Header button 1 text
        wp.customize('header_btn_1_text', function(value) {
            value.bind(function(newval) {
                $('.header-cta .btn-secondary').text(newval);
            });
        });

        // Header button 2 text
        wp.customize('header_btn_2_text', function(value) {
            value.bind(function(newval) {
                $('.header-cta .btn-primary').text(newval);
            });
        });

        // Copyright text
        wp.customize('copyright_text', function(value) {
            value.bind(function(newval) {
                if (newval) {
                    $('.copyright').text(newval);
                }
            });
        });

        // Primary color
        wp.customize('primary_color', function(value) {
            value.bind(function(newval) {
                $('head').append('<style>.btn-primary, .text-gradient, .hero-title { background: linear-gradient(135deg, ' + newval + ' 0%, ' + darkenColor(newval, 20) + ' 100%); }</style>');
            });
        });

        // Secondary color
        wp.customize('secondary_color', function(value) {
            value.bind(function(newval) {
                $('head').append('<style>.feature-card, .testimonial-card { background: ' + newval + '; }</style>');
            });
        });

        // Helper function to darken color
        function darkenColor(hex, percent) {
            hex = hex.replace('#', '');
            var r = parseInt(hex.substr(0, 2), 16);
            var g = parseInt(hex.substr(2, 2), 16);
            var b = parseInt(hex.substr(4, 2), 16);
            
            r = Math.max(0, Math.min(255, r - (r * percent / 100)));
            g = Math.max(0, Math.min(255, g - (g * percent / 100)));
            b = Math.max(0, Math.min(255, b - (b * percent / 100)));
            
            return '#' + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
        }
    })(jQuery);
    </script>
    <?php
}
add_action('customize_preview_init', 'codegen_pro_customize_preview_init');
