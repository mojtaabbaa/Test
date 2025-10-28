<?php
namespace Elementor_Pro_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Team Member Widget
 */
class Team_Member_Widget extends Widget_Base {

    public function get_name() {
        return 'epa-team-member';
    }

    public function get_title() {
        return __('عضو تیم', 'elementor-pro-addons');
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return ['pro-addons'];
    }

    public function get_keywords() {
        return ['team', 'member', 'تیم', 'person'];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'section_team_member',
            [
                'label' => __('عضو تیم', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('تصویر', 'elementor-pro-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => __('نام', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('احمد محمدی', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'job',
            [
                'label' => __('شغل', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('طراح وب', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('توضیحات', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('توضیحات کوتاه درباره عضو تیم در اینجا قرار می‌گیرد.', 'elementor-pro-addons'),
                'rows' => 4,
            ]
        );

        $this->end_controls_section();

        // Social Links Section
        $this->start_controls_section(
            'section_social_links',
            [
                'label' => __('شبکه‌های اجتماعی', 'elementor-pro-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_icon',
            [
                'label' => __('آیکون', 'elementor-pro-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-facebook',
                    'library' => 'fa-brands',
                ],
            ]
        );

        $repeater->add_control(
            'social_link',
            [
                'label' => __('لینک', 'elementor-pro-addons'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'social_links',
            [
                'label' => __('شبکه‌های اجتماعی', 'elementor-pro-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'social_icon' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands',
                        ],
                        'social_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'social_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ],
                        'social_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'social_icon' => [
                            'value' => 'fab fa-linkedin',
                            'library' => 'fa-brands',
                        ],
                        'social_link' => [
                            'url' => '#',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'section_style_image',
            [
                'label' => __('تصویر', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_space',
            [
                'label' => __('فاصله', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .epa-team-member-image img',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => __('شعاع حاشیه', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .epa-team-member-image img',
            ]
        );

        $this->end_controls_section();

        // Name Style
        $this->start_controls_section(
            'section_style_name',
            [
                'label' => __('نام', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => __('رنگ', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .epa-team-member-name',
            ]
        );

        $this->add_responsive_control(
            'name_space',
            [
                'label' => __('فاصله', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job Style
        $this->start_controls_section(
            'section_style_job',
            [
                'label' => __('شغل', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_color',
            [
                'label' => __('رنگ', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'job_typography',
                'selector' => '{{WRAPPER}} .epa-team-member-job',
            ]
        );

        $this->add_responsive_control(
            'job_space',
            [
                'label' => __('فاصله', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-job' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Description Style
        $this->start_controls_section(
            'section_style_description',
            [
                'label' => __('توضیحات', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('رنگ', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .epa-team-member-description',
            ]
        );

        $this->add_responsive_control(
            'description_space',
            [
                'label' => __('فاصله', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Social Links Style
        $this->start_controls_section(
            'section_style_social',
            [
                'label' => __('شبکه‌های اجتماعی', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'social_icon_size',
            [
                'label' => __('اندازه آیکون', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-social a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icon_spacing',
            [
                'label' => __('فاصله بین آیکون‌ها', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-social a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_social_style');

        $this->start_controls_tab(
            'tab_social_normal',
            [
                'label' => __('عادی', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'social_color',
            [
                'label' => __('رنگ', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-social a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_bg_color',
            [
                'label' => __('رنگ پس‌زمینه', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-social a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_social_hover',
            [
                'label' => __('هاور', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'social_hover_color',
            [
                'label' => __('رنگ', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-social a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_hover_bg_color',
            [
                'label' => __('رنگ پس‌زمینه', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-social a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'social_padding',
            [
                'label' => __('فاصله داخلی', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-social a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'social_border',
                'selector' => '{{WRAPPER}} .epa-team-member-social a',
            ]
        );

        $this->add_responsive_control(
            'social_border_radius',
            [
                'label' => __('شعاع حاشیه', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .epa-team-member-social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="epa-team-member">
            <?php if (!empty($settings['image']['url'])) : ?>
                <div class="epa-team-member-image">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image'); ?>
                </div>
            <?php endif; ?>

            <div class="epa-team-member-content">
                <?php if (!empty($settings['name'])) : ?>
                    <h3 class="epa-team-member-name"><?php echo esc_html($settings['name']); ?></h3>
                <?php endif; ?>

                <?php if (!empty($settings['job'])) : ?>
                    <div class="epa-team-member-job"><?php echo esc_html($settings['job']); ?></div>
                <?php endif; ?>

                <?php if (!empty($settings['description'])) : ?>
                    <div class="epa-team-member-description"><?php echo esc_html($settings['description']); ?></div>
                <?php endif; ?>

                <?php if (!empty($settings['social_links'])) : ?>
                    <div class="epa-team-member-social">
                        <?php foreach ($settings['social_links'] as $index => $item) : ?>
                            <?php if (!empty($item['social_link']['url'])) : ?>
                                <?php
                                $link_key = 'link_' . $index;
                                $this->add_link_attributes($link_key, $item['social_link']);
                                ?>
                                <a <?php echo $this->get_render_attribute_string($link_key); ?>>
                                    <?php Icons_Manager::render_icon($item['social_icon'], ['aria-hidden' => 'true']); ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
