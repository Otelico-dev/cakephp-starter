<?php

$sidebar_exists = isset($sidebar);

// $options = [];
// if ($this->exists('form.options')) {
// 	$options = $this->fetch('form.options');
// }
?>

<?php

if ($this->exists('form.before_create')) {
	echo $this->fetch('form.before_create');
}

?>

<?= $this->Form->create($entity, $options ?? []); ?>

<?php if ($this->exists('form.after_create')) : ?>
	<?= $this->fetch('form.after_create'); ?>
<?php endif; ?>

<?= $this->Element('AdminTheme.Forms/submit'); ?>

<div class="row">
	<fieldset class="form__container form-group col-sm-12 <?php if ($sidebar_exists) echo 'col-md-8'; ?>">

		<?php foreach ($controls as $field => $options) : ?>

			<?=
				$this->Element('AdminTheme.Forms/form_control', [
					'entity' => $entity,
					'field' => $field,
					'options' => $options
				]);
			?>

		<?php endforeach; ?>

		<?php if (!empty($fieldsets)) : ?>

			<?php foreach ($fieldsets as $fieldset) : ?>

				<?= $this->Element('AdminTheme.Forms/fieldset', ['fieldset' => $fieldset, 'entity' => $entity]); ?>

			<?php endforeach; ?>
		<?php endif; ?>
	</fieldset>

	<?php if ($sidebar_exists) : ?>
		<fieldset class="form__container--sidebar form-group col-sm-12 col-md-4">
			<?php foreach ($sidebar as $field => $options) : ?>

				<?=
					$this->Element('AdminTheme.Forms/form_control', [
						'entity' => $entity,
						'field' => $field,
						'options' => $options
					]);
				?>

			<?php endforeach; ?>
		</fieldset>
	<?php endif; ?>
</div>

<?php if ($this->exists('form.before_end')) : ?>
	<?= $this->fetch('form.before_end'); ?>
<?php endif; ?>

<?= $this->Form->end(); ?>

<?php
if ($this->exists('form.after_end')) {
	echo $this->fetch('form.after_end');
}
?>