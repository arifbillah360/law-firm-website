<?php
/**
 * Single Post Template
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

<main id="main-content" class="site-main single-post">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                    <div class="entry-meta">
                        <span class="posted-on">
                            <i class="fas fa-calendar"></i>
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </span>

                        <span class="byline">
                            <i class="fas fa-user"></i>
                            <?php
                            printf(
                                '<a href="%s">%s</a>',
                                esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                                esc_html(get_the_author())
                            );
                            ?>
                        </span>

                        <?php if (has_category()) : ?>
                            <span class="cat-links">
                                <i class="fas fa-folder"></i>
                                <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>

                        <?php if (comments_open() || get_comments_number()) : ?>
                            <span class="comments-link">
                                <i class="fas fa-comments"></i>
                                <?php
                                comments_popup_link(
                                    esc_html__('Leave a Comment', 'peerali-law'),
                                    esc_html__('1 Comment', 'peerali-law'),
                                    esc_html__('% Comments', 'peerali-law')
                                );
                                ?>
                            </span>
                        <?php endif; ?>
                    </div>
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

                <?php if (has_tag()) : ?>
                    <footer class="entry-footer">
                        <div class="tags-links">
                            <i class="fas fa-tags"></i>
                            <?php the_tags('', ', ', ''); ?>
                        </div>
                    </footer>
                <?php endif; ?>
            </article>

            <?php
            // Author bio
            if (get_the_author_meta('description')) :
                ?>
                <div class="author-bio">
                    <div class="author-avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                    </div>
                    <div class="author-info">
                        <h3 class="author-name"><?php echo esc_html(get_the_author()); ?></h3>
                        <p class="author-description"><?php echo wp_kses_post(get_the_author_meta('description')); ?></p>
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author-link">
                            <?php esc_html_e('View all posts', 'peerali-law'); ?>
                        </a>
                    </div>
                </div>
                <?php
            endif;

            // Post navigation
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'peerali-law') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'peerali-law') . '</span> <span class="nav-title">%title</span>',
            ));

            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
