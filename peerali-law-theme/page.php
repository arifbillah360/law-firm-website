<?php
/**
 * Template Name: Full Width Blank Canvas
 * Description: Completely blank template for manual HTML - NO width restrictions, NO containers, NO wrappers
 *
 * @package Peerali_Law
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Output pure content with NO wrappers, NO containers, NO divs
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
