<?php
namespace Elementor_Pro_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Pricing Table Widget
 */
class Pricing_Table_Widget extends Widget_Base {

    public function get_name() {
        return 'epa-pricing-table';
    }

    public function get_title() {
        return __('جدول قیمت', 'elementor-pro-addons');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return ['pro-addons'];
    }

    public function get_keywords() {
        return ['pricing', 'table', 'قیمت', 'price'];
    }

    protected function register_controls() {
        // Header Section
        $this->start_controls_section(
            'section_header',
            [
                'label' => __('هدر', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => __('عنوان', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('پایه', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label' => __('زیرعنوان', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('برای شروع', 'elementor-pro-addons'),
            ]
        );

        $this->end_controls_section();

        // Pricing Section
        $this->start_controls_section(
            'section_pricing',
            [
                'label' => __('قیمت', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'currency_symbol',
            [
                'label' => __('نماد ارز', 'elementor-pro-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('هیچ', 'elementor-pro-addons'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'elementor-pro-addons'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'elementor-pro-addons'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'elementor-pro-addons'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'elementor-pro-addons'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'elementor-pro-addons'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'elementor-pro-addons'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'elementor-pro-addons'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'elementor-pro-addons'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'elementor-pro-addons'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'elementor-pro-addons'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'elementor-pro-addons'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'elementor-pro-addons'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'elementor-pro-addons'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'elementor-pro-addons'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'elementor-pro-addons'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'elementor-pro-addons'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'elementor-pro-addons'),
                    'custom' => __('سفارشی', 'elementor-pro-addons'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_symbol_custom',
            [
                'label' => __('نماد ارز سفارشی', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency_symbol' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __('قیمت', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '39.99',
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => __('دوره', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('ماهانه', 'elementor-pro-addons'),
            ]
        );

        $this->end_controls_section();

        // Features Section
        $this->start_controls_section(
            'section_features',
            [
                'label' => __('ویژگی‌ها', 'elementor-pro-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_text',
            [
                'label' => __('متن', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('ویژگی لیست', 'elementor-pro-addons'),
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => __('آیکون', 'elementor-pro-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_text' => __('ویژگی اول', 'elementor-pro-addons'),
                        'item_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'item_text' => __('ویژگی دوم', 'elementor-pro-addons'),
                        'item_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'item_text' => __('ویژگی سوم', 'elementor-pro-addons'),
                        'item_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->end_controls_section();

        // Footer Section
        $this->start_controls_section(
            'section_footer',
            [
                'label' => __('دکمه', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('متن دکمه', 'elementor-pro-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('انتخاب پلن', 'elementor-pro-addons'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('لینک', 'elementor-pro-addons'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'elementor-pro-addons'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $symbol = '';

        if (!empty($settings['currency_symbol'])) {
            if ('custom' !== $settings['currency_symbol']) {
                $symbol = $this->get_currency_symbol($settings['currency_symbol']);
            } else {
                $symbol = $settings['currency_symbol_custom'];
            }
        }

        if (!empty($settings['link']['url'])) {
            $this->add_link_attributes('link', $settings['link']);
        }
        ?>
        <div class="epa-pricing-table">
            <div class="epa-pricing-table-header">
                <h3 class="epa-pricing-table-heading"><?php echo $settings['heading']; ?></h3>
                <?php if (!empty($settings['sub_heading'])) : ?>
                    <div class="epa-pricing-table-subheading"><?php echo $settings['sub_heading']; ?></div>
                <?php endif; ?>
            </div>

            <div class="epa-pricing-table-price">
                <?php if (!empty($symbol)) : ?>
                    <span class="epa-pricing-table-currency"><?php echo $symbol; ?></span>
                <?php endif; ?>
                <span class="epa-pricing-table-integer-part"><?php echo $settings['price']; ?></span>
                <?php if (!empty($settings['period'])) : ?>
                    <span class="epa-pricing-table-period"><?php echo $settings['period']; ?></span>
                <?php endif; ?>
            </div>

            <?php if (!empty($settings['features_list'])) : ?>
                <ul class="epa-pricing-table-features-list">
                    <?php foreach ($settings['features_list'] as $index => $item) : ?>
                        <li class="epa-pricing-table-feature-item">
                            <?php if (!empty($item['item_icon']['value'])) : ?>
                                <span class="epa-pricing-table-feature-icon">
                                    <?php Icons_Manager::render_icon($item['item_icon'], ['aria-hidden' => 'true']); ?>
                                </span>
                            <?php endif; ?>
                            <span class="epa-pricing-table-feature-text"><?php echo $item['item_text']; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($settings['button_text'])) : ?>
                <div class="epa-pricing-table-footer">
                    <a <?php echo $this->get_render_attribute_string('link'); ?> class="epa-pricing-table-button">
                        <?php echo $settings['button_text']; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    private function get_currency_symbol($symbol_name) {
        $symbols = [
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'pound' => '&#163;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'baht' => '&#3647;',
            'yen' => '&#165;',
            'won' => '&#8361;',
            'guilder' => '&fnof;',
            'peso' => '&#8369;',
            'peseta' => '&#8359;',
            'lira' => '&#8356;',
            'rupee' => '&#8360;',
            'indian_rupee' => '&#8377;',
            'real' => 'R$',
            'krona' => 'kr',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }
}
