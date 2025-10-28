<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Helper Functions for Elementor Pro Addons
 */

/**
 * Get widget setting with default value
 */
function epa_get_widget_setting($settings, $key, $default = '') {
    return isset($settings[$key]) ? $settings[$key] : $default;
}

/**
 * Render icon
 */
function epa_render_icon($icon, $attributes = []) {
    if (empty($icon['value'])) {
        return;
    }

    $tag = 'span';
    $icon_attributes = $attributes;
    $icon_attributes['class'] = isset($attributes['class']) ? $attributes['class'] . ' epa-icon' : 'epa-icon';

    if (!empty($icon['library']) && 'svg' === $icon['library']) {
        $icon_attributes['class'] .= ' epa-icon-svg';
        echo '<' . $tag . ' ' . \Elementor\Utils::render_html_attributes($icon_attributes) . '>';
        \Elementor\Icons_Manager::render_icon($icon);
        echo '</' . $tag . '>';
    } else {
        $icon_attributes['class'] .= ' ' . $icon['value'];
        echo '<' . $tag . ' ' . \Elementor\Utils::render_html_attributes($icon_attributes) . '></' . $tag . '>';
    }
}

/**
 * Get animation class
 */
function epa_get_animation_class($animation) {
    if (empty($animation)) {
        return '';
    }

    return 'animated ' . $animation;
}

/**
 * Sanitize HTML classes
 */
function epa_sanitize_html_class($class) {
    return sanitize_html_class($class);
}

/**
 * Get responsive setting
 */
function epa_get_responsive_setting($settings, $setting_key, $device = '') {
    $setting_key = $setting_key . (!empty($device) ? '_' . $device : '');
    return isset($settings[$setting_key]) ? $settings[$setting_key] : '';
}

/**
 * Render link attributes
 */
function epa_render_link_attributes($link, $additional_attributes = []) {
    $attributes = [];

    if (!empty($link['url'])) {
        $attributes['href'] = $link['url'];
    }

    if (!empty($link['is_external'])) {
        $attributes['target'] = '_blank';
    }

    if (!empty($link['nofollow'])) {
        $attributes['rel'] = 'nofollow';
    }

    if (!empty($link['custom_attributes'])) {
        $custom_attributes = \Elementor\Utils::parse_custom_attributes($link['custom_attributes']);
        $attributes = array_merge($attributes, $custom_attributes);
    }

    $attributes = array_merge($attributes, $additional_attributes);

    $rendered_attributes = [];
    foreach ($attributes as $attribute_key => $attribute_values) {
        $rendered_attributes[] = $attribute_key . '="' . esc_attr($attribute_values) . '"';
    }

    return implode(' ', $rendered_attributes);
}

/**
 * Get image size options
 */
function epa_get_image_sizes() {
    $image_sizes = get_intermediate_image_sizes();
    $image_sizes[] = 'full';

    $options = [];
    foreach ($image_sizes as $size) {
        $options[$size] = ucwords(str_replace('_', ' ', $size));
    }

    return $options;
}

/**
 * Get post types
 */
function epa_get_post_types() {
    $post_types = get_post_types(['public' => true], 'objects');
    $options = [];

    foreach ($post_types as $post_type) {
        $options[$post_type->name] = $post_type->label;
    }

    return $options;
}

/**
 * Get taxonomies
 */
function epa_get_taxonomies() {
    $taxonomies = get_taxonomies(['public' => true], 'objects');
    $options = [];

    foreach ($taxonomies as $taxonomy) {
        $options[$taxonomy->name] = $taxonomy->label;
    }

    return $options;
}

/**
 * Format number
 */
function epa_format_number($number, $decimals = 0) {
    return number_format_i18n($number, $decimals);
}

/**
 * Get reading time
 */
function epa_get_reading_time($content) {
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute
    
    return $reading_time;
}

/**
 * Truncate text
 */
function epa_truncate_text($text, $length = 100, $suffix = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }

    return substr($text, 0, $length) . $suffix;
}

