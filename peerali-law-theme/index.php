<?php
/**
 * Main Template File
 *
 * @package Peerali_Law
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php
                    // Check if custom HTML content exists
                    $custom_html = get_post_meta(get_the_ID(), '_peerali_html_content', true);

                    if (!empty($custom_html)) {
                        // Display custom HTML content
                        echo wp_kses_post($custom_html);
                    } else {
                        // Display standard content
                        ?>
                        <header class="entry-header">
                            <?php
                            if (is_singular()) :
                                the_title('<h1 class="entry-title">', '</h1>');
                            else :
                                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
                            endif;
                            ?>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="entry-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'peerali-law'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <?php if (get_post_type() === 'post') : ?>
                            <footer class="entry-footer">
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <i class="fas fa-calendar"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="byline">
                                        <i class="fas fa-user"></i>
                                        <?php the_author(); ?>
                                    </span>
                                    <?php if (has_category()) : ?>
                                        <span class="cat-links">
                                            <i class="fas fa-folder"></i>
                                            <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </footer>
                        <?php endif; ?>
                        <?php
                    }
                    ?>
                </article>
                <?php
            endwhile;

            // Pagination
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '<i class="fas fa-chevron-left"></i> ' . esc_html__('Previous', 'peerali-law'),
                'next_text' => esc_html__('Next', 'peerali-law') . ' <i class="fas fa-chevron-right"></i>',
            ));

        else :
            ?>
            <div class="no-results">
                <h1><?php esc_html_e('Nothing Found', 'peerali-law'); ?></h1>
                <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'peerali-law'); ?></p>
                <?php get_search_form(); ?>
            </div>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
