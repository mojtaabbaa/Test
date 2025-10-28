<?php
namespace Elementor_Pro_Addons;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Widgets Manager Class
 */
class Widgets_Manager {

    /**
     * Available widgets
     */
    private $widgets = [
        'advanced-heading' => [
            'title' => 'عنوان پیشرفته',
            'icon' => 'eicon-heading',
            'categories' => ['pro-addons'],
            'keywords' => ['heading', 'title', 'عنوان'],
            'file' => 'advanced-heading.php',
            'class' => 'Advanced_Heading_Widget'
        ],
        'info-box' => [
            'title' => 'جعبه اطلاعات',
            'icon' => 'eicon-info-box',
            'categories' => ['pro-addons'],
            'keywords' => ['info', 'box', 'اطلاعات'],
            'file' => 'info-box.php',
            'class' => 'Info_Box_Widget'
        ],
        'testimonial-carousel' => [
            'title' => 'اسلایدر نظرات',
            'icon' => 'eicon-testimonial-carousel',
            'categories' => ['pro-addons'],
            'keywords' => ['testimonial', 'carousel', 'نظرات'],
            'file' => 'testimonial-carousel.php',
            'class' => 'Testimonial_Carousel_Widget'
        ],
        'pricing-table' => [
            'title' => 'جدول قیمت',
            'icon' => 'eicon-price-table',
            'categories' => ['pro-addons'],
            'keywords' => ['pricing', 'table', 'قیمت'],
            'file' => 'pricing-table.php',
            'class' => 'Pricing_Table_Widget'
        ],
        'team-member' => [
            'title' => 'عضو تیم',
            'icon' => 'eicon-person',
            'categories' => ['pro-addons'],
            'keywords' => ['team', 'member', 'تیم'],
            'file' => 'team-member.php',
            'class' => 'Team_Member_Widget'
        ]
    ];

    /**
     * Constructor
     */
    public function __construct() {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_frontend_styles']);
        add_action('elementor/frontend/after_register_scripts', [$this, 'enqueue_frontend_scripts']);
    }

    /**
     * Register widgets
     */
    public function register_widgets($widgets_manager) {
        $enabled_widgets = get_option('elementor_pro_addons_widgets', array_keys($this->widgets));

        foreach ($this->widgets as $widget_key => $widget_data) {
            if (in_array($widget_key, $enabled_widgets)) {
                $widget_file = ELEMENTOR_PRO_ADDONS_PATH . 'includes/widgets/' . $widget_data['file'];
                
                if (file_exists($widget_file)) {
                    require_once $widget_file;
                    
                    $widget_class = '\\Elementor_Pro_Addons\\Widgets\\' . $widget_data['class'];
                    
                    if (class_exists($widget_class)) {
                        $widgets_manager->register(new $widget_class());
                    }
                }
            }
        }
    }

    /**
     * Add widget categories
     */
    public function add_elementor_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'pro-addons',
            [
                'title' => __('Pro Addons', 'elementor-pro-addons'),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Enqueue frontend styles
     */
    public function enqueue_frontend_styles() {
        wp_enqueue_style(
            'elementor-pro-addons-frontend',
            ELEMENTOR_PRO_ADDONS_ASSETS . 'css/frontend.css',
            [],
            ELEMENTOR_PRO_ADDONS_VERSION
        );
    }

    /**
     * Enqueue frontend scripts
     */
    public function enqueue_frontend_scripts() {
        wp_enqueue_script(
            'elementor-pro-addons-frontend',
            ELEMENTOR_PRO_ADDONS_ASSETS . 'js/frontend.js',
            ['jquery'],
            ELEMENTOR_PRO_ADDONS_VERSION,
            true
        );
    }

    /**
     * Get available widgets
     */
    public function get_widgets() {
        return $this->widgets;
    }

    /**
     * Get widget data
     */
    public function get_widget($widget_key) {
        return isset($this->widgets[$widget_key]) ? $this->widgets[$widget_key] : false;
    }
}

