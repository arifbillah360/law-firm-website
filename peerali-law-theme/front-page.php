<?php
/**
 * Front Page Template
 *
 * This template is used when you set a static page as the front page
 * in Settings → Reading → "A static page" → Front page
 *
 * It displays ONLY the page content with NO WordPress default wrappers
 * Perfect for manual HTML content added via the WordPress editor
 *
 * @package Peerali_Law
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Output ONLY the page content - no wrappers, no containers
while (have_posts()) : the_post();

    // Check if custom HTML content exists in meta box
    $custom_html = get_post_meta(get_the_ID(), '_peerali_html_content', true);

    if (!empty($custom_html)) {
        // Display custom HTML content - COMPLETELY RAW, NO WRAPPERS
        echo wp_kses_post($custom_html);
    } else {
        // Display standard WordPress content - COMPLETELY RAW, NO WRAPPERS
        the_content();
    }

endwhile;

get_footer();
