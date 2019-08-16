<li class="grid__item">

	<?php Exhale\Template\FeaturedImage::display( 'featured' ) ?>

	<header class="entry__header text-center">
		<?php Hybrid\Post\display_title( [
			'link'  => false,
			'class' => 'entry__title m-0',
			'text'  => Hybrid\Post\render_permalink( [
				'class' => 'entry__permalink no-underline hover:underline focus:underline',
				'text'  => '%%s'
			] )
		] ) ?>
		<div class="entry__byline">
			<?php woocommerce_template_loop_price() ?>
		</div>
	</header>

</li>
