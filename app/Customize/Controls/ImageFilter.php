<?php
/**
 * Multiple select customizer control.
 *
 * This class allows developers to create a `<select>` form field with the
 * `multiple` attribute within the WordPress theme customizer.
 *
 * @package   Hybrid
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-customize
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale\Customize\Controls;

use WP_Customize_Control;

/**
 * Multiple select customize control class.
 *
 * @since  1.0.0
 * @access public
 */
class ImageFilter extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'exhale-image-filter';

	/**
	 * Array of label strings for the various fields.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = [];

	public $filters = [];

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = [] ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args( $this->l10n, [
			'function' => esc_html__( 'Filter Function' ),
			'amount'   => esc_html__( 'Filter Amount' )
		] );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$filters = [];

		foreach ( $this->filters as $filter ) {
			$filters[ $filter->name() ] = $filter->label();
		}

		$current_filter = $this->filters->get( $this->value( 'function' ) );

		$this->json['function'] = [
			'link'    => $this->get_link( 'function' ),
			'value'   => $this->value( 'function' ),
			'label'   => $this->l10n[ 'function' ],
			'choices' => $filters
		];

		$this->json['amount'] = [
			'link'    => $this->get_link( 'amount' ),
			'value'   => $this->value( 'amount' ),
			'label'   => $this->l10n[ 'amount' ],
			'min'     => $current_filter->min(),
			'max'     => $current_filter->max(),
			'lacuna'  => $current_filter->lacuna()
		];
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<# if ( data.function && data.function.choices ) { #>

			<p class="exhale-image-filter-function">

				<label>
					<# if ( data.function.label ) { #>
						<span class="customize-control-title customize-control-title--subtitle">{{ data.function.label }}</span>
					<# } #>

					<select {{{ data.function.link }}}>

						<# _.each( data.function.choices, function( label, choice ) { #>
							<option value="{{ choice }}" <# if ( choice === data.function.value ) { #> selected="selected" <# } #>>{{ label }}</option>
						<# } ) #>

					</select>
				</label>
			</p>

		<# } #>

		<# if ( data.amount ) { #>

			<p class="exhale-image-filter-amount">

				<label>
					<# if ( data.amount.label ) { #>
						<span class="customize-control-title customize-control-title--subtitle">{{ data.amount.label }} (%)</span>
					<# } #>

					<input type="number" step="10" min="{{{ data.amount.min }}}" max="{{{ data.amount.max }}}" {{{ data.amount.link }}} value="{{ data.amount.value }}" />
				</label>
			</p>

		<# } #>
	<?php }

	/**
	 * This is the PHP callback for rendering the control content. JS-based
	 * controls require this method to be empty.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 */
	protected function render_content() {}
}
