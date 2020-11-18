<?= $this->fetch('before_index'); ?>

<h1><?= $this->fetch('title') ?></h1>

<?php if ($link_add = $this->fetch('link_add')) : ?>
	<p class="text-right">
		<?= $link_add; ?>
	</p>
<?php endif; ?>

<?= $this->Element('AdminTheme.Tables/datatable') ?>

<?= $this->fetch('content') ?>