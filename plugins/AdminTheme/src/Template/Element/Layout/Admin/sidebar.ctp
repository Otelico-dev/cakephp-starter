<?php if ($sidebar_header = $this->Element('Layout/Admin/sidebar_header', [], ['ignoreMissing' => true])) : ?>
	<?= $sidebar_header; ?>
<?php endif; ?>



<nav class="module-navigation">
	<?= $this->Element('Layout/Admin/module_navigation', [], ['ignoreMissing' => true]) ?>
</nav>