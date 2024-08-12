<?php
/**
 * Font Family.
 *
 * Creates a font family object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Typography\Font\Family;

use JsonSerializable;

/**
 * Font family choice class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Family implements JsonSerializable {

    /**
     * Setting name.
     *
     * @since  2.0.0
     * @var    string
     *
     * @access protected
     */
    protected $name;

    /**
     * Setting label.
     *
     * @since  2.0.0
     * @var    string
     *
     * @access protected
     */
    protected $label;

    /**
     * CSS-ready font stack.
     *
     * @since  2.0.0
     * @var    string
     *
     * @access protected
     */
    protected $stack = 'system-ui';

    /**
     * Font name on Google Fonts.
     *
     * @since  2.0.0
     * @var    string
     *
     * @access protected
     */
    protected $google = '';

    /**
     * Font styles.  This is primarily used for Google Fonts.  By default,
     * we'll assume all fonts have the regular, regular italic, bold, and
     * bold italic styles that are necessary for body copy.
     *
     * @since  2.0.0
     * @var    array
     *
     * @access protected
     */
    protected $styles = [
        '400',
        '400i',
        '700',
        '700i',
    ];

    /**
     * Set up the object properties.
     *
     * @since  2.0.0
     * @param  string $name
     * @param  array  $options
     * @return void
     *
     * @access public
     */
    public function __construct( $name, array $options = [] ) {

        foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
            if ( isset( $options[ $key ] ) ) {
                $this->$key = $options[ $key ];
            }
        }

        $this->name = $name;
    }

    /**
     * Returns a JSON-ready array of only the properties we'll need for use
     * in the customize-preview JS.
     *
     * @since  2.0.0
     * @return array
     *
     * @access public
     */
    public function jsonSerialize(): array {

        return [
            'googleName' => str_replace( '+', ' ', $this->googleName() ),
            'name'       => $this->name(),
            'stack'      => $this->stack(),
            'styles'     => $this->styles(),
        ];
    }

    /**
     * Returns the choice name.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function name() {
        return $this->name;
    }

    /**
     * Returns the choice label.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function label() {
        return $this->label ?: $this->name();
    }

    /**
     * Returns the font stack.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function stack() {

        return apply_filters( "exhale/typography/font/family/{$this->name}/stack", $this->stack, $this );
    }

    /**
     * Returns whether the font is a Google font.
     *
     * @since  2.0.0
     * @return bool
     *
     * @access public
     */
    public function isGoogleFont() {
        return (bool) $this->google;
    }

    /**
     * Returns the Google Font name.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function googleName() {
        return $this->isGoogleFont() ? $this->google : '';
    }

    /**
     * Returns the font styles that this family supports.
     *
     * @since  2.0.0
     * @return array
     *
     * @access public
     */
    public function styles() {
        return $this->styles;
    }

}
