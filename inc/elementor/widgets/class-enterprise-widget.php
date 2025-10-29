<?php
/**
 * Enterprise Widget
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
 * Enterprise Widget Class
 */
class Enterprise_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-enterprise';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Enterprise', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-building';
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
        return ['enterprise', 'business', 'infrastructure', 'codegen'];
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
                'default' => esc_html__('Enterprise infrastructure', 'codegen-pro'),
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
                'default' => esc_html__('Built for scale, security, and reliability from day one.', 'codegen-pro'),
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
                'label' => esc_html__('Enterprise Features', 'codegen-pro'),
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
                    'value' => 'fas fa-shield-alt',
                    'library' => 'fa-solid',
                ],
            ]
        );
        
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Secure execution', 'codegen-pro'),
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
                'default' => esc_html__('Enterprise-grade security with isolated execution environments.', 'codegen-pro'),
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
                        'title' => 'Secure execution',
                        'description' => 'Enterprise-grade security with isolated execution environments and encrypted data transmission.',
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-expand-arrows-alt',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Auto-scaling',
                        'description' => 'Automatically scale resources based on demand with intelligent load balancing.',
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-chart-line',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Full observability',
                        'description' => 'Complete visibility into system performance, usage metrics, and audit trails.',
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-tools',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Zero maintenance',
                        'description' => 'Fully managed infrastructure with automatic updates and 24/7 monitoring.',
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
                    '{{WRAPPER}} .codegen-enterprise' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-enterprise',
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
                    '{{WRAPPER}} .enterprise-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .enterprise-title',
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
                    '{{WRAPPER}} .enterprise-subtitle' => 'color: {{VALUE}};',
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
        
        <div class="codegen-enterprise">
            <div class="container">
                
                <div class="enterprise-header animate-fade-in-up">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2 class="enterprise-title">
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h2>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="enterprise-subtitle">
                            <?php echo wp_kses_post($settings['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($settings['features_list'])) : ?>
                    <div class="enterprise-features">
                        <?php foreach ($settings['features_list'] as $index => $feature) : ?>
                            <div class="enterprise-feature animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.1 + 0.3); ?>s;">
                                
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

