<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Codegen_Pro
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'codegen-pro'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) :
                        the_custom_logo();
                    else :
                        ?>
                        <h1 class="site-logo">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php 
                                $site_title = get_theme_mod('site_title', get_bloginfo('name'));
                                echo esc_html($site_title ? $site_title : 'Codegen');
                                ?>
                            </a>
                        </h1>
                        <?php
                    endif;
                    ?>
                </div>

                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => 'codegen_pro_fallback_menu',
                    ));
                    ?>
                </nav>

                <div class="header-cta">
                    <?php if (get_theme_mod('header_btn_1_text')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('header_btn_1_url', '#')); ?>" class="btn btn-secondary">
                            <?php echo esc_html(get_theme_mod('header_btn_1_text')); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('header_btn_2_text')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('header_btn_2_url', '#')); ?>" class="btn btn-primary">
                            <?php echo esc_html(get_theme_mod('header_btn_2_text')); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'codegen-pro'); ?></span>
                </button>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">

<?php
/**
 * Fallback menu for when no menu is assigned
 */
function codegen_pro_fallback_menu() {
    echo '<ul id="primary-menu" class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'codegen-pro') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about')) . '">' . esc_html__('About', 'codegen-pro') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/services')) . '">' . esc_html__('Services', 'codegen-pro') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">' . esc_html__('Contact', 'codegen-pro') . '</a></li>';
    echo '</ul>';
}
?>
