<?php
/**
 * Partnership Widget
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
 * Partnership Widget Class
 */
class Partnership_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-partnership';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Partnership', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-handshake';
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
        return ['partnership', 'support', 'onboarding', 'codegen'];
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
                'default' => esc_html__('Forward-Deployed Partnership', 'codegen-pro'),
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
                'default' => esc_html__('We work alongside your team to ensure success from day one.', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'codegen-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Our partnership goes beyond software. We provide embedded expertise, white-glove onboarding, and ongoing strategic guidance to maximize your investment in AI-powered development.', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Schedule Partnership Call', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'codegen-pro'),
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
        
        // Features Section
        $this->start_controls_section(
            'features_section',
            [
                'label' => esc_html__('Partnership Features', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'feature_1_title',
            [
                'label' => esc_html__('Feature 1 Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Embedded expertise', 'codegen-pro'),
            ]
        );
        
        $this->add_control(
            'feature_1_description',
            [
                'label' => esc_html__('Feature 1 Description', 'codegen-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Dedicated engineers work directly with your team', 'codegen-pro'),
            ]
        );
        
        $this->add_control(
            'feature_2_title',
            [
                'label' => esc_html__('Feature 2 Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('White-glove onboarding', 'codegen-pro'),
            ]
        );
        
        $this->add_control(
            'feature_2_description',
            [
                'label' => esc_html__('Feature 2 Description', 'codegen-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Comprehensive setup and training for your entire team', 'codegen-pro'),
            ]
        );
        
        $this->add_control(
            'feature_3_title',
            [
                'label' => esc_html__('Feature 3 Title', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Strategic guidance', 'codegen-pro'),
            ]
        );
        
        $this->add_control(
            'feature_3_description',
            [
                'label' => esc_html__('Feature 3 Description', 'codegen-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Ongoing consultation to optimize your development workflow', 'codegen-pro'),
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
                    '{{WRAPPER}} .codegen-partnership' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-partnership',
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
                    '{{WRAPPER}} .partnership-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Typography
        $this->start_controls_section(
            'typography_style',
            [
                'label' => esc_html__('Typography', 'codegen-pro'),
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
                    '{{WRAPPER}} .partnership-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .partnership-title',
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
                    '{{WRAPPER}} .partnership-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#a1a1aa',
                'selectors' => [
                    '{{WRAPPER}} .partnership-description' => 'color: {{VALUE}};',
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
        
        // Button attributes
        $target = $settings['button_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['button_url']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
        
        <div class="codegen-partnership">
            <div class="container">
                
                <div class="partnership-content animate-fade-in-up">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2 class="partnership-title">
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h2>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="partnership-subtitle">
                            <?php echo wp_kses_post($settings['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['description'])) : ?>
                        <p class="partnership-description">
                            <?php echo wp_kses_post($settings['description']); ?>
                        </p>
                    <?php endif; ?>
                    
                    <div class="partnership-features animate-fade-in-up">
                        <?php if (!empty($settings['feature_1_title'])) : ?>
                            <div class="partnership-feature">
                                <h4 class="feature-title"><?php echo esc_html($settings['feature_1_title']); ?></h4>
                                <p class="feature-description"><?php echo esc_html($settings['feature_1_description']); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($settings['feature_2_title'])) : ?>
                            <div class="partnership-feature">
                                <h4 class="feature-title"><?php echo esc_html($settings['feature_2_title']); ?></h4>
                                <p class="feature-description"><?php echo esc_html($settings['feature_2_description']); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($settings['feature_3_title'])) : ?>
                            <div class="partnership-feature">
                                <h4 class="feature-title"><?php echo esc_html($settings['feature_3_title']); ?></h4>
                                <p class="feature-description"><?php echo esc_html($settings['feature_3_description']); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (!empty($settings['button_text'])) : ?>
                        <div class="partnership-button animate-fade-in-up">
                            <a href="<?php echo esc_url($settings['button_url']['url']); ?>" 
                               class="btn btn-primary btn-lg"
                               <?php echo $target . $nofollow; ?>>
                                <?php echo esc_html($settings['button_text']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
        
        <?php
    }
}

