<section class="index index-examples">
	<h1><?= __d('public', 'TITLE_EXAMPLES'); ?></h1>
	<?php foreach ($examples as $example) : ?>
		<section>
			<h2><?= $example->title ?></h2>
			<h3><?= $example->example_category->title ?></h3>
			<p><?= $example->description ?></p>
			<?php if (!empty($example->media[0])) : ?>
				<?=
					$this->Image->display($example->media[0], [
						'manipulation' => [
							'type' => 'width',
							'value' => 600
						]
					])
				?>
			<?php endif; ?>
			<p>
				<?=
					$this->Html->link(
						__d('public', 'LINK_SEE_EXAMPLE'),
						[
							'controller' => 'examples',
							'action' => 'view',
							$example->id
						]
					)

				?>
			</p>
		</section>
	<?php endforeach; ?>
</section>