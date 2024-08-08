<div <?php Hybrid\Attr\display( 'app-content', '', [
	'class' => sprintf(
		'app-content max-w-%s overflow-hidden my-%s mx-auto pt-12',
		'boxed-content' === Exhale\Tools\Mod::get( 'layout' ) ? '5xl' : 'full',
		'boxed-content' === Exhale\Tools\Mod::get( 'layout' ) ? '12' : '0'
	)
] ) ?>>

	<main id="main" class="app-main mx-auto mb-12 text-lg leading-loose">

		<?php $error_page->setup() ?>

		<div class="entry entry--error">

			<header class="entry__header o-content-width">
				<h1 class="entry__title"><?php $error_page->displayTitle() ?></h1>
			</header>

			<div class="entry__content o-content-width">
				<?php $error_page->displayContent() ?>
			</div>

		</div>

		<?php $error_page->reset() ?>

	</main>

</div>
