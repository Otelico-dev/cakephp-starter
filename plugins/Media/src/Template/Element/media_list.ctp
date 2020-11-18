<?php

use Cake\Routing\Router; ?>
<ul class="media_gallery serialization">

	<?php foreach ($medias as $media) : ?>
		<li data-id="<?= $media->id ?>">

			<?= $this->Html->image('/image/' . $media->file_path . 'm_cropwidth_200/' . $media->file); ?>

			<div class="container_images_controls">

				<p class="btns_images_controls">

					<?php

					echo $this->Html->link(
						'<i class="fa fa-eye"></i>',
						Router::url('/image/' . $media->file_path . $media->file),
						[
							'class' => 'btn btn-info btn-sm',
							'title' => __d('media', 'LINK_SHOW'),
							'escape' => false,
							'data-fancybox' => 'gallery'
						]
					);

					?>

					<?php

					echo $this->Html->link(
						'<i class="fa fa-trash"></i>',
						[
							'controller' => 'medias',
							'action' => 'delete',
							'plugin' => 'Media',
							'prefix' => false,
							$media->id,
							$media->foreign_key,

						],
						[
							'class' => 'btn btn-danger btn-sm delete_image',
							'title' => __d('media', 'LINK_DELETE'),
							'escape' => false
						]
					);

					?>
				</p>
			</div>
		</li>

	<?php endforeach ?>
</ul>