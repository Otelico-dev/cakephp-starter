<?php if ($link_add = $this->fetch('link_add')) : ?>
	<p class="text-right">
		<?= $link_add; ?>
	</p>
<?php endif; ?>

<div class="index index-<?= strtolower($this->request->getParam('controller')) ?> table_wrapper">

	<div class="table-responsive">
		<?=
			$this->DataTables->render(
				$this->Fetch('datatables_variable'),
				[
					'class' => 'table table-striped',

				]
			)
		?>
	</div>

</div>

<?php if ($this->fetch('reorder')) : ?>
	<?php
	$this->Html->scriptStart(['block' => true]);
	echo $this->DtReorder->getScript('dt' . $this->Fetch('datatables_variable'), ['action' => 'reorder']);
	$this->Html->scriptEnd();
	?>
<?php endif; ?>

<?php if ($toggle = $this->fetch('toggle')) : ?>

	<?php $this->start('scriptBottom');
	?>

	<script>
		$('#dt<?= $this->Fetch('datatables_variable'); ?>').on('draw.dt', function() {

			$('[data-toggle="<?= $toggle; ?>"]').bootstrapToggle();

			$('[data-toggle="<?= $toggle; ?>"]').change(function(e) {

				e.stopPropagation();
				$.post($(this).data('target'));

			});
		});
	</script>

	<?php $this->end(); ?>

<?php endif; ?>