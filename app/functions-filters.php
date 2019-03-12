<?php
/**
 * Theme filters and actions.
 *
 * Adds and defines custom filters and actions the theme adds to core WordPress.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale;

use Exhale\Tools\Svg;

add_filter( 'walker_nav_menu_start_el', __NAMESPACE__ . '\nav_menu_social_icons', 10, 4 );

add_filter( 'excerpt_length', function() {
	return 20;
} );

add_filter( 'excerpt_more', function() {

	return sprintf(
		'&hellip;<a href="%s" class="entry__more-link">%s</a>',
		esc_url( get_permalink() ),
		sprintf(
			// Translators: %s is the post title for screen readers.
			__( 'Continue reading %s &rarr;' ),
			the_title( '<span class="screen-reader-text">', '</span>', false )
		)
	);
} );

/**
 * Adds social icon SVGs to the social menu.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $item_output
 * @param  object  $item
 * @param  int     $depth
 * @param  array   $args
 * @return string
 */
function nav_menu_social_icons( $item_output, $item, $depth, $args ) {

	if ( 'social' === $args->theme_location ) {

		$icons = map_social_icons();

		foreach ( $icons as $url => $icon ) {

			if ( false !== strpos( $item->url, $url ) ) {
				$item_output = str_replace(
					$args->link_before,
					Svg::render( $icon ) . $args->link_before,
					$item_output
				);
			}
		}
	}

	return $item_output;
}

/**
 * Maps a URL pattern to icon names.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function map_social_icons() {

	return [
		'a.co'            => 'amazon-brands',
		'amazon.com'      => 'amazon-brands',
		'behance.net'     => 'behance',
		'codepen.io'      => 'codepen',
		'deviantart.com'  => 'deviantart',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook-brands',
		'feed'            => 'rss-square-solid',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'google-plus',
		'github.com'      => 'github-brands',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'envelope-o',
		'medium.com'      => 'medium',
		'pinterest.com'   => 'pinterest-p',
		'getpocket.com'   => 'get-pocket',
		'reddit.com'      => 'reddit-alien',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'slideshare.net'  => 'slideshare',
		'snapchat.com'    => 'snapchat-ghost',
		'soundcloud.com'  => 'soundcloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter-brands',
		'vimeo.com'       => 'vimeo',
		'vine.co'         => 'vine',
		'vk.com'          => 'vk',
		'wordpress.org'   => 'wordpress-simple-brands',
		'wordpress.com'   => 'wordpress-simple-brands',
		'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
	];
}