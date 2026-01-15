<?php
/**
 * Page Template (Blank Canvas)
 *
 * This template displays pages with custom HTML content.
 * The content is added via the WordPress editor or custom HTML meta box.
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

<div class="page-content-wrapper">
    <?php
    while (have_posts()) :
        the_post();

        // Check if custom HTML content exists
        $custom_html = get_post_meta(get_the_ID(), '_peerali_html_content', true);

        if (!empty($custom_html)) {
            // Output custom HTML content without WordPress wrappers
            echo wp_kses_post($custom_html);
        } else {
            // Output standard WordPress content
            ?>
            <main id="main-content" class="site-main">
                <div class="container">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
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
                    </article>

                    <?php
                    // If comments are open or there are comments, load the comment template
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                </div>
            </main>
            <?php
        }
    endwhile;
    ?>
</div>

<?php
get_footer();
