<?php
/**
 * Theme setup functions
 *
 * @package Codegen_Pro
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add theme support for various WordPress features
 */
function codegen_pro_theme_support() {
    // Add theme support for post formats
    add_theme_support('post-formats', array(
        'aside',
        'gallery',
        'link',
        'image',
        'quote',
        'status',
        'video',
        'audio',
        'chat'
    ));

    // Add theme support for custom header
    add_theme_support('custom-header', array(
        'default-image'      => '',
        'default-text-color' => 'ffffff',
        'width'              => 1920,
        'height'             => 1080,
        'flex-width'         => true,
        'flex-height'        => true,
        'uploads'            => true,
        'header-text'        => true,
    ));

    // Add theme support for starter content
    add_theme_support('starter-content', array(
        'widgets' => array(
            'footer-1' => array(
                'text' => array(
                    'title' => 'About Codegen Pro',
                    'text'  => 'A modern, professional WordPress theme inspired by codegen.com with full Elementor support and advanced customization options.',
                ),
            ),
            'footer-2' => array(
                'recent-posts' => array(
                    'title' => 'Recent Posts',
                ),
            ),
            'footer-3' => array(
                'categories' => array(
                    'title' => 'Categories',
                ),
            ),
        ),
        'posts' => array(
            'home',
            'about',
            'contact',
            'blog',
        ),
        'nav_menus' => array(
            'primary' => array(
                'name' => 'Primary Menu',
                'items' => array(
                    'link_home',
                    'page_about',
                    'page_blog',
                    'page_contact',
                ),
            ),
        ),
        'options' => array(
            'show_on_front'  => 'page',
            'page_on_front'  => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ),
        'theme_mods' => array(
            'hero_title' => 'The OS for Code Agents',
            'hero_subtitle' => 'Deploy code agents that plan, build, and review with full context, robust integrations, and production-ready results.',
            'hero_primary_btn_text' => 'Get Started',
            'hero_primary_btn_url' => '#',
            'hero_secondary_btn_text' => 'Schedule Demo',
            'hero_secondary_btn_url' => '#',
        ),
    ));
}
add_action('after_setup_theme', 'codegen_pro_theme_support');

/**
 * Add image sizes
 */
function codegen_pro_image_sizes() {
    add_image_size('codegen-pro-featured', 800, 450, true);
    add_image_size('codegen-pro-thumbnail', 400, 300, true);
    add_image_size('codegen-pro-large', 1200, 800, true);
    add_image_size('codegen-pro-hero', 1920, 1080, true);
}
add_action('after_setup_theme', 'codegen_pro_image_sizes');

/**
 * Register custom image sizes in media library
 */
function codegen_pro_custom_image_sizes($sizes) {
    return array_merge($sizes, array(
        'codegen-pro-featured' => __('Featured Image', 'codegen-pro'),
        'codegen-pro-thumbnail' => __('Thumbnail', 'codegen-pro'),
        'codegen-pro-large' => __('Large', 'codegen-pro'),
        'codegen-pro-hero' => __('Hero Image', 'codegen-pro'),
    ));
}
add_filter('image_size_names_choose', 'codegen_pro_custom_image_sizes');

/**
 * Setup default theme options
 */
function codegen_pro_default_options() {
    $defaults = array(
        'primary_color' => '#00d4ff',
        'secondary_color' => '#1a1a1a',
        'hero_title' => 'The OS for Code Agents',
        'hero_subtitle' => 'Deploy code agents that plan, build, and review with full context, robust integrations, and production-ready results. Backed by enterprise-grade support. Ship faster with Codegen.',
        'hero_primary_btn_text' => 'Get Started',
        'hero_primary_btn_url' => '#',
        'hero_secondary_btn_text' => 'Schedule Demo',
        'hero_secondary_btn_url' => '#',
        'header_btn_1_text' => 'Login',
        'header_btn_1_url' => '#',
        'header_btn_2_text' => 'Get Started',
        'header_btn_2_url' => '#',
        'enable_preloader' => true,
        'show_back_to_top' => true,
        'show_social_links' => true,
        'show_powered_by' => false,
        'copyright_text' => '',
        'facebook_url' => '',
        'twitter_url' => '',
        'linkedin_url' => '',
        'instagram_url' => '',
        'youtube_url' => '',
        'github_url' => '',
    );

    foreach ($defaults as $key => $value) {
        if (get_theme_mod($key) === false) {
            set_theme_mod($key, $value);
        }
    }
}
add_action('after_setup_theme', 'codegen_pro_default_options');

/**
 * Add editor styles
 */
function codegen_pro_editor_styles() {
    add_editor_style(array(
        'assets/css/editor-style.css',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap'
    ));
}
add_action('admin_init', 'codegen_pro_editor_styles');

/**
 * Custom excerpt function
 */
