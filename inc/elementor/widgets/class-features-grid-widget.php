<?php
/**
 * Features Grid Widget
 *
 * @package Codegen_Pro
 */

namespace Codegen_Pro\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Icons_Manager;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Features Grid Widget Class
 */
class Features_Grid_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-features-grid';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Features Grid', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    
    /**
     * Get widget categories
     */
    public function get_categories() {
        return ['codegen-pro'];
    }
    
    /**
     * Get widget keywords
     */
    public function get_keywords() {
        return ['features', 'grid', 'services', 'codegen'];
    }
    
    /**
     * Register widget controls
     */
    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Everything you need to run code agents at scale', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'codegen-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Deploy with confidence using enterprise-grade infrastructure and security.', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Features Section
        $this->start_controls_section(
            'features_section',
            [
                'label' => esc_html__('Features', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'codegen-pro'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );
        
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'codegen-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Feature description goes here.', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'features_list',
            [
                'label' => esc_html__('Features', 'codegen-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'icon' => [
                            'value' => 'fas fa-shield-alt',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Repository rules',
                        'description' => 'Enforce coding standards and security policies across all repositories.',
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-cube',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Sandbox environments',
                        'description' => 'Isolated execution environments for safe code testing and deployment.',
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-users-cog',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Granular agent permissions',
                        'description' => 'Fine-grained access control for different agent capabilities.',
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-camera',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Snapshots & image cache',
                        'description' => 'Fast deployment with cached environments and snapshots.',
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-plug',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Deep integration panel',
                        'description' => 'Comprehensive dashboard for managing all your integrations.',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Container
        $this->start_controls_section(
            'container_style',
            [
                'label' => esc_html__('Container', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__('Padding', 'codegen-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '80',
                    'right' => '20',
                    'bottom' => '80',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-features-grid' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-features-grid',
            ]
        );
        
        $this->add_responsive_control(
            'text_align',
            [
                'label' => esc_html__('Text Alignment', 'codegen-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'codegen-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'codegen-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'codegen-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .features-header' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Header
        $this->start_controls_section(
            'header_style',
            [
                'label' => esc_html__('Header', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .features-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .features-title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 36, 'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                ],
            ]
        );
        
        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Subtitle Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#a1a1aa',
                'selectors' => [
                    '{{WRAPPER}} .features-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => esc_html__('Subtitle Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .features-subtitle',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 18, 'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Feature Cards
        $this->start_controls_section(
            'cards_style',
            [
                'label' => esc_html__('Feature Cards', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'cards_columns',
            [
                'label' => esc_html__('Columns', 'codegen-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'selectors' => [
                    '{{WRAPPER}} .features-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'cards_gap',
            [
                'label' => esc_html__('Gap', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .features-grid' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'card_background',
            [
                'label' => esc_html__('Card Background', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .feature-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'card_border_color',
            [
                'label' => esc_html__('Card Border Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#27272a',
                'selectors' => [
                    '{{WRAPPER}} .feature-card' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Card Padding', 'codegen-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '32',
                    'right' => '24',
                    'bottom' => '32',
                    'left' => '24',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'card_border_radius',
            [
                'label' => esc_html__('Border Radius', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-card' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Icons
        $this->start_controls_section(
            'icons_style',
            [
                'label' => esc_html__('Icons', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6366f1',
                'selectors' => [
                    '{{WRAPPER}} .feature-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .feature-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 16,
                        'max' => 64,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .feature-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Content
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Content', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'feature_title_color',
            [
                'label' => esc_html__('Feature Title Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .feature-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_title_typography',
                'label' => esc_html__('Feature Title Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .feature-title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 18, 'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                ],
            ]
        );
        
        $this->add_control(
            'feature_description_color',
            [
                'label' => esc_html__('Feature Description Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#a1a1aa',
                'selectors' => [
                    '{{WRAPPER}} .feature-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_description_typography',
                'label' => esc_html__('Feature Description Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .feature-description',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 14, 'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                ],
            ]
        );
        
        $this->end_controls_section();
    }
    
    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <div class="codegen-features-grid">
            <div class="container">
                
                <div class="features-header animate-fade-in-up">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2 class="features-title">
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h2>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="features-subtitle">
                            <?php echo wp_kses_post($settings['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($settings['features_list'])) : ?>
                    <div class="features-grid">
                        <?php foreach ($settings['features_list'] as $index => $feature) : ?>
                            <div class="feature-card animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.1 + 0.3); ?>s;">
                                
                                <?php if (!empty($feature['icon']['value'])) : ?>
                                    <div class="feature-icon">
                                        <?php Icons_Manager::render_icon($feature['icon'], ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="feature-content">
                                    <?php if (!empty($feature['title'])) : ?>
                                        <h3 class="feature-title">
                                            <?php echo esc_html($feature['title']); ?>
                                        </h3>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($feature['description'])) : ?>
                                        <p class="feature-description">
                                            <?php echo wp_kses_post($feature['description']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
        
        <?php
    }
}

