<?php
/**
 * Models Widget
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
 * Models Widget Class
 */
class Models_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-models';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Models', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-apps';
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
        return ['models', 'ai', 'claude', 'gemini', 'codegen'];
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
                'default' => esc_html__('State-of-the-art models', 'codegen-pro'),
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
                'default' => esc_html__('Choose the right AI model for your specific needs and requirements.', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Models Section
        $this->start_controls_section(
            'models_section',
            [
                'label' => esc_html__('AI Models', 'codegen-pro'),
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
                    'value' => 'fas fa-brain',
                    'library' => 'fa-solid',
                ],
            ]
        );
        
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Claude', 'codegen-pro'),
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
                'default' => esc_html__('Complex reasoning and analysis', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $repeater->add_control(
            'badge',
            [
                'label' => esc_html__('Badge', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('e.g., Popular, New, etc.', 'codegen-pro'),
            ]
        );
        
        $this->add_control(
            'models_list',
            [
                'label' => esc_html__('Models', 'codegen-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'icon' => [
                            'value' => 'fas fa-brain',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Claude',
                        'description' => 'Complex reasoning and deep analysis for sophisticated code challenges.',
                        'badge' => 'Popular',
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-rocket',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Gemini',
                        'description' => 'Large-scale refactoring and architectural improvements.',
                        'badge' => '',
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-cog',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Your models',
                        'description' => 'Custom fine-tuned models for your specific domain and requirements.',
                        'badge' => 'Custom',
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-star',
                            'library' => 'fa-solid',
                        ],
                        'title' => 'Future models',
                        'description' => 'Seamlessly deploy new models as they become available.',
                        'badge' => 'Coming Soon',
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
                    '{{WRAPPER}} .codegen-models' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-models',
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
                    '{{WRAPPER}} .models-header' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .models-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .models-title',
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
                    '{{WRAPPER}} .models-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => esc_html__('Subtitle Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .models-subtitle',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 18, 'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Model Cards
        $this->start_controls_section(
            'cards_style',
            [
                'label' => esc_html__('Model Cards', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'cards_columns',
            [
                'label' => esc_html__('Columns', 'codegen-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'selectors' => [
                    '{{WRAPPER}} .models-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
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
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .models-grid' => 'gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .model-card' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .model-card' => 'border-color: {{VALUE}};',
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
        
        <div class="codegen-models">
            <div class="container">
                
                <div class="models-header animate-fade-in-up">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2 class="models-title">
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h2>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="models-subtitle">
                            <?php echo wp_kses_post($settings['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($settings['models_list'])) : ?>
                    <div class="models-grid">
                        <?php foreach ($settings['models_list'] as $index => $model) : ?>
                            <div class="model-card animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.1 + 0.3); ?>s;">
                                
                                <?php if (!empty($model['badge'])) : ?>
                                    <div class="model-badge">
                                        <?php echo esc_html($model['badge']); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($model['icon']['value'])) : ?>
                                    <div class="model-icon">
                                        <?php Icons_Manager::render_icon($model['icon'], ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="model-content">
                                    <?php if (!empty($model['title'])) : ?>
                                        <h3 class="model-title">
                                            <?php echo esc_html($model['title']); ?>
                                        </h3>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($model['description'])) : ?>
                                        <p class="model-description">
                                            <?php echo wp_kses_post($model['description']); ?>
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

