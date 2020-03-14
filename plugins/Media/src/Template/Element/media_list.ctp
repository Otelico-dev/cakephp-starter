<?php

use Cake\Routing\Router; ?>
<ul class="media_gallery serialization">

	<?php foreach ($medias as $media) : ?>
		<li data-id="<?= $media->id ?>">
			<?php //debug($media) 
				?>
			<?= $this->Html->image('/image/' . $media->file_path . 'm_cropwidth_200/' . $media->file); ?>

			<div class="container_images_controls">

				<!-- <p>
						<small>
						<?php

							echo (isset($media->caption) && $media->caption != '')
								? '<span title="' . $media->caption . '" rel="tooltip" data-placement="bottom" class="use_tooltip">' . $this->Text->truncate($media->caption, 50, array('html' => false)) . '</span>'
								: '<i class="no_image_title">' . __d('media', 'MSG_NO_IMAGE_CAPTION') . '</i>'; ?>
						</small>
					</p> -->

				<p class="btns_images_controls">

					<?php

						echo $this->Html->link(
							'<i class="glyphicon glyphicon-zoom-in"></i>',
							Router::url('/image/' . $media->file_path . $media->file),
							array(
								'class' => 'btn btn-info btn-sm show_image use_tooltip',
								'rel' => 'roomcategory tooltip',
								'data-placement' => 'bottom',
								'title' => __d('media', 'LINK_SHOW'),
								'escape' => false,
								'data-fancybox' => 'gallery'
							)
						);

						?>

					<?php

						// echo $this->Html->link(
						// 	'<i class="glyphicon glyphicon-pencil"></i>',
						// 	array(
						// 		'controller'=>'medias',
						// 		'action'=>'edit',
						// 		$media->id,
						// 		$media->ref_id
						// 		),
						// 	array(
						// 		'class'=>'btn btn-info btn-sm use_tooltip',
						// 		'rel'=>'tooltip',
						// 		'data-placement' => 'bottom',
						// 		'title'=>__d('media','LINK_MODIFY'),
						// 		'escape'=>false
						// 		)
						// 	);

						?>

					<?php

						echo $this->Html->link(
							'<i class="glyphicon glyphicon-trash"></i>',
							array(
								'controller' => 'medias',
								'action' => 'delete',
								$media->id,
								$media->foreign_key
							),
							array(
								'class' => 'btn btn-danger btn-sm delete_image use_tooltip',
								'rel' => 'tooltip',
								'data-placement' => 'bottom',
								'title' => __d('media', 'LINK_DELETE'),
								'escape' => false
							)
						);

						?>
				</p>
			</div>
		</li>

	<?php endforeach ?>
</ul>