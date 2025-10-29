<?php
/**
 * Stats Widget
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
 * Stats Widget Class
 */
class Stats_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-stats';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Stats', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-counter';
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
        return ['stats', 'counter', 'numbers', 'codegen'];
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
                'default' => esc_html__('Trusted by developers worldwide', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Stats Section
        $this->start_controls_section(
            'stats_section',
            [
                'label' => esc_html__('Statistics', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control(
            'number',
            [
                'label' => esc_html__('Number', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => '230',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $repeater->add_control(
            'suffix',
            [
                'label' => esc_html__('Suffix', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => 'k+',
            ]
        );
        
        $repeater->add_control(
            'label',
            [
                'label' => esc_html__('Label', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => 'PRs created',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $repeater->add_control(
            'animate_counter',
            [
                'label' => esc_html__('Animate Counter', 'codegen-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        
        $repeater->add_control(
            'animation_duration',
            [
                'label' => esc_html__('Animation Duration (ms)', 'codegen-pro'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
                'condition' => [
                    'animate_counter' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'stats_list',
            [
                'label' => esc_html__('Statistics', 'codegen-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'number' => '230',
                        'suffix' => 'k+',
                        'label' => 'PRs created',
                        'animate_counter' => 'yes',
                        'animation_duration' => 2000,
                    ],
                    [
                        'number' => '52',
                        'suffix' => '%',
                        'label' => 'merge rate',
                        'animate_counter' => 'yes',
                        'animation_duration' => 2500,
                    ],
                    [
                        'number' => '18.1',
                        'suffix' => 'M',
                        'label' => 'saved in dev costs',
                        'animate_counter' => 'yes',
                        'animation_duration' => 3000,
                    ],
                ],
                'title_field' => '{{{ number }}}{{{ suffix }}} - {{{ label }}}',
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
                    '{{WRAPPER}} .codegen-stats' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-stats',
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
                    '{{WRAPPER}} .stats-header' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .stats-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .stats-title',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 32, 'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Stats
        $this->start_controls_section(
            'stats_style',
            [
                'label' => esc_html__('Statistics', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'stats_columns',
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
                    '{{WRAPPER}} .stats-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'stats_gap',
            [
                'label' => esc_html__('Gap', 'codegen-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .stats-grid' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'stat_number_color',
            [
                'label' => esc_html__('Number Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .stat-number' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'stat_number_typography',
                'label' => esc_html__('Number Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .stat-number',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 48, 'unit' => 'px']],
                    'font_weight' => ['default' => '800'],
                ],
            ]
        );
        
        $this->add_control(
            'stat_label_color',
            [
                'label' => esc_html__('Label Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#a1a1aa',
                'selectors' => [
                    '{{WRAPPER}} .stat-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'stat_label_typography',
                'label' => esc_html__('Label Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .stat-label',
                'fields_options' => [
                    'typography' => ['default' => 'yes'],
                    'font_family' => ['default' => 'Inter'],
                    'font_size' => ['default' => ['size' => 16, 'unit' => 'px']],
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
        
        <div class="codegen-stats">
            <div class="container">
                
                <?php if (!empty($settings['title'])) : ?>
                    <div class="stats-header animate-fade-in-up">
                        <h2 class="stats-title">
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h2>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($settings['stats_list'])) : ?>
                    <div class="stats-grid">
                        <?php foreach ($settings['stats_list'] as $index => $stat) : ?>
                            <div class="stat-item animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.2 + 0.4); ?>s;">
                                
                                <div class="stat-number-wrapper">
                                    <span class="stat-number counter" 
                                          data-count="<?php echo esc_attr($stat['number']); ?>"
                                          data-duration="<?php echo esc_attr($stat['animation_duration']); ?>"
                                          data-animate="<?php echo esc_attr($stat['animate_counter']); ?>">
                                        0
                                    </span>
                                    <?php if (!empty($stat['suffix'])) : ?>
                                        <span class="stat-suffix"><?php echo esc_html($stat['suffix']); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if (!empty($stat['label'])) : ?>
                                    <div class="stat-label">
                                        <?php echo esc_html($stat['label']); ?>
                                    </div>
                                <?php endif; ?>
                                
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
        
        <?php
    }
}

