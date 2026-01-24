<?php
/**
 * Footer Template
 *
 * @package Peerali_Law
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Site Footer -->
<footer class="site-footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">

                <!-- About Column -->
                <div class="footer-column">
                    <h3 class="footer-title"><?php echo esc_html(get_bloginfo('name')); ?></h3>
                    <p><?php
                        $footer_description = get_bloginfo('description');
                        if (empty($footer_description)) {
                            esc_html_e('Boutique law firm in Los Angeles specializing in complex and catastrophic injuries. Our attorneys work directly with clients, and have recovered over $50 million in compensation.', 'peerali-law');
                        } else {
                            echo esc_html($footer_description);
                        }
                    ?></p>
                    <div class="social-links">
                        <?php
                        $social_links = array(
                            'facebook'  => array('icon' => 'fab fa-facebook', 'label' => 'Facebook'),
                            'linkedin'  => array('icon' => 'fab fa-linkedin', 'label' => 'LinkedIn'),
                            'twitter'   => array('icon' => 'fab fa-twitter', 'label' => 'Twitter'),
                            'instagram' => array('icon' => 'fab fa-instagram', 'label' => 'Instagram'),
                        );

                        foreach ($social_links as $network => $data) {
                            $url = get_theme_mod('peerali_' . $network);
                            if (!empty($url)) {
                                printf(
                                    '<a href="%s" aria-label="%s" class="social-link" target="_blank" rel="noopener noreferrer"><i class="%s"></i></a>',
                                    esc_url($url),
                                    esc_attr($data['label']),
                                    esc_attr($data['icon'])
                                );
                            }
                        }

                        // If no social links are set, show placeholder links
                        if (empty(get_theme_mod('peerali_facebook')) && empty(get_theme_mod('peerali_linkedin')) && empty(get_theme_mod('peerali_twitter')) && empty(get_theme_mod('peerali_instagram'))) {
                            ?>
                            <a href="#" aria-label="Facebook" class="social-link"><i class="fab fa-facebook"></i></a>
                            <a href="#" aria-label="LinkedIn" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="#" aria-label="Twitter" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="Instagram" class="social-link"><i class="fab fa-instagram"></i></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-column">
                    <h3 class="footer-title"><?php esc_html_e('Quick Links', 'peerali-law'); ?></h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-links',
                        'container'      => '',
                        'fallback_cb'    => 'peerali_law_footer_fallback_menu',
                        'depth'          => 1,
                    ));
                    ?>
                </div>

                <!-- Practice Areas -->
                <div class="footer-column">
                    <h3 class="footer-title"><?php esc_html_e('Practice Areas', 'peerali-law'); ?></h3>
                    <ul class="footer-links">
                        <?php
                        // Get practice area pages
                        $practice_areas = new WP_Query(array(
                            'post_type'      => 'practice_area',
                            'posts_per_page' => 5,
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC',
                        ));

                        if ($practice_areas->have_posts()) {
                            while ($practice_areas->have_posts()) {
                                $practice_areas->the_post();
                                printf(
                                    '<li><a href="%s">%s</a></li>',
                                    esc_url(get_permalink()),
                                    esc_html(get_the_title())
                                );
                            }
                            wp_reset_postdata();
                        } else {
                            // Fallback practice areas
                            $fallback_areas = array(
                                'catastrophic-injury' => 'Catastrophic Injury',
                                'brain-injury'        => 'Brain Injury',
                                'car-accident'        => 'Car Accident',
                                'truck-accident'      => 'Truck Accident',
                                'wrongful-death'      => 'Wrongful Death',
                            );

                            foreach ($fallback_areas as $slug => $title) {
                                printf(
                                    '<li><a href="%s">%s</a></li>',
                                    esc_url(home_url('/' . $slug)),
                                    esc_html($title)
                                );
                            }
                        }
                        ?>
                        <li><a href="<?php echo esc_url(home_url('/practice-areas')); ?>"><?php esc_html_e('View All', 'peerali-law'); ?></a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer-column">
                    <h3 class="footer-title"><?php esc_html_e('Contact Us', 'peerali-law'); ?></h3>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-phone"></i>
                            <a href="tel:<?php echo esc_attr(str_replace(array('(', ')', ' ', '-'), '', get_theme_mod('peerali_phone', '(818) 688-4050'))); ?>">
                                <?php echo esc_html(get_theme_mod('peerali_phone', '(818) 688-4050')); ?>
                            </a>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?php echo esc_attr(get_theme_mod('peerali_email', 'info@peeralilaw.com')); ?>">
                                <?php echo esc_html(get_theme_mod('peerali_email', 'info@peeralilaw.com')); ?>
                            </a>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo wp_kses_post(nl2br(get_theme_mod('peerali_address', '3575 Cahuenga Blvd Suite 480<br>Los Angeles, CA 90068'))); ?></span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span><?php esc_html_e('24/7 Emergency Service', 'peerali-law'); ?></span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p>
                    <?php
                    /* translators: 1: Current year, 2: Site name */
                    printf(
                        esc_html__('&copy; %1$s %2$s. All rights reserved.', 'peerali-law'),
                        date('Y'),
                        esc_html(get_bloginfo('name'))
                    );
                    ?>
                </p>
                <div class="footer-bottom-links">
                    <?php
                    $bottom_links = array(
                        'privacy-policy'   => __('Privacy Policy', 'peerali-law'),
                        'terms-of-service' => __('Terms of Service', 'peerali-law'),
                        'sitemap'          => __('Sitemap', 'peerali-law'),
                    );

                    foreach ($bottom_links as $slug => $title) {
                        printf(
                            '<a href="%s">%s</a>',
                            esc_url(home_url('/' . $slug)),
                            esc_html($title)
                        );
                    }
                    ?>
                </div>
            </div>
            <p class="disclaimer">
                <?php esc_html_e('The information on this website is for general information purposes only. Nothing on this site should be taken as legal advice for any individual case or situation. This information is not intended to create, and receipt or viewing does not constitute, an attorney-client relationship.', 'peerali-law'); ?>
            </p>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top" aria-label="<?php esc_attr_e('Back to Top', 'peerali-law'); ?>">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * Fallback footer menu
 */
function peerali_law_footer_fallback_menu() {
    $footer_pages = array(
        'about-us'      => __('About Us', 'peerali-law'),
        'our-attorneys' => __('Our Attorneys', 'peerali-law'),
        'case-results'  => __('Case Results', 'peerali-law'),
        'testimonials'  => __('Testimonials', 'peerali-law'),
        'legal-fees'    => __('Legal Fees', 'peerali-law'),
        'contact'       => __('Contact', 'peerali-law'),
    );

    echo '<ul class="footer-links">';
    foreach ($footer_pages as $slug => $title) {
        printf(
            '<li><a href="%s">%s</a></li>',
            esc_url(home_url('/' . $slug)),
            esc_html($title)
        );
    }
    echo '</ul>';
}
?>
