<?php if ($sidebar_header = $this->Element('Layout/Admin/sidebar_header', [], ['ignoreMissing' => true])) : ?>
	<div class="sidebar__header">
		<?= $sidebar_header; ?>
	</div>
<?php endif; ?>



<nav class="module-navigation">
	<?= $this->Element('AdminTheme.Layout/Admin/module_navigation', [], ['ignoreMissing' => true]) ?>
</nav>