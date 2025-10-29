<?php
/**
 * Trusted Teams Widget
 *
 * @package Codegen_Pro
 */

namespace Codegen_Pro\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Trusted Teams Widget Class
 */
class Trusted_Teams_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-trusted-teams';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Trusted Teams', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-testimonial';
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
        return ['trusted', 'teams', 'clients', 'codegen'];
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
            'text',
            [
                'label' => esc_html__('Text', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Trusted by 1000+ teams', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'number',
            [
                'label' => esc_html__('Number', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('1000+', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'label',
            [
                'label' => esc_html__('Label', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('teams', 'codegen-pro'),
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
                    'top' => '40',
                    'right' => '20',
                    'bottom' => '40',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .codegen-trusted-teams' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-trusted-teams',
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
                    '{{WRAPPER}} .codegen-trusted-teams' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Text
        $this->start_controls_section(
            'text_style',
            [
                'label' => esc_html__('Text', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#71717a',
                'selectors' => [
                    '{{WRAPPER}} .trusted-teams-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'number_color',
            [
                'label' => esc_html__('Number Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .trusted-teams-number' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .trusted-teams-text',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 16, 'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'label' => esc_html__('Number Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .trusted-teams-number',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 16, 'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
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
        
        <div class="codegen-trusted-teams">
            <div class="container">
                <div class="trusted-teams-content animate-fade-in-up">
                    <span class="trusted-teams-text">
                        Trusted by 
                        <span class="trusted-teams-number"><?php echo esc_html($settings['number']); ?></span>
                        <?php echo esc_html($settings['label']); ?>
                    </span>
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
        <div class="codegen-trusted-teams">
            <div class="container">
                <div class="trusted-teams-content animate-fade-in-up">
                    <span class="trusted-teams-text">
                        Trusted by 
                        <span class="trusted-teams-number">{{{ settings.number }}}</span>
                        {{{ settings.label }}}
                    </span>
                </div>
            </div>
        </div>
        <?php
    }
}

