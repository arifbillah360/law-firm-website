<?php
/**
 * Template Name: Blank (No Wrappers)
 *
 * Completely blank template with NO WordPress wrappers whatsoever
 * Perfect for full custom HTML pages
 *
 * To use this template:
 * 1. Create/Edit a page in WordPress
 * 2. In the right sidebar, find "Page Attributes" → "Template"
 * 3. Select "Blank (No Wrappers)"
 * 4. Add your HTML content in the WordPress editor (Text/HTML mode)
 * 5. Publish
 *
 * @package Peerali_Law
 * @since 1.0.2
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Output ONLY the page content - ABSOLUTELY NOTHING ELSE
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
