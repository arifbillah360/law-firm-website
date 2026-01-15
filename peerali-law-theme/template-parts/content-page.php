<?php
/**
 * Template part for displaying page content
 *
 * @package Peerali_Law
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    // Check if custom HTML content exists
    $custom_html = get_post_meta(get_the_ID(), '_peerali_html_content', true);

    if (!empty($custom_html)) {
        // Display custom HTML content
        echo wp_kses_post($custom_html);
    } else {
        // Display standard WordPress content
        ?>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header>

        <?php if (has_post_thumbnail()) : ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
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

        <?php if (get_edit_post_link()) : ?>
            <footer class="entry-footer">
                <?php
                edit_post_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Post title. */
                            __('Edit <span class="screen-reader-text">%s</span>', 'peerali-law'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        esc_html(get_the_title())
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
                ?>
            </footer>
        <?php endif; ?>
        <?php
    }
    ?>
</article>
