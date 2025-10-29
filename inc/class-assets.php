<?php
/**
 * Assets Manager Class
 *
 * @package Codegen_Pro
 */

namespace Codegen_Pro;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Assets Manager Class
 */
class Assets {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }
    
    /**
     * Enqueue frontend assets
     */
    public function enqueue_frontend_assets() {
        // Check if assets exist before enqueueing
        $css_file = CODEGEN_PRO_THEME_DIR . '/assets/css/codegen-style.css';
        $js_file = CODEGEN_PRO_THEME_DIR . '/assets/js/codegen-scripts.js';
        
        if (file_exists($css_file)) {
            wp_enqueue_style(
                'codegen-pro-main-style',
                CODEGEN_PRO_THEME_URL . '/assets/css/codegen-style.css',
                array(),
                filemtime($css_file)
            );
        }
        
        if (file_exists($js_file)) {
            wp_enqueue_script(
                'codegen-pro-main-script',
                CODEGEN_PRO_THEME_URL . '/assets/js/codegen-scripts.js',
                array('jquery'),
                filemtime($js_file),
                true
            );
        }
    }
    
    /**
     * Enqueue admin assets
     */
    public function enqueue_admin_assets($hook) {
        // Only load on specific admin pages
        if (in_array($hook, array('post.php', 'post-new.php', 'edit.php'))) {
            $admin_css = CODEGEN_PRO_THEME_DIR . '/assets/css/admin.css';
            $admin_js = CODEGEN_PRO_THEME_DIR . '/assets/js/admin.js';
            
            if (file_exists($admin_css)) {
                wp_enqueue_style(
                    'codegen-pro-admin-style',
                    CODEGEN_PRO_THEME_URL . '/assets/css/admin.css',
                    array(),
                    filemtime($admin_css)
                );
            }
            
            if (file_exists($admin_js)) {
                wp_enqueue_script(
                    'codegen-pro-admin-script',
                    CODEGEN_PRO_THEME_URL . '/assets/js/admin.js',
                    array('jquery'),
                    filemtime($admin_js),
                    true
                );
            }
        }
    }
}
