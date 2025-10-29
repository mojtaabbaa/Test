<?php
/**
 * Elementor Manager Class
 *
 * @package Codegen_Pro
 */

namespace Codegen_Pro\Elementor;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Elementor Manager Class
 */
class Elementor_Manager {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('elementor/widgets/widgets_registered', array($this, 'register_widgets'));
        add_action('elementor/elements/categories_registered', array($this, 'register_categories'));
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_widget_styles'));
        add_action('elementor/frontend/after_register_scripts', array($this, 'enqueue_widget_scripts'));
    }
    
    /**
     * Register custom widget categories
     */
    public function register_categories($elements_manager) {
        $elements_manager->add_category(
            'codegen-pro',
            array(
                'title' => esc_html__('Codegen Pro', 'codegen-pro'),
                'icon' => 'fa fa-code',
            )
        );
    }
    
    /**
     * Register custom widgets
     */
    public function register_widgets($widgets_manager) {
        // Include widget files
        $this->include_widget_files();
        
        // Register widgets
        $widgets = array(
            'Hero_Widget',
            'Integrations_Widget',
            'Trusted_Teams_Widget',
            'Features_Grid_Widget',
            'Process_Steps_Widget',
            'Models_Widget',
            'Testimonials_Widget',
            'Stats_Widget',
            'Pricing_Widget',
            'Enterprise_Widget',
            'Partnership_Widget',
        );
        
        foreach ($widgets as $widget) {
            $widget_class = 'Codegen_Pro\\Elementor\\Widgets\\' . $widget;
            if (class_exists($widget_class)) {
                $widgets_manager->register_widget_type(new $widget_class());
            }
        }
    }
    
    /**
     * Include widget files
     */
    private function include_widget_files() {
        $widget_files = array(
            'hero-widget',
            'integrations-widget',
            'trusted-teams-widget',
            'features-grid-widget',
            'process-steps-widget',
            'models-widget',
            'testimonials-widget',
            'stats-widget',
            'pricing-widget',
            'enterprise-widget',
            'partnership-widget',
        );
        
        foreach ($widget_files as $file) {
            $file_path = CODEGEN_PRO_THEME_DIR . '/inc/elementor/widgets/class-' . $file . '.php';
            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }
    }
    
    /**
     * Enqueue widget styles
     */
    public function enqueue_widget_styles() {
        wp_enqueue_style(
            'codegen-pro-elementor-widgets',
            CODEGEN_PRO_THEME_URL . '/assets/css/elementor-widgets.css',
            array(),
            CODEGEN_PRO_VERSION
        );
    }
    
    /**
     * Enqueue widget scripts
     */
    public function enqueue_widget_scripts() {
        wp_enqueue_script(
            'codegen-pro-elementor-widgets',
            CODEGEN_PRO_THEME_URL . '/assets/js/elementor-widgets.js',
            array('jquery', 'elementor-frontend'),
            CODEGEN_PRO_VERSION,
            true
        );
    }
}
