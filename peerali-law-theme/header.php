<?php
/**
 * Header Template
 *
 * @package Peerali_Law
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Top Bar (Contact Information) -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-content">
            <div class="top-bar-left">
                <a href="tel:<?php echo esc_attr(str_replace(array('(', ')', ' ', '-'), '', get_theme_mod('peerali_phone', '(818) 962-7071'))); ?>" class="top-bar-link">
                    <i class="fas fa-phone"></i>
                    <span><?php echo esc_html(get_theme_mod('peerali_phone', '(818) 962-7071')); ?></span>
                </a>
                <a href="mailto:<?php echo esc_attr(get_theme_mod('peerali_email', 'info@peeralilaw.com')); ?>" class="top-bar-link">
                    <i class="fas fa-envelope"></i>
                    <span><?php echo esc_html(get_theme_mod('peerali_email', 'info@peeralilaw.com')); ?></span>
                </a>
            </div>
            <div class="top-bar-right">
                <span class="top-bar-text">
                    <i class="fas fa-clock"></i>
                    <?php esc_html_e('24/7 Emergency Service', 'peerali-law'); ?>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Main Header Navigation -->
<header class="site-header" id="siteHeader">
    <div class="container">
        <div class="header-content">

            <!-- Logo -->
            <div class="site-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        <span class="logo-text-main"><?php echo esc_html(get_bloginfo('name')); ?></span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Desktop Navigation -->
            <nav class="main-navigation" id="mainNav" aria-label="<?php esc_attr_e('Main Navigation', 'peerali-law'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'peerali_law_fallback_menu',
                    'walker'         => new Peerali_Law_Walker_Nav_Menu(),
                ));
                ?>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">

                <!-- Language Switcher -->
                <?php if (function_exists('pll_the_languages')) : ?>
                    <div class="language-switcher">
                        <?php pll_the_languages(array('dropdown' => 0, 'show_flags' => 1, 'show_names' => 0)); ?>
                    </div>
                <?php endif; ?>

                <!-- Search Button -->
                <button class="search-toggle" aria-label="<?php esc_attr_e('Open Search', 'peerali-law'); ?>" id="searchToggle">
                    <i class="fas fa-search"></i>
                </button>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('Toggle Mobile Menu', 'peerali-law'); ?>" id="mobileMenuToggle">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>

            </div>

        </div>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

<!-- Mobile Navigation Menu -->
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        <div class="mobile-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <span class="logo-text-main"><?php echo esc_html(get_bloginfo('name')); ?></span>
            <?php endif; ?>
        </div>
        <button class="mobile-menu-close" aria-label="<?php esc_attr_e('Close Mobile Menu', 'peerali-law'); ?>" id="mobileMenuClose">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="mobile-navigation" aria-label="<?php esc_attr_e('Mobile Navigation', 'peerali-law'); ?>">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class'     => 'mobile-nav-menu',
            'container'      => false,
            'fallback_cb'    => 'peerali_law_mobile_fallback_menu',
            'walker'         => new Peerali_Law_Mobile_Walker_Nav_Menu(),
        ));
        ?>
    </nav>

    <!-- Mobile Menu Footer -->
    <div class="mobile-menu-footer">
        <a href="tel:<?php echo esc_attr(str_replace(array('(', ')', ' ', '-'), '', get_theme_mod('peerali_phone', '(818) 962-7071'))); ?>" class="mobile-cta-btn">
            <i class="fas fa-phone"></i>
            <?php
            /* translators: %s: phone number */
            printf(esc_html__('Call Now: %s', 'peerali-law'), esc_html(get_theme_mod('peerali_phone', '(818) 962-7071')));
            ?>
        </a>
        <?php if (function_exists('pll_the_languages')) : ?>
            <div class="mobile-language-switcher">
                <?php pll_the_languages(array('dropdown' => 0, 'show_flags' => 1)); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Search Overlay -->
