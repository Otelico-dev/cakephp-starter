<div class="gallery-item-infos" id="gallery-item-infos-<?= $media->id ?>">

	<h3><?= __d('media','About this file'); ?></h3>

	<div class="item-details">

		<div class="file">
			<a href="/images<?= $media->file_path?>" target="_blank">
				<?= $this->Html->image('/images/w200'.$media->file_path);?>
			</a>
		</div>

		<div class="details">
			<span class="file-title"><strong><?= basename($media->file); ?></strong></span>

			<?php if($media->file_type == 'pic'): ?>
				<span class="file-dimension"><?= $media->dimensions->width.' x '.$media->dimensions->height; ?></span>
				<!--<a class="edit-file" href="#"><?= __d('media','Modify picture'); ?></a>-->
			<?php endif; ?>
			<?= $this->Media->human_filesize($media->file_info['filesize']) ?>
			
			<?= $this->Html->link(__d('media','Delete'), ['action'=>'delete',$media->id], ['class'=>'delete red','data-id'=>$media->id]); ?>

		</div>

	</div>

	<?= $this->Form->create($media, ['url' => ['controller' => 'medias', 'action' => 'update', $media->id]]); ?>

		<label class="settings"> <span><?= __d('media',"Title"); ?></span>
			<?= $this->Form->input('name', ['class' => 'title autosubmit', 'div' => false, 'label' => false, 'value' => $media->name ? $media->name : pathinfo($media->file, PATHINFO_FILENAME)]); ?>
		</label>

		<?php if($media->file_type == 'pic'): ?>
		<label class="settings"> <span><?= __d('media',"Alt text"); ?></span>
			<input class="alt" name="alt" type="text">
		</label>
		<?php endif; ?>

		<label class="settings"> <span><?= __d('media',"Caption"); ?></span>
			<?= $this->Form->input('caption', ['class' => 'caption autosubmit', 'div' => false, 'label' => false]); ?>
		</label> 
		<label class="settings"> <span><?= __d('media',"Target"); ?></span>
			<input class="href" name="href" type="text" disabled value="<?= $this->Url->build($media->file); ?>">
		</label>

		<?php if($media->file_type == 'pic' && isset($show_display_settings)) : ?>
			<h3><?= __d('media', "Display settings"); ?></h3>
			<div class="settings media-alignment">
				<span><?= __d('media',"Alignment"); ?></span> <select name="align"
					class="align">
					<option value="none"><?= __d('media','None'); ?></option>
					<option value="center"><?= __d('media','Center'); ?></option>
					<option value="left"><?= __d('media','Left'); ?></option>
					<option value="right"><?= __d('media','Right'); ?></option>
				</select>
			</div>
		<?php endif; ?>

		<input type="hidden" class="filetype" name="filetype"
		value="<?= $media->file_type; ?>" /> 
		<input type="hidden" name="file"
		value="<?= $this->Url->build($media->file); ?>" class="path">	

	<?= $this->Form->end(); ?>

	<p class="tright">
		<?php if($thumbID !== false && $media->id !== $thumbID && $media->file_type == 'pic'): ?>
			<?= $this->Html->link(__d('media',"Set as thumbnail"), ['action'=>'thumb',$media->id], ['class' => 'btn btn-default']); ?>
		<?php endif; ?>
		<?php if ($editor): ?>
			<a href="" class="submit btn btn-primary"><?= __d('media',"Insert into post"); ?></a>
		<?php endif; ?>
	</p>

</div>