function codegen_pro_custom_excerpt($limit = 30) {
    $excerpt = get_the_excerpt();
    $excerpt = wp_strip_all_tags($excerpt);
    $excerpt = wp_trim_words($excerpt, $limit, '...');
    return $excerpt;
}

/**
 * Get reading time
 */
function codegen_pro_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    
    if ($reading_time == 1) {
        return '1 ' . __('minute read', 'codegen-pro');
    } else {
        return $reading_time . ' ' . __('minutes read', 'codegen-pro');
    }
}

/**
 * Custom post navigation
 */
function codegen_pro_post_navigation() {
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    
    if ($prev_post || $next_post) {
        echo '<nav class="post-navigation">';
        echo '<div class="nav-links">';
        
        if ($prev_post) {
            echo '<div class="nav-previous">';
            echo '<a href="' . get_permalink($prev_post) . '" rel="prev">';
            echo '<span class="nav-subtitle">' . __('Previous Post', 'codegen-pro') . '</span>';
            echo '<span class="nav-title">' . get_the_title($prev_post) . '</span>';
            echo '</a>';
            echo '</div>';
        }
        
        if ($next_post) {
            echo '<div class="nav-next">';
            echo '<a href="' . get_permalink($next_post) . '" rel="next">';
            echo '<span class="nav-subtitle">' . __('Next Post', 'codegen-pro') . '</span>';
            echo '<span class="nav-title">' . get_the_title($next_post) . '</span>';
            echo '</a>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</nav>';
    }
}

/**
 * Custom breadcrumbs
 */
function codegen_pro_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    
    echo '<nav class="breadcrumbs">';
    echo '<div class="container">';
    echo '<ol class="breadcrumb-list">';
    
    // Home link
    echo '<li><a href="' . home_url('/') . '">' . __('Home', 'codegen-pro') . '</a></li>';
    
    if (is_category() || is_single()) {
        if (is_single()) {
            $category = get_the_category();
            if ($category) {
                echo '<li><a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->name . '</a></li>';
            }
            echo '<li class="current">' . get_the_title() . '</li>';
        } else {
            echo '<li class="current">' . single_cat_title('', false) . '</li>';
        }
    } elseif (is_page()) {
        if (wp_get_post_parent_id(get_the_ID())) {
            $parent_id = wp_get_post_parent_id(get_the_ID());
            $breadcrumbs = array();
            
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb;
            }
        }
        echo '<li class="current">' . get_the_title() . '</li>';
    } elseif (is_search()) {
        echo '<li class="current">' . __('Search Results', 'codegen-pro') . '</li>';
    } elseif (is_404()) {
        echo '<li class="current">' . __('404 Error', 'codegen-pro') . '</li>';
    }
    
    echo '</ol>';
    echo '</div>';
    echo '</nav>';
}

/**
 * Custom comment callback
 */
function codegen_pro_comment_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    
    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
    
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <?php endif; ?>
    
    <div class="comment-author vcard">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
        <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()); ?>
    </div>
    
    <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'codegen-pro'); ?></em>
        <br />
    <?php endif; ?>
    
    <div class="comment-meta commentmetadata">
        <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
            <?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()); ?>
        </a>
        <?php edit_comment_link(__('(Edit)', 'codegen-pro'), '  ', ''); ?>
    </div>
    
    <div class="comment-content">
        <?php comment_text(); ?>
    </div>
    
    <div class="reply">
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
    </div>
    
    <?php if ('div' != $args['style']) : ?>
        </div>
    <?php endif; ?>
    <?php
}

/**
 * Add schema markup
 */
function codegen_pro_schema_markup() {
    $schema = '';
    
    if (is_single()) {
        $schema = 'itemscope itemtype="http://schema.org/Article"';
    } elseif (is_page()) {
        $schema = 'itemscope itemtype="http://schema.org/WebPage"';
    } elseif (is_home() || is_archive()) {
        $schema = 'itemscope itemtype="http://schema.org/Blog"';
    }
    
    return $schema;
}

/**
 * Add Open Graph meta tags
 */
function codegen_pro_open_graph() {
    if (is_single() || is_page()) {
        global $post;
        
        echo '<meta property="og:title" content="' . get_the_title() . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:url" content="' . get_permalink() . '" />' . "\n";
        echo '<meta property="og:description" content="' . get_the_excerpt() . '" />' . "\n";
        
        if (has_post_thumbnail()) {
            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . $thumbnail[0] . '" />' . "\n";
        }
        
        echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '" />' . "\n";
    }
}
add_action('wp_head', 'codegen_pro_open_graph');

/**
 * Add Twitter Card meta tags
 */
function codegen_pro_twitter_card() {
    if (is_single() || is_page()) {
        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        echo '<meta name="twitter:title" content="' . get_the_title() . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . get_the_excerpt() . '" />' . "\n";
        
        if (has_post_thumbnail()) {
            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta name="twitter:image" content="' . $thumbnail[0] . '" />' . "\n";
        }
    }
}
add_action('wp_head', 'codegen_pro_twitter_card');
