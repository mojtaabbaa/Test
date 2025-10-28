<?php
/**
 * Theme Options Panel
 *
 * @package Codegen_Pro
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add theme options page
 */
function codegen_pro_add_theme_options_page() {
    add_theme_page(
        __('Codegen Pro Options', 'codegen-pro'),
        __('Theme Options', 'codegen-pro'),
        'manage_options',
        'codegen-pro-options',
        'codegen_pro_theme_options_page'
    );
}
add_action('admin_menu', 'codegen_pro_add_theme_options_page');

/**
 * Theme options page content
 */
function codegen_pro_theme_options_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Codegen Pro Theme Options', 'codegen-pro'); ?></h1>
        
        <?php
        if (isset($_POST['submit'])) {
            codegen_pro_save_theme_options();
            echo '<div class="notice notice-success"><p>' . __('Settings saved successfully!', 'codegen-pro') . '</p></div>';
        }
        ?>
        
        <form method="post" action="">
            <?php wp_nonce_field('codegen_pro_theme_options', 'codegen_pro_nonce'); ?>
            
            <div class="codegen-pro-options-wrapper">
                <div class="codegen-pro-options-main">
                    
                    <!-- General Settings -->
                    <div class="postbox">
                        <h2 class="hndle"><span><?php _e('General Settings', 'codegen-pro'); ?></span></h2>
                        <div class="inside">
                            <table class="form-table">
                                <tr>
                                    <th scope="row"><?php _e('Site Logo Text', 'codegen-pro'); ?></th>
                                    <td>
                                        <input type="text" name="site_logo_text" value="<?php echo esc_attr(get_option('codegen_pro_site_logo_text', get_bloginfo('name'))); ?>" class="regular-text" />
                                        <p class="description"><?php _e('Enter custom text for the site logo. Leave empty to use site title.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Enable Preloader', 'codegen-pro'); ?></th>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="enable_preloader" value="1" <?php checked(get_option('codegen_pro_enable_preloader', 1)); ?> />
                                            <?php _e('Show loading animation on page load', 'codegen-pro'); ?>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Back to Top Button', 'codegen-pro'); ?></th>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="back_to_top" value="1" <?php checked(get_option('codegen_pro_back_to_top', 1)); ?> />
                                            <?php _e('Show back to top button', 'codegen-pro'); ?>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Smooth Scrolling', 'codegen-pro'); ?></th>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="smooth_scrolling" value="1" <?php checked(get_option('codegen_pro_smooth_scrolling', 1)); ?> />
                                            <?php _e('Enable smooth scrolling for anchor links', 'codegen-pro'); ?>
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Hero Section Settings -->
                    <div class="postbox">
                        <h2 class="hndle"><span><?php _e('Hero Section', 'codegen-pro'); ?></span></h2>
                        <div class="inside">
                            <table class="form-table">
                                <tr>
                                    <th scope="row"><?php _e('Hero Background Image', 'codegen-pro'); ?></th>
                                    <td>
                                        <input type="text" name="hero_bg_image" id="hero_bg_image" value="<?php echo esc_url(get_option('codegen_pro_hero_bg_image')); ?>" class="regular-text" />
                                        <input type="button" class="button" id="hero_bg_image_button" value="<?php _e('Select Image', 'codegen-pro'); ?>" />
                                        <p class="description"><?php _e('Choose a background image for the hero section.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Hero Overlay Opacity', 'codegen-pro'); ?></th>
                                    <td>
                                        <input type="range" name="hero_overlay_opacity" min="0" max="100" value="<?php echo esc_attr(get_option('codegen_pro_hero_overlay_opacity', 50)); ?>" class="slider" />
                                        <span class="slider-value"><?php echo get_option('codegen_pro_hero_overlay_opacity', 50); ?>%</span>
                                        <p class="description"><?php _e('Adjust the overlay opacity for better text readability.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Hero Animation', 'codegen-pro'); ?></th>
                                    <td>
                                        <select name="hero_animation">
                                            <option value="fade-in" <?php selected(get_option('codegen_pro_hero_animation', 'fade-in'), 'fade-in'); ?>><?php _e('Fade In', 'codegen-pro'); ?></option>
                                            <option value="slide-up" <?php selected(get_option('codegen_pro_hero_animation'), 'slide-up'); ?>><?php _e('Slide Up', 'codegen-pro'); ?></option>
                                            <option value="slide-down" <?php selected(get_option('codegen_pro_hero_animation'), 'slide-down'); ?>><?php _e('Slide Down', 'codegen-pro'); ?></option>
                                            <option value="zoom-in" <?php selected(get_option('codegen_pro_hero_animation'), 'zoom-in'); ?>><?php _e('Zoom In', 'codegen-pro'); ?></option>
                                            <option value="none" <?php selected(get_option('codegen_pro_hero_animation'), 'none'); ?>><?php _e('No Animation', 'codegen-pro'); ?></option>
                                        </select>
                                        <p class="description"><?php _e('Choose animation effect for hero section elements.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Typography Settings -->
                    <div class="postbox">
                        <h2 class="hndle"><span><?php _e('Typography', 'codegen-pro'); ?></span></h2>
                        <div class="inside">
                            <table class="form-table">
                                <tr>
                                    <th scope="row"><?php _e('Primary Font', 'codegen-pro'); ?></th>
                                    <td>
                                        <select name="primary_font">
                                            <option value="Inter" <?php selected(get_option('codegen_pro_primary_font', 'Inter'), 'Inter'); ?>>Inter</option>
                                            <option value="Roboto" <?php selected(get_option('codegen_pro_primary_font'), 'Roboto'); ?>>Roboto</option>
                                            <option value="Open Sans" <?php selected(get_option('codegen_pro_primary_font'), 'Open Sans'); ?>>Open Sans</option>
                                            <option value="Lato" <?php selected(get_option('codegen_pro_primary_font'), 'Lato'); ?>>Lato</option>
                                            <option value="Poppins" <?php selected(get_option('codegen_pro_primary_font'), 'Poppins'); ?>>Poppins</option>
                                            <option value="Montserrat" <?php selected(get_option('codegen_pro_primary_font'), 'Montserrat'); ?>>Montserrat</option>
                                        </select>
                                        <p class="description"><?php _e('Choose the primary font for your website.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Font Size Scale', 'codegen-pro'); ?></th>
                                    <td>
                                        <select name="font_size_scale">
                                            <option value="small" <?php selected(get_option('codegen_pro_font_size_scale', 'normal'), 'small'); ?>><?php _e('Small', 'codegen-pro'); ?></option>
                                            <option value="normal" <?php selected(get_option('codegen_pro_font_size_scale', 'normal'), 'normal'); ?>><?php _e('Normal', 'codegen-pro'); ?></option>
                                            <option value="large" <?php selected(get_option('codegen_pro_font_size_scale'), 'large'); ?>><?php _e('Large', 'codegen-pro'); ?></option>
                                        </select>
                                        <p class="description"><?php _e('Adjust the overall font size scale.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Performance Settings -->
                    <div class="postbox">
                        <h2 class="hndle"><span><?php _e('Performance', 'codegen-pro'); ?></span></h2>
                        <div class="inside">
                            <table class="form-table">
                                <tr>
                                    <th scope="row"><?php _e('Minify CSS', 'codegen-pro'); ?></th>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="minify_css" value="1" <?php checked(get_option('codegen_pro_minify_css', 0)); ?> />
                                            <?php _e('Enable CSS minification', 'codegen-pro'); ?>
                                        </label>
                                        <p class="description"><?php _e('Reduces CSS file size for faster loading.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Lazy Load Images', 'codegen-pro'); ?></th>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="lazy_load_images" value="1" <?php checked(get_option('codegen_pro_lazy_load_images', 1)); ?> />
                                            <?php _e('Enable lazy loading for images', 'codegen-pro'); ?>
                                        </label>
                                        <p class="description"><?php _e('Images load only when they come into view.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Remove Unused CSS', 'codegen-pro'); ?></th>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="remove_unused_css" value="1" <?php checked(get_option('codegen_pro_remove_unused_css', 0)); ?> />
                                            <?php _e('Remove unused CSS from WordPress core', 'codegen-pro'); ?>
                                        </label>
                                        <p class="description"><?php _e('Removes emoji styles and other unused CSS.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div class="postbox">
                        <h2 class="hndle"><span><?php _e('SEO Settings', 'codegen-pro'); ?></span></h2>
                        <div class="inside">
                            <table class="form-table">
                                <tr>
                                    <th scope="row"><?php _e('Enable Schema Markup', 'codegen-pro'); ?></th>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="enable_schema" value="1" <?php checked(get_option('codegen_pro_enable_schema', 1)); ?> />
                                            <?php _e('Add structured data markup', 'codegen-pro'); ?>
                                        </label>
                                        <p class="description"><?php _e('Helps search engines understand your content better.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Open Graph Tags', 'codegen-pro'); ?></th>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="enable_og_tags" value="1" <?php checked(get_option('codegen_pro_enable_og_tags', 1)); ?> />
                                            <?php _e('Add Open Graph meta tags', 'codegen-pro'); ?>
                                        </label>
                                        <p class="description"><?php _e('Improves social media sharing appearance.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Twitter Cards', 'codegen-pro'); ?></th>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="enable_twitter_cards" value="1" <?php checked(get_option('codegen_pro_enable_twitter_cards', 1)); ?> />
                                            <?php _e('Add Twitter Card meta tags', 'codegen-pro'); ?>
                                        </label>
                                        <p class="description"><?php _e('Enhances Twitter sharing with rich cards.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Custom Code -->
                    <div class="postbox">
                        <h2 class="hndle"><span><?php _e('Custom Code', 'codegen-pro'); ?></span></h2>
                        <div class="inside">
                            <table class="form-table">
                                <tr>
                                    <th scope="row"><?php _e('Custom CSS', 'codegen-pro'); ?></th>
                                    <td>
                                        <textarea name="custom_css" rows="10" cols="50" class="large-text code"><?php echo esc_textarea(get_option('codegen_pro_custom_css')); ?></textarea>
                                        <p class="description"><?php _e('Add custom CSS code here. It will be added to the head section.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Custom JavaScript', 'codegen-pro'); ?></th>
                                    <td>
                                        <textarea name="custom_js" rows="10" cols="50" class="large-text code"><?php echo esc_textarea(get_option('codegen_pro_custom_js')); ?></textarea>
                                        <p class="description"><?php _e('Add custom JavaScript code here. It will be added before the closing body tag.', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Header Code', 'codegen-pro'); ?></th>
                                    <td>
                                        <textarea name="header_code" rows="5" cols="50" class="large-text code"><?php echo esc_textarea(get_option('codegen_pro_header_code')); ?></textarea>
                                        <p class="description"><?php _e('Add code to the head section (e.g., Google Analytics, meta tags).', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e('Footer Code', 'codegen-pro'); ?></th>
                                    <td>
                                        <textarea name="footer_code" rows="5" cols="50" class="large-text code"><?php echo esc_textarea(get_option('codegen_pro_footer_code')); ?></textarea>
                                        <p class="description"><?php _e('Add code before the closing body tag (e.g., tracking scripts).', 'codegen-pro'); ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="codegen-pro-options-sidebar">
                    <div class="postbox">
                        <h2 class="hndle"><span><?php _e('Theme Information', 'codegen-pro'); ?></span></h2>
                        <div class="inside">
                            <p><strong><?php _e('Theme Name:', 'codegen-pro'); ?></strong> Codegen Pro</p>
                            <p><strong><?php _e('Version:', 'codegen-pro'); ?></strong> <?php echo CODEGEN_PRO_VERSION; ?></p>
                            <p><strong><?php _e('Author:', 'codegen-pro'); ?></strong> Codegen Team</p>
                            <hr>
                            <p><?php _e('A modern, professional WordPress theme inspired by codegen.com with full Elementor support and advanced customization options.', 'codegen-pro'); ?></p>
                        </div>
                    </div>

                    <div class="postbox">
                        <h2 class="hndle"><span><?php _e('Quick Actions', 'codegen-pro'); ?></span></h2>
                        <div class="inside">
                            <p><a href="<?php echo admin_url('customize.php'); ?>" class="button button-secondary"><?php _e('Customize Theme', 'codegen-pro'); ?></a></p>
                            <p><a href="<?php echo admin_url('nav-menus.php'); ?>" class="button button-secondary"><?php _e('Manage Menus', 'codegen-pro'); ?></a></p>
                            <p><a href="<?php echo admin_url('widgets.php'); ?>" class="button button-secondary"><?php _e('Manage Widgets', 'codegen-pro'); ?></a></p>
                            <?php if (class_exists('Elementor\Plugin')) : ?>
                                <p><a href="<?php echo admin_url('edit.php?post_type=elementor_library'); ?>" class="button button-secondary"><?php _e('Elementor Templates', 'codegen-pro'); ?></a></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="postbox">
                        <h2 class="hndle"><span><?php _e('Import/Export', 'codegen-pro'); ?></span></h2>
                        <div class="inside">
                            <p><button type="button" class="button button-secondary" id="export-settings"><?php _e('Export Settings', 'codegen-pro'); ?></button></p>
                            <p>
                                <input type="file" id="import-settings" accept=".json" style="display: none;" />
                                <button type="button" class="button button-secondary" onclick="document.getElementById('import-settings').click();"><?php _e('Import Settings', 'codegen-pro'); ?></button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="submit">
                <input type="submit" name="submit" class="button-primary" value="<?php _e('Save Changes', 'codegen-pro'); ?>" />
                <input type="button" name="reset" class="button-secondary" id="reset-settings" value="<?php _e('Reset to Defaults', 'codegen-pro'); ?>" />
            </p>
        </form>
    </div>

    <style>
        .codegen-pro-options-wrapper {
            display: flex;
            gap: 20px;
        }
        .codegen-pro-options-main {
            flex: 1;
        }
        .codegen-pro-options-sidebar {
            width: 300px;
        }
        .slider {
            width: 200px;
        }
        .slider-value {
            margin-left: 10px;
            font-weight: bold;
        }
        .postbox h2 {
            padding: 10px 15px;
            margin: 0;
            background: #f1f1f1;
            border-bottom: 1px solid #ddd;
        }
        .postbox .inside {
            padding: 15px;
        }
        @media (max-width: 782px) {
            .codegen-pro-options-wrapper {
                flex-direction: column;
            }
            .codegen-pro-options-sidebar {
                width: 100%;
            }
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            // Media uploader for hero background
            $('#hero_bg_image_button').click(function(e) {
                e.preventDefault();
                var image = wp.media({
                    title: '<?php _e('Select Hero Background Image', 'codegen-pro'); ?>',
                    multiple: false
                }).open().on('select', function() {
                    var uploaded_image = image.state().get('selection').first();
                    var image_url = uploaded_image.toJSON().url;
                    $('#hero_bg_image').val(image_url);
                });
            });

            // Slider value update
            $('input[type="range"]').on('input', function() {
                $(this).next('.slider-value').text($(this).val() + '%');
            });

            // Reset settings
            $('#reset-settings').click(function() {
                if (confirm('<?php _e('Are you sure you want to reset all settings to defaults?', 'codegen-pro'); ?>')) {
                    // Reset form to defaults
                    location.reload();
                }
            });

            // Export settings
            $('#export-settings').click(function() {
                var settings = {};
                $('form input, form select, form textarea').each(function() {
                    if ($(this).attr('name')) {
                        if ($(this).attr('type') === 'checkbox') {
                            settings[$(this).attr('name')] = $(this).is(':checked');
                        } else {
                            settings[$(this).attr('name')] = $(this).val();
                        }
                    }
                });
                
                var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(settings));
                var downloadAnchorNode = document.createElement('a');
                downloadAnchorNode.setAttribute("href", dataStr);
                downloadAnchorNode.setAttribute("download", "codegen-pro-settings.json");
                document.body.appendChild(downloadAnchorNode);
                downloadAnchorNode.click();
                downloadAnchorNode.remove();
            });

            // Import settings
            $('#import-settings').change(function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        try {
                            var settings = JSON.parse(e.target.result);
                            for (var key in settings) {
                                var element = $('[name="' + key + '"]');
                                if (element.attr('type') === 'checkbox') {
                                    element.prop('checked', settings[key]);
                                } else {
                                    element.val(settings[key]);
                                }
                            }
                            alert('<?php _e('Settings imported successfully!', 'codegen-pro'); ?>');
                        } catch (error) {
                            alert('<?php _e('Error importing settings. Please check the file format.', 'codegen-pro'); ?>');
                        }
                    };
                    reader.readAsText(file);
                }
            });
        });
    </script>
    <?php
}

