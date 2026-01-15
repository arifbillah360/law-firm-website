<?php
/**
 * Peerali Law Theme Functions
 *
 * @package Peerali_Law
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function peerali_law_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1280, 720, true);

    // Add additional image sizes
    add_image_size('peerali-featured-large', 1920, 1080, true);
    add_image_size('peerali-featured-medium', 1280, 720, true);
    add_image_size('peerali-thumbnail', 400, 300, true);

    // Custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Switch default core markup for search form, comment form, and comments to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'peerali-law'),
        'footer'  => esc_html__('Footer Menu', 'peerali-law'),
    ));
}
add_action('after_setup_theme', 'peerali_law_theme_setup');

/**
 * Set the content width in pixels - Set to maximum for full-width pages
 */
function peerali_law_content_width() {
    $GLOBALS['content_width'] = apply_filters('peerali_law_content_width', 9999);
}
add_action('after_setup_theme', 'peerali_law_content_width', 0);

/**
 * Enqueue Styles - ONLY style.css (which imports main.css, navigation.css, footer.css via @import)
 */
function peerali_law_enqueue_styles() {
    // Google Fonts
    wp_enqueue_style(
        'peerali-google-fonts',
        'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Playfair+Display:wght@600;700;800&display=swap',
        array(),
        null
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );

    // Main theme stylesheet (style.css) - this imports main.css, navigation.css, footer.css
    wp_enqueue_style(
        'peerali-law-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version'),
        'all'
    );
}
add_action('wp_enqueue_scripts', 'peerali_law_enqueue_styles');

/**
 * Aggressively Remove ALL WordPress Default Styles
 */
function peerali_law_remove_wp_styles() {
    // Remove AND deregister block library CSS (Gutenberg styles)
    wp_dequeue_style('wp-block-library');
    wp_deregister_style('wp-block-library');

    wp_dequeue_style('wp-block-library-theme');
    wp_deregister_style('wp-block-library-theme');

    wp_dequeue_style('wc-blocks-style');
    wp_deregister_style('wc-blocks-style');

    wp_dequeue_style('global-styles');
    wp_deregister_style('global-styles');

    wp_dequeue_style('classic-theme-styles');
    wp_deregister_style('classic-theme-styles');

    // Remove core block patterns
    wp_dequeue_style('wp-block-patterns');
    wp_deregister_style('wp-block-patterns');
}
add_action('wp_enqueue_scripts', 'peerali_law_remove_wp_styles', 100);

/**
 * Remove WordPress Default Styles from Front-End - MORE AGGRESSIVE
 */
function peerali_law_remove_all_wp_styles() {
    if (!is_admin()) {
        // Remove Gutenberg styles
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('global-styles');
        wp_dequeue_style('classic-theme-styles');

        // Remove from print as well
        wp_deregister_style('wp-block-library');
        wp_deregister_style('wp-block-library-theme');
        wp_deregister_style('global-styles');
        wp_deregister_style('classic-theme-styles');
    }
}
add_action('wp_print_styles', 'peerali_law_remove_all_wp_styles', 100);

/**
 * Enqueue Scripts
 */
