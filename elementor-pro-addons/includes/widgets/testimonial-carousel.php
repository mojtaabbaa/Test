<?php
namespace Elementor_Pro_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Testimonial Carousel Widget
 */
class Testimonial_Carousel_Widget extends Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'epa-testimonial-carousel';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return __('اسلایدر نظرات', 'elementor-pro-addons');
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
        return ['pro-addons'];
    }

    /**
     * Get widget keywords
     */
    public function get_keywords() {
        return ['testimonial', 'carousel', 'نظرات', 'slider', 'review'];
    }

    /**
     * Get script dependencies
     */
    public function get_script_depends() {
        return ['swiper'];
    }

    /**
     * Get style dependencies
     */
    public function get_style_depends() {
        return ['swiper'];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('نظرات', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_content',
            [
                'label' => __('محتوای نظر', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('این یک نظر نمونه است. محتوای نظر مشتری در اینجا قرار می‌گیرد.', 'elementor-pro-addons'),
                'placeholder' => __('نظر مشتری را وارد کنید', 'elementor-pro-addons'),
                'rows' => 10,
            ]
        );

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => __('تصویر', 'elementor-pro-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'testimonial_name',
            [
                'label' => __('نام', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('نام مشتری', 'elementor-pro-addons'),
            ]
        );

        $repeater->add_control(
            'testimonial_job',
            [
                'label' => __('شغل', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('مدیرعامل شرکت', 'elementor-pro-addons'),
            ]
        );

        $repeater->add_control(
            'testimonial_rating',
            [
                'label' => __('امتیاز', 'elementor-pro-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5,
                'step' => 0.1,
                'default' => 5,
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => __('لیست نظرات', 'elementor-pro-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_content' => __('این یک نظر نمونه است. محتوای نظر مشتری در اینجا قرار می‌گیرد.', 'elementor-pro-addons'),
                        'testimonial_name' => __('احمد محمدی', 'elementor-pro-addons'),
                        'testimonial_job' => __('مدیرعامل شرکت', 'elementor-pro-addons'),
                        'testimonial_rating' => 5,
                    ],
                    [
                        'testimonial_content' => __('خدمات عالی و کیفیت بالا. پیشنهاد می‌کنم.', 'elementor-pro-addons'),
                        'testimonial_name' => __('فاطمه احمدی', 'elementor-pro-addons'),
                        'testimonial_job' => __('مدیر بازاریابی', 'elementor-pro-addons'),
                        'testimonial_rating' => 4.5,
                    ],
                    [
                        'testimonial_content' => __('تجربه فوق‌العاده‌ای داشتم. حتماً دوباره استفاده خواهم کرد.', 'elementor-pro-addons'),
                        'testimonial_name' => __('علی رضایی', 'elementor-pro-addons'),
                        'testimonial_job' => __('طراح وب', 'elementor-pro-addons'),
                        'testimonial_rating' => 5,
                    ],
                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->end_controls_section();

        // Carousel Settings
        $this->start_controls_section(
            'carousel_settings',
            [
                'label' => __('تنظیمات اسلایدر', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'slides_to_show',
            [
                'label' => __('تعداد اسلاید', 'elementor-pro-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
            ]
        );

        $this->add_control(
            'slides_to_scroll',
            [
                'label' => __('تعداد اسکرول', 'elementor-pro-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('پخش خودکار', 'elementor-pro-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('سرعت پخش خودکار', 'elementor-pro-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => __('حلقه بی‌نهایت', 'elementor-pro-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __('سرعت انیمیشن', 'elementor-pro-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __('دکمه‌های ناوبری', 'elementor-pro-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => __('نقطه‌های ناوبری', 'elementor-pro-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('استایل کلی', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label' => __('فاصله بین اسلایدها', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-testimonial-carousel .swiper-slide' => 'padding-left: calc({{SIZE}}{{UNIT}}/2); padding-right: calc({{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .epa-testimonial-carousel .swiper-wrapper' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'testimonial_background',
                'label' => __('پس‌زمینه', 'elementor-pro-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .epa-testimonial-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_border',
                'selector' => '{{WRAPPER}} .epa-testimonial-item',
            ]
        );

        $this->add_responsive_control(
            'testimonial_border_radius',
            [
                'label' => __('شعاع حاشیه', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .epa-testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .epa-testimonial-item',
            ]
        );

        $this->add_responsive_control(
            'testimonial_padding',
            [
                'label' => __('فاصله داخلی', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .epa-testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Style
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => __('محتوا', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __('رنگ متن', 'elementor-pro-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .epa-testimonial-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .epa-testimonial-content',
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __('فاصله', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .epa-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Image Style
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => __('تصویر', 'elementor-pro-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label' => __('اندازه تصویر', 'elementor-pro-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .epa-testimonial-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .epa-testimonial-image img',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => __('شعاع حاشیه', 'elementor-pro-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .epa-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name Style
        $this->start_controls_section(
            'name_style_section',
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
                    '{{WRAPPER}} .epa-testimonial-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .epa-testimonial-name',
            ]
        );

        $this->end_controls_section();

        // Job Style
        $this->start_controls_section(
            'job_style_section',
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
                    '{{WRAPPER}} .epa-testimonial-job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'job_typography',
                'selector' => '{{WRAPPER}} .epa-testimonial-job',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['testimonials'])) {
            return;
        }

        $slides_to_show = $settings['slides_to_show'];
        $slides_to_show_tablet = $settings['slides_to_show_tablet'] ?: $slides_to_show;
        $slides_to_show_mobile = $settings['slides_to_show_mobile'] ?: $slides_to_show_tablet;

        $swiper_settings = [
            'slidesPerView' => (int) $slides_to_show_mobile,
            'spaceBetween' => 30,
            'loop' => $settings['infinite'] === 'yes',
            'speed' => (int) $settings['speed'],
            'breakpoints' => [
                768 => [
                    'slidesPerView' => (int) $slides_to_show_tablet,
                ],
                1024 => [
                    'slidesPerView' => (int) $slides_to_show,
                ],
            ],
        ];

        if ($settings['autoplay'] === 'yes') {
            $swiper_settings['autoplay'] = [
                'delay' => (int) $settings['autoplay_speed'],
            ];
        }

        if ($settings['navigation'] === 'yes') {
            $swiper_settings['navigation'] = [
                'nextEl' => '.epa-swiper-button-next',
                'prevEl' => '.epa-swiper-button-prev',
            ];
        }

        if ($settings['pagination'] === 'yes') {
            $swiper_settings['pagination'] = [
                'el' => '.epa-swiper-pagination',
                'clickable' => true,
            ];
        }

        $this->add_render_attribute('carousel', [
            'class' => 'epa-testimonial-carousel swiper-container',
            'data-swiper-settings' => wp_json_encode($swiper_settings),
        ]);

        ?>
        <div <?php echo $this->get_render_attribute_string('carousel'); ?>>
            <div class="swiper-wrapper">
                <?php foreach ($settings['testimonials'] as $index => $testimonial) : ?>
                    <div class="swiper-slide">
                        <div class="epa-testimonial-item">
                            <?php if (!empty($testimonial['testimonial_content'])) : ?>
                                <div class="epa-testimonial-content">
                                    <p><?php echo esc_html($testimonial['testimonial_content']); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($testimonial['testimonial_rating'])) : ?>
                                <div class="epa-testimonial-rating">
                                    <?php
                                    $rating = (float) $testimonial['testimonial_rating'];
                                    $full_stars = floor($rating);
                                    $half_star = $rating - $full_stars >= 0.5;
                                    
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $full_stars) {
                                            echo '<i class="fas fa-star"></i>';
                                        } elseif ($i == $full_stars + 1 && $half_star) {
                                            echo '<i class="fas fa-star-half-alt"></i>';
                                        } else {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>

                            <div class="epa-testimonial-meta">
                                <?php if (!empty($testimonial['testimonial_image']['url'])) : ?>
                                    <div class="epa-testimonial-image">
                                        <img src="<?php echo esc_url($testimonial['testimonial_image']['url']); ?>" alt="<?php echo esc_attr($testimonial['testimonial_name']); ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="epa-testimonial-details">
                                    <?php if (!empty($testimonial['testimonial_name'])) : ?>
                                        <div class="epa-testimonial-name"><?php echo esc_html($testimonial['testimonial_name']); ?></div>
                                    <?php endif; ?>

                                    <?php if (!empty($testimonial['testimonial_job'])) : ?>
                                        <div class="epa-testimonial-job"><?php echo esc_html($testimonial['testimonial_job']); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($settings['pagination'] === 'yes') : ?>
                <div class="epa-swiper-pagination swiper-pagination"></div>
            <?php endif; ?>

            <?php if ($settings['navigation'] === 'yes') : ?>
                <div class="epa-swiper-button-prev swiper-button-prev"></div>
                <div class="epa-swiper-button-next swiper-button-next"></div>
            <?php endif; ?>
        </div>
        <?php
    }
}

