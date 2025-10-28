<?php
namespace Elementor_Pro_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Advanced Heading Widget
 */
class Advanced_Heading_Widget extends Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'epa-advanced-heading';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return __('عنوان پیشرفته', 'elementor-pro-addons');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-heading';
    }

    /**
     * Get widget categories
     */
    public function get_categories() {
        return ['pro-addons'];
    }

    /**
     * Get widget keywords
     */
    public function get_keywords() {
        return ['heading', 'title', 'عنوان', 'advanced'];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('محتوا', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label' => __('متن عنوان', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('متن عنوان خود را وارد کنید', 'elementor-pro-addons'),
                'default' => __('عنوان پیشرفته', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'heading_tag',
            [
                'label' => __('تگ HTML', 'elementor-pro-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('لینک', 'elementor-pro-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('تراز', 'elementor-pro-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('چپ', 'elementor-pro-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('وسط', 'elementor-pro-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('راست', 'elementor-pro-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('تراز', 'elementor-pro-addons'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('استایل', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('رنگ متن', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-advanced-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .epa-advanced-heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .epa-advanced-heading',
            ]
        );

        $this->add_control(
            'blend_mode',
            [
                'label' => __('حالت ترکیب', 'elementor-pro-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('عادی', 'elementor-pro-addons'),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                    'hue' => 'Hue',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-advanced-heading' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        // Background Section
        $this->start_controls_section(
            'background_section',
            [
                'label' => __('پس‌زمینه', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __('پس‌زمینه', 'elementor-pro-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .epa-advanced-heading',
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __('فاصله داخلی', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .epa-advanced-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => __('فاصله خارجی', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .epa-advanced-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .epa-advanced-heading',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __('شعاع حاشیه', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .epa-advanced-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        if (empty($settings['heading_text'])) {
            return;
        }

        $this->add_render_attribute('heading', 'class', 'epa-advanced-heading');

        $heading_html = sprintf('<%1$s %2$s>%3$s</%1$s>', 
            $settings['heading_tag'], 
            $this->get_render_attribute_string('heading'), 
            $settings['heading_text']
        );

        if (!empty($settings['link']['url'])) {
            $this->add_link_attributes('url', $settings['link']);
            $heading_html = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), $heading_html);
        }

        echo $heading_html;
    }

    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <#
        var heading_html = '<' + settings.heading_tag  + ' class="epa-advanced-heading">' + settings.heading_text + '</' + settings.heading_tag + '>';

        if ( settings.link.url ) {
            heading_html = '<a href="' + settings.link.url + '">' + heading_html + '</a>';
        }

        print( heading_html );
        #>
        <?php
    }
}

