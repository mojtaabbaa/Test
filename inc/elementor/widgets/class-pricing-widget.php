<?php
/**
 * Pricing Widget
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
 * Pricing Widget Class
 */
class Pricing_Widget extends Widget_Base {
    
    /**
     * Get widget name
     */
    public function get_name() {
        return 'codegen-pricing';
    }
    
    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('Codegen Pricing', 'codegen-pro');
    }
    
    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-price-table';
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
        return ['pricing', 'plans', 'subscription', 'codegen'];
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
                'default' => esc_html__('Simple, transparent pricing', 'codegen-pro'),
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
                'default' => esc_html__('Choose the plan that fits your team size and needs.', 'codegen-pro'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Pricing Plans Section
        $this->start_controls_section(
            'plans_section',
            [
                'label' => esc_html__('Pricing Plans', 'codegen-pro'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control(
            'plan_name',
            [
                'label' => esc_html__('Plan Name', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Free', 'codegen-pro'),
            ]
        );
        
        $repeater->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('$0', 'codegen-pro'),
            ]
        );
        
        $repeater->add_control(
            'period',
            [
                'label' => esc_html__('Period', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('per month', 'codegen-pro'),
            ]
        );
        
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'codegen-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Perfect for trying out Codegen', 'codegen-pro'),
            ]
        );
        
        $repeater->add_control(
            'features',
            [
                'label' => esc_html__('Features', 'codegen-pro'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__("5 PRs per month\nBasic support\nCommunity access", 'codegen-pro'),
                'description' => esc_html__('Enter each feature on a new line', 'codegen-pro'),
            ]
        );
        
        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'codegen-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Get Started', 'codegen-pro'),
            ]
        );
        
        $repeater->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'codegen-pro'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );
        
        $repeater->add_control(
            'is_popular',
            [
                'label' => esc_html__('Popular Plan', 'codegen-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );
        
        $this->add_control(
            'pricing_plans',
            [
                'label' => esc_html__('Pricing Plans', 'codegen-pro'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'plan_name' => 'Free',
                        'price' => '$0',
                        'period' => 'per month',
                        'description' => 'Perfect for trying out Codegen',
                        'features' => "5 PRs per month\nBasic support\nCommunity access",
                        'button_text' => 'Get Started',
                        'is_popular' => '',
                    ],
                    [
                        'plan_name' => 'Individual',
                        'price' => '$29',
                        'period' => 'per month',
                        'description' => 'For individual developers',
                        'features' => "Unlimited PRs\nPriority support\nAdvanced features\nCustom integrations",
                        'button_text' => 'Start Free Trial',
                        'is_popular' => 'yes',
                    ],
                    [
                        'plan_name' => 'Teams',
                        'price' => '$99',
                        'period' => 'per month',
                        'description' => 'For growing development teams',
                        'features' => "Everything in Individual\nTeam collaboration\nAdvanced analytics\nSSO integration",
                        'button_text' => 'Contact Sales',
                        'is_popular' => '',
                    ],
                    [
                        'plan_name' => 'Enterprise',
                        'price' => 'Custom',
                        'period' => 'pricing',
                        'description' => 'For large organizations',
                        'features' => "Everything in Teams\nDedicated support\nCustom deployment\nSLA guarantee",
                        'button_text' => 'Contact Sales',
                        'is_popular' => '',
                    ],
                ],
                'title_field' => '{{{ plan_name }}} - {{{ price }}}',
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
                    '{{WRAPPER}} .codegen-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => esc_html__('Background', 'codegen-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .codegen-pricing',
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
                    '{{WRAPPER}} .pricing-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'codegen-pro'),
                'selector' => '{{WRAPPER}} .pricing-title',
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
                    '{{WRAPPER}} .pricing-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section - Pricing Cards
        $this->start_controls_section(
            'cards_style',
            [
                'label' => esc_html__('Pricing Cards', 'codegen-pro'),
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
                    '{{WRAPPER}} .pricing-card' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .pricing-card' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'popular_card_border',
            [
                'label' => esc_html__('Popular Card Border', 'codegen-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6366f1',
                'selectors' => [
                    '{{WRAPPER}} .pricing-card.popular' => 'border-color: {{VALUE}};',
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
        
        <div class="codegen-pricing">
            <div class="container">
                
                <div class="pricing-header animate-fade-in-up">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2 class="pricing-title">
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h2>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="pricing-subtitle">
                            <?php echo wp_kses_post($settings['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($settings['pricing_plans'])) : ?>
                    <div class="pricing-grid">
                        <?php foreach ($settings['pricing_plans'] as $index => $plan) : ?>
                            <div class="pricing-card <?php echo $plan['is_popular'] === 'yes' ? 'popular' : ''; ?> animate-fade-in-up" style="animation-delay: <?php echo ($index * 0.1 + 0.3); ?>s;">
                                
                                <?php if ($plan['is_popular'] === 'yes') : ?>
                                    <div class="popular-badge">Most Popular</div>
                                <?php endif; ?>
                                
                                <div class="pricing-header-card">
                                    <?php if (!empty($plan['plan_name'])) : ?>
                                        <h3 class="plan-name"><?php echo esc_html($plan['plan_name']); ?></h3>
                                    <?php endif; ?>
                                    
                                    <div class="plan-price">
                                        <?php if (!empty($plan['price'])) : ?>
                                            <span class="price"><?php echo esc_html($plan['price']); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($plan['period'])) : ?>
                                            <span class="period"><?php echo esc_html($plan['period']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <?php if (!empty($plan['description'])) : ?>
                                        <p class="plan-description"><?php echo esc_html($plan['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if (!empty($plan['features'])) : ?>
                                    <div class="plan-features">
                                        <?php 
                                        $features = explode("\n", $plan['features']);
                                        foreach ($features as $feature) : 
                                            if (trim($feature)) :
                                        ?>
                                            <div class="feature-item">
                                                <span class="feature-check">✓</span>
                                                <span class="feature-text"><?php echo esc_html(trim($feature)); ?></span>
                                            </div>
                                        <?php 
                                            endif;
                                        endforeach; 
                                        ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($plan['button_text'])) : ?>
                                    <div class="plan-button">
                                        <a href="<?php echo esc_url($plan['button_url']['url']); ?>" 
                                           class="btn <?php echo $plan['is_popular'] === 'yes' ? 'btn-primary' : 'btn-secondary'; ?>"
                                           <?php echo $plan['button_url']['is_external'] ? 'target="_blank"' : ''; ?>
                                           <?php echo $plan['button_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                            <?php echo esc_html($plan['button_text']); ?>
                                        </a>
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

