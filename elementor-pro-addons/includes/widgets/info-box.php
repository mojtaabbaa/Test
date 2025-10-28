<?php
namespace Elementor_Pro_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Info Box Widget
 */
class Info_Box_Widget extends Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'epa-info-box';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return __('جعبه اطلاعات', 'elementor-pro-addons');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-info-box';
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
        return ['info', 'box', 'اطلاعات', 'feature'];
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
            'icon',
            [
                'label' => __('آیکون', 'elementor-pro-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('عنوان', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('عنوان جعبه اطلاعات', 'elementor-pro-addons'),
                'placeholder' => __('عنوان را وارد کنید', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('توضیحات', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('این یک توضیح نمونه برای جعبه اطلاعات است. می‌توانید متن دلخواه خود را در اینجا قرار دهید.', 'elementor-pro-addons'),
                'placeholder' => __('توضیحات را وارد کنید', 'elementor-pro-addons'),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => false,
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
                'placeholder' => __('https://your-link.com', 'elementor-pro-addons'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'position',
            [
                'label' => __('موقعیت آیکون', 'elementor-pro-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'top',
                'options' => [
                    'left' => [
                        'title' => __('چپ', 'elementor-pro-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => __('بالا', 'elementor-pro-addons'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => __('راست', 'elementor-pro-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'epa-position-',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label' => __('تگ عنوان', 'elementor-pro-addons'),
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
                'default' => 'h3',
            ]
        );

        $this->end_controls_section();

        // Icon Style Section
        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => __('آیکون', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => __('رنگ اصلی', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.epa-view-stacked .epa-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.epa-view-framed .epa-icon, {{WRAPPER}}.epa-view-default .epa-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'secondary_color',
            [
                'label' => __('رنگ ثانویه', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.epa-view-framed .epa-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.epa-view-stacked .epa-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __('نمایش', 'elementor-pro-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __('پیش‌فرض', 'elementor-pro-addons'),
                    'stacked' => __('پشت‌زمینه‌دار', 'elementor-pro-addons'),
                    'framed' => __('حاشیه‌دار', 'elementor-pro-addons'),
                ],
                'default' => 'default',
                'prefix_class' => 'epa-view-',
            ]
        );

        $this->add_control(
            'shape',
            [
                'label' => __('شکل', 'elementor-pro-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => __('دایره', 'elementor-pro-addons'),
                    'square' => __('مربع', 'elementor-pro-addons'),
                ],
                'default' => 'circle',
                'condition' => [
                    'view!' => 'default',
                ],
                'prefix_class' => 'epa-shape-',
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('اندازه', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => __('فاصله داخلی', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .epa-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'condition' => [
                    'view!' => 'default',
                ],
            ]
        );

        $this->add_control(
            'rotate',
            [
                'label' => __('چرخش', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => __('عرض حاشیه', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .epa-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'view' => 'framed',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('شعاع حاشیه', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .epa-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'view!' => 'default',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Style Section
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('محتوا', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_align',
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
                'selectors' => [
                    '{{WRAPPER}} .epa-info-box-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_vertical_alignment',
            [
                'label' => __('تراز عمودی', 'elementor-pro-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => __('بالا', 'elementor-pro-addons'),
                    'middle' => __('وسط', 'elementor-pro-addons'),
                    'bottom' => __('پایین', 'elementor-pro-addons'),
                ],
                'default' => 'top',
                'prefix_class' => 'epa-vertical-align-',
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label' => __('عنوان', 'elementor-pro-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label' => __('فاصله', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-info-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('رنگ', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .epa-info-box-content .epa-info-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .epa-info-box-content .epa-info-box-title',
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label' => __('توضیحات', 'elementor-pro-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('رنگ', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .epa-info-box-content .epa-info-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .epa-info-box-content .epa-info-box-description',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'epa-info-box-wrapper');

        if (!empty($settings['link']['url'])) {
            $this->add_link_attributes('link', $settings['link']);
        }

        $this->add_render_attribute('icon', 'class', ['epa-icon', 'epa-icon-' . $settings['icon']['library']]);

        $this->add_render_attribute('title', 'class', 'epa-info-box-title');

        $this->add_render_attribute('description', 'class', 'epa-info-box-description');

        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <?php if (!empty($settings['link']['url'])) : ?>
                <a <?php echo $this->get_render_attribute_string('link'); ?>>
            <?php endif; ?>
            
            <div class="epa-info-box-icon">
                <span <?php echo $this->get_render_attribute_string('icon'); ?>>
                    <?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                </span>
            </div>
            
            <div class="epa-info-box-content">
                <<?php echo $settings['title_size']; ?> <?php echo $this->get_render_attribute_string('title'); ?>>
                    <?php echo $settings['title']; ?>
                </<?php echo $settings['title_size']; ?>>
                
                <p <?php echo $this->get_render_attribute_string('description'); ?>>
                    <?php echo $settings['description']; ?>
                </p>
            </div>
            
            <?php if (!empty($settings['link']['url'])) : ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <#
        var link = settings.link.url ? 'href="' + settings.link.url + '"' : '';
        var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
        #>
        <div class="epa-info-box-wrapper">
            <# if ( settings.link.url ) { #>
                <a {{{ link }}}>
            <# } #>
            
            <div class="epa-info-box-icon">
                <span class="epa-icon epa-icon-{{{ settings.icon.library }}}">
                    {{{ iconHTML.value }}}
                </span>
            </div>
            
            <div class="epa-info-box-content">
                <{{{ settings.title_size }}} class="epa-info-box-title">
                    {{{ settings.title }}}
                </{{{ settings.title_size }}}>
                
                <p class="epa-info-box-description">
                    {{{ settings.description }}}
                </p>
            </div>
            
            <# if ( settings.link.url ) { #>
                </a>
            <# } #>
        </div>
        <?php
    }
}

