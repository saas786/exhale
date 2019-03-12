<?php
/**
 * Color component.
 *
 * Handles the theme color feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Color;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

/**
 * Color component class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Color settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Settings
	 */
	protected $settings;

	/**
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Settings  $settings
	 * @return void
	 */
	public function __construct( Settings $settings ) {
		$this->settings = $settings;
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		add_action( 'after_setup_theme', [ $this, 'register' ] );

		add_action( 'extant/color/settings/register', [ $this, 'registerDefaultSettings'] );
	}

	/**
	 * Runs the register action and adds theme support.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom color settings.
		do_action( 'extant/color/settings/register', $this->settings );

		// Adds a color palette to the block editor.
		add_theme_support( 'editor-color-palette', $this->settings->editorPalette() );
	}

	/**
	 * Registers default color settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Settings  $settings
	 * @return void
	 */
	public function registerDefaultSettings( Settings $settings ) {

		foreach ( Config::get( 'color-settings.php' ) as $name => $options ) {
			$settings->add( $name, $options );
		}
	}

	/**
	 * Returns an inline style for the colors.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function inlineStyle() {

		$css = '';

		foreach ( $this->settings as $setting ) {
			$color = $setting->rgb();

			$css .= sprintf(
				'--color-%s: %s;',
				esc_html( $setting->name() ),
				esc_html( sprintf(
					'%s,%s,%s',
					$color['r'],
					$color['g'],
					$color['b']
				) )
			);
		}

		return sprintf( ':root { %s }', $css );
	}
}