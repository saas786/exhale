<?php
/**
 * Theme mods settings Config.
 *
 * Defines the default theme mods for the theme. Child themes can overwrite this
 * with a `config/settings-mod.php` file for changing the defaults.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	// Set the default layout.
	'layout' => 'wide',

	// Backgrounds.
	'header_background_type'         => '',
	'color_header_background_fill'   => 'a9a9a9',
	'header_background_fill_opacity' => 0.5,
	'header_background_svg'          => '',
	'header_background_image'        => '',
	'header_background_attachment'   => 'scroll',
	'header_background_size'         => 'auto',
	'header_background_repeat'       => 'repeat',
	'header_background_position'     => 'center',

	'content_background_type'         => '',
	'color_content_background_fill'   => 'a9a9a9',
	'content_background_fill_opacity' => 0.5,
	'content_background_svg'          => '',
	'content_background_image'        => '',
	'content_background_attachment'   => 'scroll',
	'content_background_size'         => 'auto',
	'content_background_repeat'       => 'repeat',
	'content_background_position'     => 'center',

	'footer_background_type'         => '',
	'color_footer_background_fill'   => 'a9a9a9',
	'footer_background_fill_opacity' => 0.5,
	'footer_background_svg'          => '',
	'footer_background_image'        => '',
	'footer_background_attachment'   => 'scroll',
	'footer_background_size'         => 'auto',
	'footer_background_repeat'       => 'repeat',
	'footer_background_position'     => 'center',

	'sidebar_footer_background_type'         => '',
	'color_sidebar_footer_background_fill'   => 'a9a9a9',
	'sidebar_footer_background_fill_opacity' => 0.5,
	'sidebar_footer_background_svg'          => '',
	'sidebar_footer_background_image'        => '',
	'sidebar_footer_background_attachment'   => 'scroll',
	'sidebar_footer_background_size'         => 'auto',
	'sidebar_footer_background_repeat'       => 'repeat',
	'sidebar_footer_background_position'     => 'center',

	// Archive layout.
	'loop_archive_layout'     => 'list',
	'loop_archive_width'      => 'full',
	'loop_archive_columns'    => 4,
	'loop_archive_image_size' => 'exhale-landscape-large',
	'loop_archive_limit'      => function() {
		return \Exhale\Settings\Options::get( 'archive_posts_number' );
	},

	// Blog layout.
	'loop_blog_layout'     => 'blog',
	'loop_blog_width'      => 'full',
	'loop_blog_columns'    => 4,
	'loop_blog_image_size' => function() {
		return \Exhale\Tools\Mod::get( 'featured_image_size' );
	},
	'loop_blog_limit'      => function() {
		return \Exhale\Settings\Options::get( 'home_posts_number' );
	},

	// Archive product layout (WooCommerce).
	'loop_archive_product_inherit'    => false,
	'loop_archive_product_layout'     => 'grid',
	'loop_archive_product_width'      => 'full',
	'loop_archive_product_columns'    => 5,
	'loop_archive_product_image_size' => 'exhale-portrait-small',
	'loop_archive_product_limit'      => 10,

	// Product taxonomy layouts (WooCommerce).
	'loop_archive_product_cat_inherit' => 'archive_product',
	'loop_archive_product_tag_inherit' => 'archive_product',

	// Theme archive layouts (Theme Designer plugin).
	'loop_archive_theme_inherit'    => false,
	'loop_archive_theme_layout'     => 'grid',
	'loop_archive_theme_width'      => '4xl',
	'loop_archive_theme_columns'    => 2,
	'loop_archive_theme_image_size' => 'exhale-landscape-medium',

	// Plugin archive layouts (Plugin Developer plugin).
	'loop_archive_plugin_inherit'    => false,
	'loop_archive_plugin_layout'     => 'grid',
	'loop_archive_plugin_width'      => '4xl',
	'loop_archive_plugin_columns'    => 2,
	'loop_archive_plugin_image_size' => 'exhale-landscape-medium',

	// Set the default image filter mods.
	'image_default_filter_function' => 'grayscale',
	'image_default_filter_amount'   => 0,
	'image_hover_filter_amount'     => 100,

	// Header stickiness.
	'header_sticky' => false,

	// Branding separator.
	'branding_sep' => '&#183;',

	// Footer sidebar layout.
	'sidebar_footer_width' => 'full',

	// Set the default footer credit.
	'powered_by'    => true,
	'footer_credit' => function() {
		return sprintf( __( 'Powered by %s.', 'exhale' ), \Hybrid\Theme\render_link() );
	},

	// @deprecated 2.1.0
	'featured_image_size' => 'exhale-landscape-large',
];
