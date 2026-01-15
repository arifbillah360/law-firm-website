<?php
/**
 * Default Page Template
 *
 * @package Peerali_Law
 * @since 1.0.0
 */

get_header(); ?>

<main id="main-content">
    <?php
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php get_footer();
