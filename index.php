<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Codegen_Pro
 */

get_header(); ?>

<main id="primary" class="site-main">
    
    <?php if (is_home() || is_front_page()) : ?>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-content fade-in-up">
                    <h1 class="hero-title">
                        <?php echo get_theme_mod('hero_title', 'The OS for Code Agents'); ?>
                    </h1>
                    <p class="hero-subtitle">
                        <?php echo get_theme_mod('hero_subtitle', 'Deploy code agents that plan, build, and review with full context, robust integrations, and production-ready results. Backed by enterprise-grade support. Ship faster with Codegen.'); ?>
                    </p>
                    <div class="hero-cta">
                        <a href="<?php echo get_theme_mod('hero_primary_btn_url', '#'); ?>" class="btn btn-primary">
                            <?php echo get_theme_mod('hero_primary_btn_text', 'Get Started'); ?>
                        </a>
                        <a href="<?php echo get_theme_mod('hero_secondary_btn_url', '#'); ?>" class="btn btn-secondary">
                            <?php echo get_theme_mod('hero_secondary_btn_text', 'Schedule Demo'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="section">
            <div class="container">
                <div class="section-title">
                    <h2 class="text-gradient">Everything you need to run code agents at scale</h2>
                    <p>Fine-tune every aspect of your autonomous agents with powerful configuration options.</p>
                </div>
                
                <div class="features-grid">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">⚙️</div>
                        <h3>Repository rules</h3>
                        <p>Define and enforce coding conventions and guidelines directly in your repo. Agents read and apply these rules automatically.</p>
                    </div>
                    
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">🏗️</div>
                        <h3>Sandbox environments</h3>
                        <p>Fine tune every aspect of your autonomous agents with powerful configuration options.</p>
                    </div>
                    
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">🔐</div>
                        <h3>Granular agent permissions</h3>
                        <p>Control exactly what your agents can do with fine-grained permission toggles.</p>
                    </div>
                    
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">📸</div>
                        <h3>Snapshots & image cache</h3>
                        <p>Store, reference, and reuse build snapshots and cached images for faster iterations.</p>
                    </div>
                    
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">🔗</div>
                        <h3>Deep integration panel</h3>
                        <p>Manage GitHub, ticketing tools, and MCP Servers from a single, unified dashboard.</p>
                    </div>
                    
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon">🚀</div>
                        <h3>State-of-the-art models</h3>
                        <p>We run the best code agents with smart routing and fine-grained control.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="section testimonials-section">
            <div class="container">
                <div class="section-title">
                    <h2 class="text-gradient">What our users say</h2>
                    <p>Hear from developers who have transformed their workflow with Codegen</p>
                </div>
                
                <div class="testimonials-grid">
                    <div class="testimonial-card fade-in-up">
                        <p class="testimonial-text">
                            "We tried everything on the market and Codegen was by far the best for a massive codebase like we have at Notion. The team's responsiveness and shipping speed is next level!"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar"></div>
                            <div class="author-info">
                                <strong>Hao Pan</strong>
                                <p>Engineering at Notion</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial-card fade-in-up">
                        <p class="testimonial-text">
                            "You can literally just go into your backlog, Command-A, select everything and assign to Codegen and it'll do all of it for you."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar"></div>
                            <div class="author-info">
                                <strong>Nan Yu</strong>
                                <p>Head of Product at Linear</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial-card fade-in-up">
                        <p class="testimonial-text">
                            "It's the best internal resource of our own product knowledge we have ever seen. Any technical or non-technical individual can get all their answers about how our product works and functions independently via Codegen."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar"></div>
                            <div class="author-info">
                                <strong>Gustavo Silva</strong>
                                <p>CTO at Origin Financial</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="section">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-item text-center fade-in-up">
                        <h3 class="text-gradient">230k+</h3>
                        <p>Pull requests created by Codegen</p>
                    </div>
                    <div class="stat-item text-center fade-in-up">
                        <h3 class="text-gradient">52%</h3>
                        <p>Pull request merge rate</p>
                    </div>
                    <div class="stat-item text-center fade-in-up">
                        <h3 class="text-gradient">$18.1M</h3>
                        <p>Developer time saved for customers</p>
                    </div>
                </div>
            </div>
        </section>

    <?php else : ?>
        <!-- Regular Blog/Page Content -->
        <?php if (have_posts()) : ?>
            <div class="container">
                <div class="content-area">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php
                                if (is_singular()) :
                                    the_title('<h1 class="entry-title">', '</h1>');
                                else :
                                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                                endif;
                                ?>
                            </header>

                            <div class="entry-content">
                                <?php
                                if (is_singular()) :
                                    the_content();
                                else :
                                    the_excerpt();
                                endif;
                                ?>
                            </div>

                            <?php if (!is_singular()) : ?>
                                <footer class="entry-footer">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-primary">
                                        Read More
                                    </a>
                                </footer>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>

                    <?php
                    // Pagination
                    the_posts_navigation();
                    ?>
                </div>
            </div>
        <?php else : ?>
            <div class="container">
                <div class="no-content">
                    <h2>Nothing Found</h2>
                    <p>It looks like nothing was found at this location. Maybe try a search?</p>
                    <?php get_search_form(); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
