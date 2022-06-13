<?php

if (!function_exists('bs2wp_theme_setup')) {
   // Theme setup
    function bs2wp_theme_setup() {
        load_theme_textdomain('bs2wp', get_template_directory() . '/languages');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support(
            'html5', [
                'comment-list',
                'comment-form',
                'search-form',
                'gallery',
                'caption'
        ]);
        add_theme_support( 'customize-selective-refresh-widgets' );
        add_theme_support( 'responsive-embeds' );

        register_nav_menus(
            [
                'primary' => esc_html__('Primary Menu', 'bs2wp')

            ]
        );

    }
}

add_action('after_setup_theme', 'bs2wp_theme_setup');

// Enqueue scripts and styles
function bs2wp_assets() {
   // Enqueue CSS
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', [], false, 'all');
    wp_enqueue_style( 'main', get_stylesheet_uri(), [], '1.0', 'all');
    wp_enqueue_style( 'flaticon', get_theme_file_uri('assets/fonts/flaticon.css'), [], false, 'all');
    // Enqueue JS
    wp_enqueue_script('bootstrap-js', get_theme_file_uri('assets/js/lib/bootstrap.min.js'), [], 'v5.1.3 ', true);
    wp_enqueue_script('main-js', get_theme_file_uri('assets/js/main-script.js'), ['jquery', 'jquery-ui-core', 'jquery-ui-selectmenu'], 'v1.0 ', true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'bs2wp_assets');

function bs2wp_excerpts_readmore($more) {
    return '...';
}

add_action('excerpt_more', 'bs2wp_excerpts_readmore');

function bw2wp_pagination() {
    global $wp_query;
    $links = paginate_links(
        array(
            'current'   => max( 1, get_query_var( 'paged') ),
            'total'     => $wp_query -> max_num_pages,
            'type'      => 'list',
            'prev_text' => '<-',
            'next_text' =>  '->'
        )
    );
    $links = '<nav class="b2w-pagination">' . $links;
    $links .= '</nav>';
    echo wp_kses_post( $links );
}

// Add customizer.
require get_template_directory() . '/includes/customizer-bs2wp.php';

/**
 * Registers an editor stylesheet for the theme.
 */
function bw2wp_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'bw2wp_theme_add_editor_styles' );