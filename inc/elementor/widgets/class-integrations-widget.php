<?php
/**
 * Integrations Widget
 *
 * @package Codegen_Pro
 */

namespace Codegen_Pro\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Repeater;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Integrations Widget Class
 */
class Integrations_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-integrations';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Integrations', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-integration';
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
        return ['integrations', 'icons', 'logos', 'codegen'];
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
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Integrations', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Communication Section
        $this->start_controls_section(
            'communication_section',
            [
                'label' => esc_html__('Communication', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'communication_title',
            [
                'label' => esc_html__('Section Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Communication', 'codegen-pro'),
            ]
        );
        
        $repeater_comm = new Repeater();
        
        $repeater_comm->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Slack', 'codegen-pro'),
            ]
        );
        
        $repeater_comm->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'codegen-pro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );
        
        $repeater_comm->add_control(
            'status',
            [
                'label' => esc_html__('Status', 'codegen-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'available',
                'options' => [
                    'available' => esc_html__('Available', 'codegen-pro'),
                    'soon' => esc_html__('Coming Soon', 'codegen-pro'),
                ],
            ]
        );
        
        $this->add_control(
            'communication_items',
            [
                'label' => esc_html__('Communication Tools', 'codegen-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater_comm->get_controls(),
                'default' => [
                    [
                        'name' => 'Slack',
                        'status' => 'available',
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );
        
        $this->end_controls_section();
        
        // Work Tracking Section
        $this->start_controls_section(
            'work_tracking_section',
            [
                'label' => esc_html__('Work Tracking', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'work_tracking_title',
            [
                'label' => esc_html__('Section Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Work Tracking', 'codegen-pro'),
            ]
        );
        
        $repeater_work = new Repeater();
        
        $repeater_work->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Linear', 'codegen-pro'),
            ]
        );
        
        $repeater_work->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'codegen-pro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );
        
        $repeater_work->add_control(
            'status',
            [
                'label' => esc_html__('Status', 'codegen-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'available',
                'options' => [
                    'available' => esc_html__('Available', 'codegen-pro'),
                    'soon' => esc_html__('Coming Soon', 'codegen-pro'),
                ],
            ]
        );
        
        $this->add_control(
            'work_tracking_items',
            [
                'label' => esc_html__('Work Tracking Tools', 'codegen-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater_work->get_controls(),
                'default' => [
                    [
                        'name' => 'Linear',
                        'status' => 'available',
                    ],
                    [
                        'name' => 'Jira',
                        'status' => 'available',
                    ],
                    [
                        'name' => 'ClickUp',
                        'status' => 'available',
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );
        
        $this->end_controls_section();
        
        // Development Section
        $this->start_controls_section(
            'development_section',
            [
                'label' => esc_html__('Development', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'development_title',
            [
                'label' => esc_html__('Section Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Development', 'codegen-pro'),
            ]
        );
        
        $repeater_dev = new Repeater();
        
        $repeater_dev->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('GitHub', 'codegen-pro'),
            ]
        );
        
        $repeater_dev->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'codegen-pro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );
        
        $repeater_dev->add_control(
            'status',
            [
                'label' => esc_html__('Status', 'codegen-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'available',
                'options' => [
                    'available' => esc_html__('Available', 'codegen-pro'),
                    'soon' => esc_html__('Coming Soon', 'codegen-pro'),
                ],
            ]
        );
        
        $this->add_control(
            'development_items',
            [
                'label' => esc_html__('Development Tools', 'codegen-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater_dev->get_controls(),
                'default' => [
                    [
                        'name' => 'GitHub',
                        'status' => 'available',
                    ],
                    [
                        'name' => 'PostgreSQL',
                        'status' => 'available',
                    ],
                    [
                        'name' => 'Sentry',
                        'status' => 'available',
                    ],
                ],
                'title_field' => '{{{ name }}}',
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
                    'top' => '60',
                    'right' => '20',
                    'bottom' => '60',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-integrations' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-integrations',
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
                    '{{WRAPPER}} .codegen-integrations' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Title
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Main Title', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .codegen-integrations-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .codegen-integrations-title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 24, 'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Section Titles
        $this->start_controls_section(
            'section_titles_style',
            [
                'label' => esc_html__('Section Titles', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'section_title_color',
            [
                'label' => esc_html__('Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#a1a1aa',
                'selectors' => [
                    '{{WRAPPER}} .integration-section-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_title_typography',
                'label' => esc_html__('Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .integration-section-title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 14, 'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
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
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .integration-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'codegen-pro'),
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
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .integration-icons' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'icon_opacity',
            [
                'label' => esc_html__('Icon Opacity', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 0.7,
                ],
                'selectors' => [
                    '{{WRAPPER}} .integration-icon' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        
        $this->add_control(
            'icon_hover_opacity',
            [
                'label' => esc_html__('Icon Hover Opacity', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .integration-icon:hover' => 'opacity: {{SIZE}};',
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
        
        <div class="codegen-integrations">
            <div class="container">
                
                <?php if (!empty($settings['title'])) : ?>
                    <h2 class="codegen-integrations-title animate-fade-in-up">
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                <?php endif; ?>
                
                <div class="integrations-grid">
                    
                    <!-- Communication Section -->
                    <?php if (!empty($settings['communication_items'])) : ?>
                        <div class="integration-category animate-fade-in-up">
                            <?php if (!empty($settings['communication_title'])) : ?>
                                <h3 class="integration-section-title">
                                    <?php echo esc_html($settings['communication_title']); ?>
                                </h3>
                            <?php endif; ?>
                            
                            <div class="integration-icons">
                                <?php foreach ($settings['communication_items'] as $item) : ?>
                                    <div class="integration-icon <?php echo esc_attr($item['status']); ?>">
                                        <?php if (!empty($item['icon']['url'])) : ?>
                                            <img src="<?php echo esc_url($item['icon']['url']); ?>" 
                                                 alt="<?php echo esc_attr($item['name']); ?>" />
                                        <?php endif; ?>
                                        
                                        <?php if ($item['status'] === 'soon') : ?>
                                            <span class="status-badge">SOON</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Work Tracking Section -->
                    <?php if (!empty($settings['work_tracking_items'])) : ?>
                        <div class="integration-category animate-fade-in-up">
                            <?php if (!empty($settings['work_tracking_title'])) : ?>
                                <h3 class="integration-section-title">
                                    <?php echo esc_html($settings['work_tracking_title']); ?>
                                </h3>
                            <?php endif; ?>
                            
                            <div class="integration-icons">
                                <?php foreach ($settings['work_tracking_items'] as $item) : ?>
                                    <div class="integration-icon <?php echo esc_attr($item['status']); ?>">
                                        <?php if (!empty($item['icon']['url'])) : ?>
                                            <img src="<?php echo esc_url($item['icon']['url']); ?>" 
                                                 alt="<?php echo esc_attr($item['name']); ?>" />
                                        <?php endif; ?>
                                        
                                        <?php if ($item['status'] === 'soon') : ?>
                                            <span class="status-badge">SOON</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Development Section -->
                    <?php if (!empty($settings['development_items'])) : ?>
                        <div class="integration-category animate-fade-in-up">
                            <?php if (!empty($settings['development_title'])) : ?>
                                <h3 class="integration-section-title">
                                    <?php echo esc_html($settings['development_title']); ?>
                                </h3>
                            <?php endif; ?>
                            
                            <div class="integration-icons">
                                <?php foreach ($settings['development_items'] as $item) : ?>
                                    <div class="integration-icon <?php echo esc_attr($item['status']); ?>">
                                        <?php if (!empty($item['icon']['url'])) : ?>
                                            <img src="<?php echo esc_url($item['icon']['url']); ?>" 
                                                 alt="<?php echo esc_attr($item['name']); ?>" />
                                        <?php endif; ?>
                                        
                                        <?php if ($item['status'] === 'soon') : ?>
                                            <span class="status-badge">SOON</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
        
        <?php
    }
}

