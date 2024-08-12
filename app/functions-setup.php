<?php
/**
 * Theme setup functions.
 *
 * This file holds basic theme setup functions executed on appropriate hooks
 * with some opinionated priorities based on theme dev, particularly working
 * with child theme devs/users, over the years. I've also decided to use
 * anonymous functions to keep these from being easily unhooked. WordPress has
 * an appropriate API for unregistering, removing, or modifying all of the
 * things in this file. Those APIs should be used instead of attempting to use
 * `remove_action()`.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale;

/**
 * Set up theme support.  This is where calls to `add_theme_support()` happen.
 *
 * @since  1.0.0
 * @return void
 *
 * @access public
 */
add_action( 'after_setup_theme', static function() {

    // Sets the theme content width.
    $GLOBALS['content_width'] = 640;

    // Load theme translations.
    load_theme_textdomain( 'exhale', get_parent_theme_file_path( 'public/lang' ) );

    // Automatically add the `<title>` tag.
    add_theme_support( 'title-tag' );

    // Automatically add feed links to `<head>`.
    add_theme_support( 'automatic-feed-links' );

    // Adds featured image support.
    add_theme_support( 'post-thumbnails' );

    // Add selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Wide and full alignment.
    add_theme_support( 'align-wide' );

    // Outputs HTML5 markup for core features.
    add_theme_support( 'html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
    ] );

    // Add custom logo support.
    add_theme_support( 'custom-logo', [
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => [
            'app-header__title',
            'app-header__description',
            'app-header__sep',
        ],
        'height'      => 58,
        'width'       => null,
    ] );
}, 5 );

/**
 * Register menus.
 *
 * @since  1.0.0
 * @return void
 *
 * @access public
 */
add_action( 'init', static function() {

    register_nav_menus( [
        'footer'  => esc_html_x( 'Footer', 'nav menu location', 'exhale' ),
        'primary' => esc_html_x( 'Primary', 'nav menu location', 'exhale' ),
        'social'  => esc_html_x( 'Social', 'nav menu location', 'exhale' ),
    ] );
}, 5 );

/**
 * Register sidebars.
 *
 * @since  2.1.0
 * @return void
 *
 * @access public
 */
add_action( 'widgets_init', static function() {

    $args = [
        'after_title'   => '</h3>',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget__title">',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
    ];

    foreach ( range( 1, 4 ) as $num ) {

        register_sidebar( [
            'id'   => "footer-{$num}",
            'name' => sprintf( __( 'Footer %d', 'exhale' ), $num ),
        ] + $args );
    }
}, 5 );

/**
 * Changes the theme template path to the `public/views` folder.
 *
 * @since  1.0.0
 * @return string
 *
 * @access public
 */
add_filter( 'hybrid/template/path', static fn() => 'public/views' );

/**
 * Registers custom templates with WordPress.
 *
 * @since  1.0.0
 * @param  object  $templates
 * @return void
 *
 * @access public
 */
add_action( 'hybrid/templates/register', static function( $templates ) {

    $templates->put( 'template-canvas.php', [
        'label' => __( 'Content Canvas', 'exhale' ),
    ] );

    $templates->put( 'template-landing.php', [
        'label' => __( 'Landing', 'exhale' ),
    ] );

    $templates->put( 'template-landing-canvas.php', [
        'label' => __( 'Landing: Content Canvas', 'exhale' ),
    ] );

    // $templates->put( 'template-entry-content-only.php', [
    // 'label' => __( 'No Post Header/Footer', 'exhale' )
    // ] );
} );
