<?php
/**
 * Hero Widget
 *
 * @package Codegen_Pro
 */

namespace Codegen_Pro\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Hero Widget Class
 */
class Hero_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-hero';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Hero', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-banner';
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
        return ['hero', 'banner', 'header', 'codegen'];
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
                'default' => esc_html__('The OS for Code Agents', 'codegen-pro'),
                'placeholder' => esc_html__('Enter your title', 'codegen-pro'),
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
                'default' => esc_html__('Deploy code agents that plan, build, and review with full context, robust integrations, and production-ready results. Backed by enterprise-grade support. Ship faster with Codegen.', 'codegen-pro'),
                'placeholder' => esc_html__('Enter your subtitle', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Try for free. No credit card required. Setup in minutes.', 'codegen-pro'),
                'placeholder' => esc_html__('Enter description', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Buttons Section
        $this->start_controls_section(
            'buttons_section',
            [
                'label' => esc_html__('Buttons', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'primary_button_text',
            [
                'label' => esc_html__('Primary Button Text', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Get Started', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'primary_button_url',
            [
                'label' => esc_html__('Primary Button URL', 'codegen-pro'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'secondary_button_text',
            [
                'label' => esc_html__('Secondary Button Text', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Schedule Demo', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'secondary_button_url',
            [
                'label' => esc_html__('Secondary Button URL', 'codegen-pro'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'dynamic' => [
                    'active' => true,
                ],
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
                    'top' => '120',
                    'right' => '20',
                    'bottom' => '120',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'container_margin',
            [
                'label' => esc_html__('Margin', 'codegen-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-hero',
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
                    '{{WRAPPER}} .codegen-hero' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Title
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'codegen-pro'),
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
                    '{{WRAPPER}} .codegen-hero-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .codegen-hero-title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 64, 'unit' => 'px']],
                    'font_weight' => ['default' => '800'],
                    'line_height' => ['default' => ['size' => 1.1, 'unit' => 'em']],
                ],
            ]
        );
        
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'codegen-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '24',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Subtitle
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__('Subtitle', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#a1a1aa',
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => esc_html__('Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .codegen-hero-subtitle',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 20, 'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                    'line_height' => ['default' => ['size' => 1.6, 'unit' => 'em']],
                ],
            ]
        );
        
        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => esc_html__('Margin', 'codegen-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '32',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'subtitle_max_width',
            [
                'label' => esc_html__('Max Width', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 700,
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero-subtitle' => 'max-width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto;',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Description
        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#71717a',
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .codegen-hero-description',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 16, 'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                ],
            ]
        );
        
        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__('Margin', 'codegen-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '40',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Buttons
        $this->start_controls_section(
            'buttons_style',
            [
                'label' => esc_html__('Buttons', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'buttons_gap',
            [
                'label' => esc_html__('Gap Between Buttons', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero-buttons' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        // Primary Button Styles
        $this->add_control(
            'primary_button_heading',
            [
                'label' => esc_html__('Primary Button', 'codegen-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->start_controls_tabs('primary_button_tabs');
        
        $this->start_controls_tab(
            'primary_button_normal',
            [
                'label' => esc_html__('Normal', 'codegen-pro'),
            ]
        );
        
        $this->add_control(
            'primary_button_color',
            [
                'label' => esc_html__('Text Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .btn-primary' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'primary_button_bg',
            [
                'label' => esc_html__('Background Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6366f1',
                'selectors' => [
                    '{{WRAPPER}} .btn-primary' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'primary_button_hover',
            [
                'label' => esc_html__('Hover', 'codegen-pro'),
            ]
        );
        
        $this->add_control(
            'primary_button_hover_color',
            [
                'label' => esc_html__('Text Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .btn-primary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'primary_button_hover_bg',
            [
                'label' => esc_html__('Background Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4f46e5',
                'selectors' => [
                    '{{WRAPPER}} .btn-primary:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        // Secondary Button Styles
        $this->add_control(
            'secondary_button_heading',
            [
                'label' => esc_html__('Secondary Button', 'codegen-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->start_controls_tabs('secondary_button_tabs');
        
        $this->start_controls_tab(
            'secondary_button_normal',
            [
                'label' => esc_html__('Normal', 'codegen-pro'),
            ]
        );
        
        $this->add_control(
            'secondary_button_color',
            [
                'label' => esc_html__('Text Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .btn-secondary' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'secondary_button_bg',
            [
                'label' => esc_html__('Background Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .btn-secondary' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'secondary_button_border',
            [
                'label' => esc_html__('Border Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3f3f46',
                'selectors' => [
                    '{{WRAPPER}} .btn-secondary' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'secondary_button_hover',
            [
                'label' => esc_html__('Hover', 'codegen-pro'),
            ]
        );
        
        $this->add_control(
            'secondary_button_hover_color',
            [
                'label' => esc_html__('Text Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .btn-secondary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'secondary_button_hover_bg',
            [
                'label' => esc_html__('Background Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .btn-secondary:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'secondary_button_hover_border',
            [
                'label' => esc_html__('Border Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3f3f46',
                'selectors' => [
                    '{{WRAPPER}} .btn-secondary:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'buttons_typography',
                'label' => esc_html__('Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .codegen-hero-buttons .btn',
                'separator' => 'before',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 16, 'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                ],
            ]
        );
        
        $this->add_responsive_control(
            'buttons_padding',
            [
                'label' => esc_html__('Padding', 'codegen-pro'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '12',
                    'right' => '24',
                    'bottom' => '12',
                    'left' => '24',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero-buttons .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'buttons_border_radius',
            [
                'label' => esc_html__('Border Radius', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-hero-buttons .btn' => 'border-radius: {{SIZE}}{{UNIT}};',
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
        
        // Primary button attributes
        $primary_target = $settings['primary_button_url']['is_external'] ? ' target="_blank"' : '';
        $primary_nofollow = $settings['primary_button_url']['nofollow'] ? ' rel="nofollow"' : '';
        
        // Secondary button attributes
        $secondary_target = $settings['secondary_button_url']['is_external'] ? ' target="_blank"' : '';
        $secondary_nofollow = $settings['secondary_button_url']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
        
        <div class="codegen-hero">
            <div class="container">
                <div class="codegen-hero-content">
                    
                    <?php if (!empty($settings['title'])) : ?>
                        <h1 class="codegen-hero-title animate-fade-in-up">
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h1>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="codegen-hero-subtitle animate-fade-in-up">
                            <?php echo wp_kses_post($settings['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                    
                    <div class="codegen-hero-buttons animate-fade-in-up">
                        <?php if (!empty($settings['primary_button_text'])) : ?>
                            <a href="<?php echo esc_url($settings['primary_button_url']['url']); ?>" 
                               class="btn btn-primary btn-lg"
                               <?php echo $primary_target . $primary_nofollow; ?>>
                                <?php echo esc_html($settings['primary_button_text']); ?>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (!empty($settings['secondary_button_text'])) : ?>
                            <a href="<?php echo esc_url($settings['secondary_button_url']['url']); ?>" 
                               class="btn btn-secondary btn-lg"
                               <?php echo $secondary_target . $secondary_nofollow; ?>>
                                <?php echo esc_html($settings['secondary_button_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (!empty($settings['description'])) : ?>
                        <p class="codegen-hero-description animate-fade-in-up">
                            <?php echo esc_html($settings['description']); ?>
                        </p>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
        
        <?php
    }
    
    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <#
        var primaryTarget = settings.primary_button_url.is_external ? ' target="_blank"' : '';
        var primaryNofollow = settings.primary_button_url.nofollow ? ' rel="nofollow"' : '';
        var secondaryTarget = settings.secondary_button_url.is_external ? ' target="_blank"' : '';
        var secondaryNofollow = settings.secondary_button_url.nofollow ? ' rel="nofollow"' : '';
        #>
        
        <div class="codegen-hero">
            <div class="container">
                <div class="codegen-hero-content">
                    
                    <# if (settings.title) { #>
                        <h1 class="codegen-hero-title animate-fade-in-up">
                            {{{ settings.title }}}
                        </h1>
                    <# } #>
                    
                    <# if (settings.subtitle) { #>
                        <p class="codegen-hero-subtitle animate-fade-in-up">
                            {{{ settings.subtitle }}}
                        </p>
                    <# } #>
                    
                    <div class="codegen-hero-buttons animate-fade-in-up">
                        <# if (settings.primary_button_text) { #>
                            <a href="{{ settings.primary_button_url.url }}" 
                               class="btn btn-primary btn-lg">
                                {{{ settings.primary_button_text }}}
                            </a>
                        <# } #>
                        
                        <# if (settings.secondary_button_text) { #>
                            <a href="{{ settings.secondary_button_url.url }}" 
                               class="btn btn-secondary btn-lg">
                                {{{ settings.secondary_button_text }}}
                            </a>
                        <# } #>
                    </div>
                    
                    <# if (settings.description) { #>
                        <p class="codegen-hero-description animate-fade-in-up">
                            {{{ settings.description }}}
                        </p>
                    <# } #>
                    
                </div>
            </div>
        </div>
        
        <?php
    }
}