function peerali_law_enqueue_scripts() {
    // Main JavaScript
    wp_enqueue_script(
        'peerali-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Navigation JavaScript
    wp_enqueue_script(
        'peerali-navigation-js',
        get_template_directory_uri() . '/assets/js/navigation.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Footer JavaScript
    wp_enqueue_script(
        'peerali-footer-js',
        get_template_directory_uri() . '/assets/js/footer.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Pass data to JavaScript
    wp_localize_script('peerali-main-js', 'peeraliLaw', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('peerali-law-nonce'),
        'themeUrl' => get_template_directory_uri(),
    ));
}
add_action('wp_enqueue_scripts', 'peerali_law_enqueue_scripts');

/**
 * Register Widget Areas
 */
function peerali_law_widgets_init() {
    // Sidebar
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'peerali-law'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'peerali-law'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // Footer Column 1
    register_sidebar(array(
        'name'          => esc_html__('Footer Column 1', 'peerali-law'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in footer column 1.', 'peerali-law'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer Column 2
    register_sidebar(array(
        'name'          => esc_html__('Footer Column 2', 'peerali-law'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here to appear in footer column 2.', 'peerali-law'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer Column 3
    register_sidebar(array(
        'name'          => esc_html__('Footer Column 3', 'peerali-law'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here to appear in footer column 3.', 'peerali-law'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer Column 4
    register_sidebar(array(
        'name'          => esc_html__('Footer Column 4', 'peerali-law'),
        'id'            => 'footer-4',
        'description'   => esc_html__('Add widgets here to appear in footer column 4.', 'peerali-law'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'peerali_law_widgets_init');

/**
 * Register Custom Post Types
 */
function peerali_law_register_post_types() {
    // Attorneys
    register_post_type('attorney', array(
        'labels' => array(
            'name'               => esc_html__('Attorneys', 'peerali-law'),
            'singular_name'      => esc_html__('Attorney', 'peerali-law'),
            'add_new'            => esc_html__('Add New', 'peerali-law'),
            'add_new_item'       => esc_html__('Add New Attorney', 'peerali-law'),
            'edit_item'          => esc_html__('Edit Attorney', 'peerali-law'),
            'new_item'           => esc_html__('New Attorney', 'peerali-law'),
            'view_item'          => esc_html__('View Attorney', 'peerali-law'),
            'search_items'       => esc_html__('Search Attorneys', 'peerali-law'),
            'not_found'          => esc_html__('No attorneys found', 'peerali-law'),
            'not_found_in_trash' => esc_html__('No attorneys found in trash', 'peerali-law'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'attorneys'),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'    => 'dashicons-businessperson',
        'show_in_rest' => true,
    ));

    // Practice Areas
    register_post_type('practice_area', array(
        'labels' => array(
            'name'               => esc_html__('Practice Areas', 'peerali-law'),
            'singular_name'      => esc_html__('Practice Area', 'peerali-law'),
            'add_new'            => esc_html__('Add New', 'peerali-law'),
            'add_new_item'       => esc_html__('Add New Practice Area', 'peerali-law'),
            'edit_item'          => esc_html__('Edit Practice Area', 'peerali-law'),
            'new_item'           => esc_html__('New Practice Area', 'peerali-law'),
            'view_item'          => esc_html__('View Practice Area', 'peerali-law'),
            'search_items'       => esc_html__('Search Practice Areas', 'peerali-law'),
            'not_found'          => esc_html__('No practice areas found', 'peerali-law'),
            'not_found_in_trash' => esc_html__('No practice areas found in trash', 'peerali-law'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'practice-areas'),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'    => 'dashicons-portfolio',
        'show_in_rest' => true,
    ));

    // Case Results
    register_post_type('case_result', array(
        'labels' => array(
            'name'               => esc_html__('Case Results', 'peerali-law'),
            'singular_name'      => esc_html__('Case Result', 'peerali-law'),
            'add_new'            => esc_html__('Add New', 'peerali-law'),
            'add_new_item'       => esc_html__('Add New Case Result', 'peerali-law'),
            'edit_item'          => esc_html__('Edit Case Result', 'peerali-law'),
            'new_item'           => esc_html__('New Case Result', 'peerali-law'),
            'view_item'          => esc_html__('View Case Result', 'peerali-law'),
            'search_items'       => esc_html__('Search Case Results', 'peerali-law'),
            'not_found'          => esc_html__('No case results found', 'peerali-law'),
            'not_found_in_trash' => esc_html__('No case results found in trash', 'peerali-law'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'case-results'),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'    => 'dashicons-awards',
        'show_in_rest' => true,
    ));
}
add_action('init', 'peerali_law_register_post_types');

/**
 * Register Custom Taxonomies
 */
function peerali_law_register_taxonomies() {
    // Case Types taxonomy for Case Results
    register_taxonomy('case_type', 'case_result', array(
        'labels' => array(
            'name'              => esc_html__('Case Types', 'peerali-law'),
            'singular_name'     => esc_html__('Case Type', 'peerali-law'),
            'search_items'      => esc_html__('Search Case Types', 'peerali-law'),
            'all_items'         => esc_html__('All Case Types', 'peerali-law'),
            'parent_item'       => esc_html__('Parent Case Type', 'peerali-law'),
            'parent_item_colon' => esc_html__('Parent Case Type:', 'peerali-law'),
            'edit_item'         => esc_html__('Edit Case Type', 'peerali-law'),
            'update_item'       => esc_html__('Update Case Type', 'peerali-law'),
            'add_new_item'      => esc_html__('Add New Case Type', 'peerali-law'),
            'new_item_name'     => esc_html__('New Case Type Name', 'peerali-law'),
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'case-type'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'peerali_law_register_taxonomies');

/**
 * Custom Meta Box for HTML Content
 */
function peerali_law_add_html_meta_box() {
    add_meta_box(
        'peerali_html_content',
        esc_html__('Custom HTML Content', 'peerali-law'),
        'peerali_law_html_meta_box_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'peerali_law_add_html_meta_box');

/**
 * Meta Box Callback
 */
function peerali_law_html_meta_box_callback($post) {
    wp_nonce_field('peerali_html_meta_box', 'peerali_html_meta_box_nonce');
    $value = get_post_meta($post->ID, '_peerali_html_content', true);
    ?>
    <p>
        <label for="peerali_html_content"><?php esc_html_e('Add your custom HTML content here:', 'peerali-law'); ?></label>
    </p>
    <textarea
        id="peerali_html_content"
        name="peerali_html_content"
        rows="20"
        style="width:100%;font-family:monospace;"
    ><?php echo esc_textarea($value); ?></textarea>
    <p class="description">
        <?php esc_html_e('Paste your complete HTML sections here. This content will be displayed in the page body, wrapped by the theme header and footer.', 'peerali-law'); ?>
    </p>
    <?php
}

/**
 * Save Meta Box Data
 */
function peerali_law_save_html_meta_box($post_id) {
    // Check if nonce is set
    if (!isset($_POST['peerali_html_meta_box_nonce'])) {
        return;
    }

    // Verify nonce
    if (!wp_verify_nonce($_POST['peerali_html_meta_box_nonce'], 'peerali_html_meta_box')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save data
    if (isset($_POST['peerali_html_content'])) {
        $html_content = wp_kses_post($_POST['peerali_html_content']);
        update_post_meta($post_id, '_peerali_html_content', $html_content);
    }
}
add_action('save_post', 'peerali_law_save_html_meta_box');

/**
 * Theme Customizer
 */
function peerali_law_customize_register($wp_customize) {
    // Header Settings Section
    $wp_customize->add_section('peerali_header_settings', array(
        'title'    => esc_html__('Header Settings', 'peerali-law'),
        'priority' => 30,
    ));

    // Phone Number
    $wp_customize->add_setting('peerali_phone', array(
        'default'           => '(818) 962-7071',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('peerali_phone', array(
        'label'   => esc_html__('Phone Number', 'peerali-law'),
        'section' => 'peerali_header_settings',
        'type'    => 'text',
    ));

    // CTA Button Text
    $wp_customize->add_setting('peerali_cta_text', array(
        'default'           => 'Free Consultation',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('peerali_cta_text', array(
        'label'   => esc_html__('CTA Button Text', 'peerali-law'),
        'section' => 'peerali_header_settings',
        'type'    => 'text',
    ));

    // CTA Button Link
    $wp_customize->add_setting('peerali_cta_link', array(
        'default'           => '#contact',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('peerali_cta_link', array(
        'label'   => esc_html__('CTA Button Link', 'peerali-law'),
        'section' => 'peerali_header_settings',
        'type'    => 'url',
    ));

    // Footer Settings Section
    $wp_customize->add_section('peerali_footer_settings', array(
        'title'    => esc_html__('Footer Settings', 'peerali-law'),
        'priority' => 40,
    ));

    // Footer Email
    $wp_customize->add_setting('peerali_email', array(
        'default'           => 'info@peeralilaw.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('peerali_email', array(
        'label'   => esc_html__('Email Address', 'peerali-law'),
        'section' => 'peerali_footer_settings',
        'type'    => 'email',
    ));

    // Footer Address
    $wp_customize->add_setting('peerali_address', array(
        'default'           => 'Hollywood Hills, Los Angeles, CA',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('peerali_address', array(
        'label'   => esc_html__('Address', 'peerali-law'),
        'section' => 'peerali_footer_settings',
        'type'    => 'textarea',
    ));

    // Social Media Links
    $social_networks = array(
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter',
        'linkedin'  => 'LinkedIn',
        'instagram' => 'Instagram',
    );

    foreach ($social_networks as $key => $label) {
        $wp_customize->add_setting('peerali_' . $key, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('peerali_' . $key, array(
            'label'   => $label . ' ' . esc_html__('URL', 'peerali-law'),
            'section' => 'peerali_footer_settings',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'peerali_law_customize_register');

/**
 * Remove WordPress Version
 */
remove_action('wp_head', 'wp_generator');

/**
 * Enable File Editing - Allow theme editor in WordPress admin
 */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', false);
}

/**
 * Remove Emoji Scripts
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/**
 * Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Security Headers
 */
function peerali_law_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}
add_action('send_headers', 'peerali_law_security_headers');

/**
 * Clean Up Head
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

/**
 * Excerpt Length
 */
function peerali_law_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'peerali_law_excerpt_length');

/**
 * Excerpt More
 */
function peerali_law_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'peerali_law_excerpt_more');

/**
 * Add Lazy Loading to Images
 */
function peerali_law_add_lazy_loading($content) {
    if (is_admin()) {
        return $content;
    }
    return str_replace('<img', '<img loading="lazy"', $content);
}
add_filter('the_content', 'peerali_law_add_lazy_loading');
add_filter('post_thumbnail_html', 'peerali_law_add_lazy_loading');

/**
 * Schema.org Markup for Law Firm
 */
function peerali_law_schema_markup() {
    $phone = get_theme_mod('peerali_phone', '(818) 962-7071');
    $email = get_theme_mod('peerali_email', 'info@peeralilaw.com');
    $address = get_theme_mod('peerali_address', 'Hollywood Hills, Los Angeles, CA');

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'LegalService',
        'name' => get_bloginfo('name'),
        'description' => get_bloginfo('description'),
        'url' => home_url('/'),
        'logo' => get_theme_mod('custom_logo') ? wp_get_attachment_url(get_theme_mod('custom_logo')) : '',
        'telephone' => $phone,
        'email' => $email,
        'address' => array(
            '@type' => 'PostalAddress',
            'addressLocality' => 'Los Angeles',
            'addressRegion' => 'CA',
            'addressCountry' => 'US'
        ),
        'priceRange' => 'No Win, No Fee',
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'peerali_law_schema_markup');

/**
 * Defer JavaScript Loading
 */
function peerali_law_defer_scripts($tag, $handle, $src) {
    // Don't defer admin scripts or jQuery
    if (is_admin() || strpos($handle, 'jquery') !== false) {
        return $tag;
    }

    // Defer our theme scripts
    $defer_scripts = array('peerali-main-js', 'peerali-navigation-js', 'peerali-footer-js');

    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'peerali_law_defer_scripts', 10, 3);

/**
 * Optimize Database Queries
 */
function peerali_law_optimize_queries() {
    // Remove query strings from static resources
    if (!is_admin()) {
        add_filter('script_loader_src', 'peerali_law_remove_script_version', 15, 1);
        add_filter('style_loader_src', 'peerali_law_remove_script_version', 15, 1);
    }
}
add_action('init', 'peerali_law_optimize_queries');

function peerali_law_remove_script_version($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

/**
 * Add Open Graph Tags
 */
function peerali_law_open_graph_tags() {
    if (is_singular()) {
        global $post;
        ?>
        <meta property="og:title" content="<?php echo esc_attr(get_the_title()); ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>" />
        <meta property="og:description" content="<?php echo esc_attr(wp_strip_all_tags(get_the_excerpt())); ?>" />
        <?php if (has_post_thumbnail()) : ?>
            <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>" />
        <?php endif; ?>
        <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="<?php echo esc_attr(get_the_title()); ?>" />
        <meta name="twitter:description" content="<?php echo esc_attr(wp_strip_all_tags(get_the_excerpt())); ?>" />
        <?php if (has_post_thumbnail()) : ?>
            <meta name="twitter:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>" />
        <?php endif; ?>
        <?php
    }
}
add_action('wp_head', 'peerali_law_open_graph_tags');

/**
 * Disable Gutenberg Block Styles Completely
 */
add_filter('should_load_separate_core_block_assets', '__return_false');

/**
 * Remove Gutenberg Block Editor Styles
 */
function peerali_law_disable_gutenberg_styles() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
}
add_action('wp_print_styles', 'peerali_law_disable_gutenberg_styles', 100);

/**
 * Debug Function - Shows CSS files being loaded (for admins only)
 */
function peerali_law_debug_css_loading() {
    if (current_user_can('administrator')) {
        echo "\n<!-- PEERALI LAW THEME CSS DEBUG:\n";
        echo "style.css path: " . get_stylesheet_uri() . "\n";
        echo "main.css path: " . get_template_directory_uri() . '/assets/css/main.css' . "\n";
        echo "main.css exists: " . (file_exists(get_template_directory() . '/assets/css/main.css') ? 'YES' : 'NO') . "\n";
        echo "navigation.css exists: " . (file_exists(get_template_directory() . '/assets/css/navigation.css') ? 'YES' : 'NO') . "\n";
        echo "footer.css exists: " . (file_exists(get_template_directory() . '/assets/css/footer.css') ? 'YES' : 'NO') . "\n";
        echo "-->\n";
    }
}
add_action('wp_footer', 'peerali_law_debug_css_loading');
