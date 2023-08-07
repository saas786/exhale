<?php
/**
 * Font Family Setting.
 *
 * Creates a font family setting object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Image\Filter;

use Exhale\Contracts\CssCustomProperty;
use Exhale\Tools\Mod;

/**
 * Font family setting class.
 *
 * @since  1.1.0
 *
 * @access public
 */
class Setting implements CssCustomProperty {

    /**
     * Setting name.
     *
     * @since  1.1.0
     * @var    string
     *
     * @access protected
     */
    protected $name;

    /**
     * Setting label.
     *
     * @since  1.1.0
     * @var    string
     *
     * @access protected
     */
    protected $label;

    /**
     * Setting description.
     *
     * @since  1.1.0
     * @var    string
     *
     * @access protected
     */
    protected $description = '';

    /**
     * Setting default (should be the name of a `Choice` object).
     *
     * @since  1.1.0
     * @var    int
     *
     * @access protected
     */
    protected $amount = 0;

    /**
     * Set up the object properties.
     *
     * @since  1.1.0
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
     * Returns the setting name.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function name() {
        return $this->name;
    }

    /**
     * Returns the setting label.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function label() {

        return apply_filters(
            "exhale/image/filter/setting/{$this->name}/label",
            $this->label ?: $this->name(),
            $this
        );
    }

    /**
     * Returns the setting name as a theme mod.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function modName() {
        return sprintf( 'image_%s_filter_amount', str_replace( '-', '_', $this->name() ) );
    }

    /**
     * Returns the setting description.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function description() {
        return $this->description;
    }

    /**
     * Returns the default setting value.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function amount() {

        return apply_filters(
            "exhale/image/filter/setting/{$this->name}/default",
            Mod::fallback( $this->modName() ),
            $this
        );
    }

    /**
     * Returns the theme mod for the setting.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function mod() {
        return Mod::get( $this->modName(), $this->amount() );
    }

    /**
     * Returns a valid CSS selector for the property.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function cssSelector() {
        return ':root';
    }

    /**
     * Returns the CSS property.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function cssProperty() {
        return sprintf( '--image-%s-filter', $this->name() );
    }

    /**
     * Returns the CSS property value.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function cssValue() {

        $filter_function = Mod::get( 'image_default_filter_function' );

        if ( 'none' === $filter_function ) {
            return 'none';
        }

        return sprintf(
            '%s( %s%% )',
            esc_html( $filter_function ),
            absint( $this->mod() )
        );
    }

}
