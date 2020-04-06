<section class="view view-example">
	<h1><?= $example->title ?></h1>
	<h2><?= $example->example_category->title ?></h2>
	<?php if (!empty($example->media)) : ?>
		<?php foreach ($example->media as $media) : ?>
			<?=
				$this->Image->display($media, [
					'manipulation' => [
						'type' => 'width',
						'value' => 600
					]
				])
			?>
		<?php endforeach; ?>
	<?php endif; ?>

	<p><?= $example->description ?></p>
</section>