<?php
/**
 * Template Name: Blank (No WordPress Styles)
 * Template Post Type: page
 * Description: Completely blank template for custom HTML
 *
 * To use this template:
 * 1. Create/Edit a page in WordPress
 * 2. In Page Attributes → Template, select "Blank (No WordPress Styles)"
 * 3. Switch to Text/HTML mode in editor
 * 4. Paste your custom HTML
 * 5. Publish
 *
 * @package Peerali_Law
 * @since 1.0.3
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; ?>

<?php get_footer();