<div class="search-overlay" id="searchOverlay">
    <div class="search-overlay-content">
        <button class="search-close" aria-label="<?php esc_attr_e('Close Search', 'peerali-law'); ?>" id="searchClose">
            <i class="fas fa-times"></i>
        </button>
        <div class="search-box">
            <h2 class="search-title"><?php esc_html_e('Search Our Site', 'peerali-law'); ?></h2>
            <form class="search-form" action="<?php echo esc_url(home_url('/')); ?>" method="GET" role="search">
                <div class="search-input-group">
                    <input
                        type="search"
                        name="s"
                        id="searchInput"
                        class="search-input"
                        placeholder="<?php esc_attr_e('What are you looking for?', 'peerali-law'); ?>"
                        aria-label="<?php esc_attr_e('Search', 'peerali-law'); ?>"
                        autocomplete="off"
                        value="<?php echo get_search_query(); ?>"
                    >
                    <button type="submit" class="search-submit" aria-label="<?php esc_attr_e('Submit Search', 'peerali-law'); ?>">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <div class="search-suggestions">
                <p class="search-suggestions-title"><?php esc_html_e('Popular Searches:', 'peerali-law'); ?></p>
                <div class="search-tags">
                    <a href="<?php echo esc_url(home_url('/car-accident')); ?>" class="search-tag"><?php esc_html_e('Car Accident', 'peerali-law'); ?></a>
                    <a href="<?php echo esc_url(home_url('/brain-injury')); ?>" class="search-tag"><?php esc_html_e('Brain Injury', 'peerali-law'); ?></a>
                    <a href="<?php echo esc_url(home_url('/wrongful-death')); ?>" class="search-tag"><?php esc_html_e('Wrongful Death', 'peerali-law'); ?></a>
                    <a href="<?php echo esc_url(home_url('/legal-fees')); ?>" class="search-tag"><?php esc_html_e('Legal Fees', 'peerali-law'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/**
 * Custom Nav Walker for Desktop Menu
 */
class Peerali_Law_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0) {
            $output .= '<ul class="dropdown-menu">';
        } else {
            $output .= '<ul class="sub-menu">';
        }
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));

        if ($args->walker->has_children) {
            $class_names .= ' has-dropdown';
        }

        $output .= '<li class="nav-item ' . esc_attr($class_names) . '">';

        $attributes = '';
        $attributes .= !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
        $attributes .= ' class="' . ($depth > 0 ? 'dropdown-link' : 'nav-link') . '"';

        if ($args->walker->has_children) {
            $attributes .= ' aria-haspopup="true" aria-expanded="false"';
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;

        if ($args->walker->has_children && $depth === 0) {
            $item_output .= ' <i class="fas fa-chevron-down dropdown-icon"></i>';
        }

        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Custom Nav Walker for Mobile Menu
 */
class Peerali_Law_Mobile_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="mobile-dropdown-menu">';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));

        if ($args->walker->has_children) {
            $class_names .= ' has-dropdown';
        }

        $output .= '<li class="mobile-nav-item ' . esc_attr($class_names) . '">';

        $attributes = '';

        if ($args->walker->has_children) {
            $attributes .= ' href="#" class="mobile-nav-link mobile-dropdown-toggle"';
            $attributes .= ' data-dropdown="dropdown-' . $item->ID . '"';
        } else {
            $attributes .= !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
            $attributes .= ' class="' . ($depth > 0 ? 'mobile-dropdown-link' : 'mobile-nav-link') . '"';
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;

        if ($args->walker->has_children) {
            $item_output .= ' <i class="fas fa-chevron-down mobile-dropdown-icon"></i>';
        }

        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Fallback menu for desktop
 */
function peerali_law_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li class="nav-item"><a href="' . esc_url(home_url('/')) . '" class="nav-link">' . esc_html__('Home', 'peerali-law') . '</a></li>';
    wp_list_pages(array(
        'title_li' => '',
        'walker'   => new Peerali_Law_Page_Walker(),
    ));
    echo '</ul>';
}

/**
 * Fallback menu for mobile
 */
function peerali_law_mobile_fallback_menu() {
    echo '<ul class="mobile-nav-menu">';
    echo '<li class="mobile-nav-item"><a href="' . esc_url(home_url('/')) . '" class="mobile-nav-link">' . esc_html__('Home', 'peerali-law') . '</a></li>';
    wp_list_pages(array(
        'title_li' => '',
    ));
    echo '</ul>';
}

/**
 * Custom page walker
 */
class Peerali_Law_Page_Walker extends Walker_Page {
    function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0) {
        $output .= '<li class="nav-item"><a href="' . esc_url(get_permalink($page->ID)) . '" class="nav-link">' . esc_html($page->post_title) . '</a></li>';
    }
}
?>
