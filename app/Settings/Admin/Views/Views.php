<?php
/**
 * Views Collection.
 *
 * Houses the collection of views in a single array-object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright  2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Settings\Admin\Views;

use Exhale\Tools\Collection;

/**
 * Views class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Views extends Collection {

    /**
     * Adds a new view to the collection.
     *
     * @since  1.0.0
     * @param  string $name
     * @param  array  $value
     * @return void
     *
     * @access public
     */
    public function put( $name, $value ) {

        $view = is_string( $value ) ? new $value() : $value;

        parent::put( $name, $view );
    }

}
