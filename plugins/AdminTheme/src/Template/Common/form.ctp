<?php

$sidebar_exists = $this->exists('form.sidebar');

$options = [];
if ($this->exists('form.options')) {
	$options = $this->fetch('form.options');
}
?>

<?php

if ($this->exists('form.before_create')) {
	echo $this->fetch('form.before_create');
}

?>

<?= $this->Form->create($this->fetch('entity'), $options); ?>

<?= $this->Element('AdminTheme.Forms/submit'); ?>

<div class="row">
	<fieldset class="form__container form-group col-sm-12 <?php if ($sidebar_exists) echo 'col-md-8'; ?>">
		<?= $this->fetch('form.controls') ?>
	</fieldset>

	<?php if ($sidebar_exists) : ?>
		<fieldset class="form__container--sidebar form-group col-sm-12 col-md-4">
			<?= $this->fetch('form.sidebar'); ?>
		</fieldset>
	<?php endif; ?>
</div>

<?= $this->Form->end(); ?>