<?php
/**
 * Process Steps Widget
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
 * Process Steps Widget Class
 */
class Process_Steps_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-process-steps';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Process Steps', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-number-field';
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
        return ['process', 'steps', 'workflow', 'codegen'];
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
                'default' => esc_html__('Say it, ship it', 'codegen-pro'),
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
                'default' => esc_html__('From idea to deployment in minutes, not hours.', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Steps Section
        $this->start_controls_section(
            'steps_section',
            [
                'label' => esc_html__('Process Steps', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control(
            'step_number',
            [
                'label' => esc_html__('Step Number', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => '01',
            ]
        );
        
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Step Title', 'codegen-pro'),
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
                'default' => esc_html__('Step description goes here.', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'steps_list',
            [
                'label' => esc_html__('Steps', 'codegen-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'step_number' => '01',
                        'title' => 'Assign',
                        'description' => 'Describe your task in natural language. Our AI understands context and requirements.',
                    ],
                    [
                        'step_number' => '02',
                        'title' => 'Analyze',
                        'description' => 'Code agents analyze your codebase, dependencies, and existing patterns.',
                    ],
                    [
                        'step_number' => '03',
                        'title' => 'Implement',
                        'description' => 'Agents write, test, and refine code following your team\'s standards.',
                    ],
                    [
                        'step_number' => '04',
                        'title' => 'Deliver',
                        'description' => 'Review and merge production-ready code with full documentation.',
                    ],
                ],
                'title_field' => '{{{ step_number }}} - {{{ title }}}',
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
                    '{{WRAPPER}} .codegen-process-steps' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-process-steps',
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
                    '{{WRAPPER}} .process-header' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .process-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .process-title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 48, 'unit' => 'px']],
                    'font_weight' => ['default' => '800'],
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
                    '{{WRAPPER}} .process-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => esc_html__('Subtitle Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .process-subtitle',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 20, 'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Steps
        $this->start_controls_section(
            'steps_style',
            [
                'label' => esc_html__('Steps', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'steps_columns',
            [
                'label' => esc_html__('Columns', 'codegen-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'selectors' => [
                    '{{WRAPPER}} .process-steps-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'steps_gap',
            [
                'label' => esc_html__('Gap', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 60,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .process-steps-grid' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Step Numbers
        $this->start_controls_section(
            'step_numbers_style',
            [
                'label' => esc_html__('Step Numbers', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'step_number_color',
            [
                'label' => esc_html__('Number Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6366f1',
                'selectors' => [
                    '{{WRAPPER}} .step-number' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'step_number_bg',
            [
                'label' => esc_html__('Number Background', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(99, 102, 241, 0.1)',
                'selectors' => [
                    '{{WRAPPER}} .step-number' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'step_number_typography',
                'label' => esc_html__('Number Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .step-number',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 14, 'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                ],
            ]
        );
        
        $this->add_responsive_control(
            'step_number_size',
            [
                'label' => esc_html__('Number Size', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .step-number' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Step Content
        $this->start_controls_section(
            'step_content_style',
            [
                'label' => esc_html__('Step Content', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'step_title_color',
            [
                'label' => esc_html__('Step Title Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .step-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'step_title_typography',
                'label' => esc_html__('Step Title Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .step-title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 20, 'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                ],
            ]
        );
        
        $this->add_control(
            'step_description_color',
            [
                'label' => esc_html__('Step Description Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#a1a1aa',
                'selectors' => [
                    '{{WRAPPER}} .step-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'step_description_typography',
                'label' => esc_html__('Step Description Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .step-description',
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
        
        <div class="codegen-process-steps">
            <div class="container">
                
                <div class="process-header animate-fade-in-up">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2 class="process-title">
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h2>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="process-subtitle">
                            <?php echo wp_kses_post($settings['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($settings['steps_list'])) : ?>
                    <div class="process-steps-grid">
                        <?php foreach ($settings['steps_list'] as $index => $step) : ?>
                            <div class="process-step animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.2 + 0.4); ?>s;">
                                
                                <div class="step-number">
                                    <?php echo esc_html($step['step_number']); ?>
                                </div>
                                
                                <div class="step-content">
                                    <?php if (!empty($step['title'])) : ?>
                                        <h3 class="step-title">
                                            <?php echo esc_html($step['title']); ?>
                                        </h3>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($step['description'])) : ?>
                                        <p class="step-description">
                                            <?php echo wp_kses_post($step['description']); ?>
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
    
    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <div class="codegen-process-steps">
            <div class="container">
                
                <div class="process-header animate-fade-in-up">
                    <# if (settings.title) { #>
                        <h2 class="process-title">
                            {{{ settings.title }}}
                        </h2>
                    <# } #>
                    
                    <# if (settings.subtitle) { #>
                        <p class="process-subtitle">
                            {{{ settings.subtitle }}}
                        </p>
                    <# } #>
                </div>
                
                <# if (settings.steps_list.length) { #>
                    <div class="process-steps-grid">
                        <# _.each(settings.steps_list, function(step, index) { #>
                            <div class="process-step animate-fade-in-up">
                                
                                <div class="step-number">
                                    {{{ step.step_number }}}
                                </div>
                                
                                <div class="step-content">
                                    <# if (step.title) { #>
                                        <h3 class="step-title">
                                            {{{ step.title }}}
                                        </h3>
                                    <# } #>
                                    
                                    <# if (step.description) { #>
                                        <p class="step-description">
                                            {{{ step.description }}}
                                        </p>
                                    <# } #>
                                </div>
                                
                            </div>
                        <# }); #>
                    </div>
                <# } #>
                
            </div>
        </div>
        <?php
    }
}

