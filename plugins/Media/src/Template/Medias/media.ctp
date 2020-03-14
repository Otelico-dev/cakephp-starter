<div
	class="gallery-item <?php if($thumbID && $media->id === $thumbID): ?>is-thumbnail<?php endif; ?>"
	id="gallery-<?= $media->id; ?>" data-id="<?= $media->id; ?>">

	<div class="gallery-item-thumb">
		<?= $this->Html->image('/images/sq200'.$media->file_path); ?>
	</div>
	<?php if (isset($show_media_info)) include 'media-info.ctp'; ?>
</div>
