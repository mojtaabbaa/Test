<?php
namespace Elementor_Pro_Addons\Admin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Admin Class
 */
class Admin {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
        add_action('wp_ajax_toggle_widget', [$this, 'ajax_toggle_widget']);
    }

    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            __('Elementor Pro Addons', 'elementor-pro-addons'),
            __('Pro Addons', 'elementor-pro-addons'),
            'manage_options',
            'elementor-pro-addons',
            [$this, 'admin_page'],
            'dashicons-elementor',
            58.5
        );

        add_submenu_page(
            'elementor-pro-addons',
            __('مدیریت ویجت‌ها', 'elementor-pro-addons'),
            __('ویجت‌ها', 'elementor-pro-addons'),
            'manage_options',
            'elementor-pro-addons',
            [$this, 'admin_page']
        );

        add_submenu_page(
            'elementor-pro-addons',
            __('تنظیمات', 'elementor-pro-addons'),
            __('تنظیمات', 'elementor-pro-addons'),
            'manage_options',
            'elementor-pro-addons-settings',
            [$this, 'settings_page']
        );
    }

    /**
     * Register settings
     */
    public function register_settings() {
        register_setting('elementor_pro_addons_settings', 'elementor_pro_addons_widgets');
        register_setting('elementor_pro_addons_settings', 'elementor_pro_addons_load_fa');
        register_setting('elementor_pro_addons_settings', 'elementor_pro_addons_load_animate');
    }

    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts($hook) {
        if (strpos($hook, 'elementor-pro-addons') === false) {
            return;
        }

        wp_enqueue_style(
            'elementor-pro-addons-admin',
            ELEMENTOR_PRO_ADDONS_ASSETS . 'css/admin.css',
            [],
            ELEMENTOR_PRO_ADDONS_VERSION
        );

        wp_enqueue_script(
            'elementor-pro-addons-admin',
            ELEMENTOR_PRO_ADDONS_ASSETS . 'js/admin.js',
            ['jquery'],
            ELEMENTOR_PRO_ADDONS_VERSION,
            true
        );

        wp_localize_script('elementor-pro-addons-admin', 'epaAjax', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('epa_nonce'),
            'strings' => [
                'saved' => __('تنظیمات ذخیره شد!', 'elementor-pro-addons'),
                'error' => __('خطا در ذخیره تنظیمات!', 'elementor-pro-addons')
            ]
        ]);
    }

    /**
     * Admin page
     */
    public function admin_page() {
        $widgets_manager = new \Elementor_Pro_Addons\Widgets_Manager();
        $widgets = $widgets_manager->get_widgets();
        $enabled_widgets = get_option('elementor_pro_addons_widgets', array_keys($widgets));
        ?>
        <div class="wrap epa-admin-wrap">
            <h1><?php _e('مدیریت ویجت‌های Elementor Pro Addons', 'elementor-pro-addons'); ?></h1>
            
            <div class="epa-admin-header">
                <div class="epa-admin-header-left">
                    <h2><?php _e('ویجت‌های موجود', 'elementor-pro-addons'); ?></h2>
                    <p><?php _e('می‌توانید ویجت‌های مورد نظر خود را فعال یا غیرفعال کنید.', 'elementor-pro-addons'); ?></p>
                </div>
                <div class="epa-admin-header-right">
                    <button type="button" class="button button-primary" id="epa-enable-all">
                        <?php _e('فعال کردن همه', 'elementor-pro-addons'); ?>
                    </button>
                    <button type="button" class="button" id="epa-disable-all">
                        <?php _e('غیرفعال کردن همه', 'elementor-pro-addons'); ?>
                    </button>
                </div>
            </div>

            <div class="epa-widgets-grid">
                <?php foreach ($widgets as $widget_key => $widget_data): ?>
                    <div class="epa-widget-card">
                        <div class="epa-widget-header">
                            <div class="epa-widget-icon">
                                <i class="<?php echo esc_attr($widget_data['icon']); ?>"></i>
                            </div>
                            <div class="epa-widget-info">
                                <h3><?php echo esc_html($widget_data['title']); ?></h3>
                                <p><?php echo esc_html(implode(', ', $widget_data['keywords'])); ?></p>
                            </div>
                        </div>
                        <div class="epa-widget-toggle">
                            <label class="epa-switch">
                                <input type="checkbox" 
                                       data-widget="<?php echo esc_attr($widget_key); ?>"
                                       <?php checked(in_array($widget_key, $enabled_widgets)); ?>>
                                <span class="epa-slider"></span>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="epa-admin-footer">
                <p><?php _e('پس از تغییر تنظیمات، صفحه را رفرش کنید تا تغییرات اعمال شود.', 'elementor-pro-addons'); ?></p>
            </div>
        </div>
        <?php
    }

    /**
     * Settings page
     */
    public function settings_page() {
        if (isset($_POST['submit'])) {
            update_option('elementor_pro_addons_load_fa', isset($_POST['load_fa']));
            update_option('elementor_pro_addons_load_animate', isset($_POST['load_animate']));
            echo '<div class="notice notice-success"><p>' . __('تنظیمات ذخیره شد!', 'elementor-pro-addons') . '</p></div>';
        }

        $load_fa = get_option('elementor_pro_addons_load_fa', true);
        $load_animate = get_option('elementor_pro_addons_load_animate', true);
        ?>
        <div class="wrap">
            <h1><?php _e('تنظیمات Elementor Pro Addons', 'elementor-pro-addons'); ?></h1>
            
            <form method="post" action="">
                <table class="form-table">
                    <tr>
                        <th scope="row"><?php _e('بارگذاری Font Awesome', 'elementor-pro-addons'); ?></th>
                        <td>
                            <label>
                                <input type="checkbox" name="load_fa" <?php checked($load_fa); ?>>
                                <?php _e('بارگذاری کتابخانه Font Awesome', 'elementor-pro-addons'); ?>
                            </label>
                            <p class="description">
                                <?php _e('در صورتی که قالب شما Font Awesome را بارگذاری می‌کند، این گزینه را غیرفعال کنید.', 'elementor-pro-addons'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('بارگذاری Animate.css', 'elementor-pro-addons'); ?></th>
                        <td>
                            <label>
                                <input type="checkbox" name="load_animate" <?php checked($load_animate); ?>>
                                <?php _e('بارگذاری کتابخانه Animate.css', 'elementor-pro-addons'); ?>
                            </label>
                            <p class="description">
                                <?php _e('برای انیمیشن‌های ویجت‌ها استفاده می‌شود.', 'elementor-pro-addons'); ?>
                            </p>
                        </td>
                    </tr>
                </table>
                
                <?php submit_button(__('ذخیره تنظیمات', 'elementor-pro-addons')); ?>
            </form>
        </div>
        <?php
    }

    /**
     * AJAX toggle widget
     */
    public function ajax_toggle_widget() {
        if (!wp_verify_nonce($_POST['nonce'], 'epa_nonce')) {
            wp_die('Security check failed');
        }

        $widget_key = sanitize_text_field($_POST['widget']);
        $enabled = $_POST['enabled'] === 'true';

        $enabled_widgets = get_option('elementor_pro_addons_widgets', []);

        if ($enabled) {
            if (!in_array($widget_key, $enabled_widgets)) {
                $enabled_widgets[] = $widget_key;
            }
        } else {
            $enabled_widgets = array_diff($enabled_widgets, [$widget_key]);
        }

        update_option('elementor_pro_addons_widgets', $enabled_widgets);

        wp_send_json_success([
            'message' => __('تنظیمات ذخیره شد!', 'elementor-pro-addons')
        ]);
    }
}