/**
 * Save theme options
 */
function codegen_pro_save_theme_options() {
    if (!wp_verify_nonce($_POST['codegen_pro_nonce'], 'codegen_pro_theme_options')) {
        return;
    }

    $options = array(
        'site_logo_text',
        'enable_preloader',
        'back_to_top',
        'smooth_scrolling',
        'hero_bg_image',
        'hero_overlay_opacity',
        'hero_animation',
        'primary_font',
        'font_size_scale',
        'minify_css',
        'lazy_load_images',
        'remove_unused_css',
        'enable_schema',
        'enable_og_tags',
        'enable_twitter_cards',
        'custom_css',
        'custom_js',
        'header_code',
        'footer_code'
    );

    foreach ($options as $option) {
        $value = isset($_POST[$option]) ? $_POST[$option] : '';
        
        if (in_array($option, array('custom_css', 'custom_js', 'header_code', 'footer_code'))) {
            $value = wp_unslash($value);
        } else {
            $value = sanitize_text_field($value);
        }
        
        update_option('codegen_pro_' . $option, $value);
    }
}

/**
 * Add custom CSS from theme options
 */
function codegen_pro_custom_css_output() {
    $custom_css = get_option('codegen_pro_custom_css');
    if (!empty($custom_css)) {
        echo '<style type="text/css" id="codegen-pro-custom-css">' . $custom_css . '</style>';
    }
}
add_action('wp_head', 'codegen_pro_custom_css_output');

/**
 * Add custom JavaScript from theme options
 */
function codegen_pro_custom_js_output() {
    $custom_js = get_option('codegen_pro_custom_js');
    if (!empty($custom_js)) {
        echo '<script type="text/javascript" id="codegen-pro-custom-js">' . $custom_js . '</script>';
    }
}
add_action('wp_footer', 'codegen_pro_custom_js_output');

/**
 * Add header code from theme options
 */
function codegen_pro_header_code_output() {
    $header_code = get_option('codegen_pro_header_code');
    if (!empty($header_code)) {
        echo $header_code;
    }
}
add_action('wp_head', 'codegen_pro_header_code_output');

/**
 * Add footer code from theme options
 */
function codegen_pro_footer_code_output() {
    $footer_code = get_option('codegen_pro_footer_code');
    if (!empty($footer_code)) {
        echo $footer_code;
    }
}
add_action('wp_footer', 'codegen_pro_footer_code_output');
