<?php
/**
 * Testimonials Widget
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
 * Testimonials Widget Class
 */
class Testimonials_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-testimonials';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Testimonials', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-testimonial-carousel';
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
        return ['testimonials', 'reviews', 'quotes', 'codegen'];
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
                'default' => esc_html__('What developers are saying', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Testimonials Section
        $this->start_controls_section(
            'testimonials_section',
            [
                'label' => esc_html__('Testimonials', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control(
            'quote',
            [
                'label' => esc_html__('Quote', 'codegen-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('This tool has revolutionized our development workflow.', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $repeater->add_control(
            'position',
            [
                'label' => esc_html__('Position', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Senior Developer', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $repeater->add_control(
            'company',
            [
                'label' => esc_html__('Company', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tech Corp', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $repeater->add_control(
            'avatar',
            [
                'label' => esc_html__('Avatar', 'codegen-pro'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );
        
        $this->add_control(
            'testimonials_list',
            [
                'label' => esc_html__('Testimonials', 'codegen-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'quote' => 'Codegen has transformed how we approach development. The AI agents understand our codebase better than some of our junior developers.',
                        'name' => 'Sarah Chen',
                        'position' => 'Engineering Manager',
                        'company' => 'TechFlow',
                    ],
                    [
                        'quote' => 'The time savings are incredible. What used to take days now takes hours. Our team can focus on architecture instead of boilerplate.',
                        'name' => 'Marcus Rodriguez',
                        'position' => 'Lead Developer',
                        'company' => 'InnovateLabs',
                    ],
                    [
                        'quote' => 'The code quality is consistently high. The agents follow our style guides and best practices perfectly every time.',
                        'name' => 'Emily Watson',
                        'position' => 'CTO',
                        'company' => 'StartupXYZ',
                    ],
                ],
                'title_field' => '{{{ name }}} - {{{ company }}}',
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
                    '{{WRAPPER}} .codegen-testimonials' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-testimonials',
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
                    '{{WRAPPER}} .testimonials-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .testimonials-title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 36, 'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Testimonial Cards
        $this->start_controls_section(
            'cards_style',
            [
                'label' => esc_html__('Testimonial Cards', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'card_background',
            [
                'label' => esc_html__('Card Background', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-card' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .testimonial-card' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'quote_color',
            [
                'label' => esc_html__('Quote Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-quote' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'quote_typography',
                'label' => esc_html__('Quote Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .testimonial-quote',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 16, 'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                ],
            ]
        );
        
        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Name Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-name' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'position_color',
            [
                'label' => esc_html__('Position Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#a1a1aa',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-position' => 'color: {{VALUE}};',
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
        
        <div class="codegen-testimonials">
            <div class="container">
                
                <?php if (!empty($settings['title'])) : ?>
                    <div class="testimonials-header animate-fade-in-up">
                        <h2 class="testimonials-title">
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h2>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($settings['testimonials_list'])) : ?>
                    <div class="testimonials-grid">
                        <?php foreach ($settings['testimonials_list'] as $index => $testimonial) : ?>
                            <div class="testimonial-card animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.2 + 0.3); ?>s;">
                                
                                <?php if (!empty($testimonial['quote'])) : ?>
                                    <div class="testimonial-quote">
                                        "<?php echo wp_kses_post($testimonial['quote']); ?>"
                                    </div>
                                <?php endif; ?>
                                
                                <div class="testimonial-author">
                                    <?php if (!empty($testimonial['avatar']['url'])) : ?>
                                        <div class="testimonial-avatar">
                                            <img src="<?php echo esc_url($testimonial['avatar']['url']); ?>" 
                                                 alt="<?php echo esc_attr($testimonial['name']); ?>" />
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="testimonial-info">
                                        <?php if (!empty($testimonial['name'])) : ?>
                                            <div class="testimonial-name">
                                                <?php echo esc_html($testimonial['name']); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="testimonial-position">
                                            <?php if (!empty($testimonial['position'])) : ?>
                                                <?php echo esc_html($testimonial['position']); ?>
                                            <?php endif; ?>
                                            <?php if (!empty($testimonial['company'])) : ?>
                                                <?php if (!empty($testimonial['position'])) echo ' at '; ?>
                                                <?php echo esc_html($testimonial['company']); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
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

