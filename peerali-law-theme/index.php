<?php
/**
 * Main Template File
 * Outputs full-width content when custom HTML exists, or standard blog layout when not
 *
 * @package Peerali_Law
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();

        // Check if custom HTML content exists
        $custom_html = get_post_meta(get_the_ID(), '_peerali_html_content', true);

        if (!empty($custom_html)) {
            // Display custom HTML content - FULL WIDTH, NO WRAPPERS
            echo wp_kses_post($custom_html);
        } else {
            // Display standard WordPress content - FULL WIDTH, NO WRAPPERS
            the_content();
        }

    endwhile;
else :
    // No posts found
    ?>
    <main id="main-content" class="site-main">
        <div class="container">
            <div class="no-results">
                <h1><?php esc_html_e('Nothing Found', 'peerali-law'); ?></h1>
                <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'peerali-law'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>
    </main>
    <?php
endif;

get_footer();
