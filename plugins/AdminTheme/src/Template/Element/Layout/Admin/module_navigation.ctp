<ul>

	<?php foreach ($module_navigation as $item) : ?>

		<?php
		$is_active = (strtolower($this->request->getParam('controller')) == strtolower($item['url']['controller']))
			? true
			: false;
		?>
		<li class="<?php if ($is_active) echo 'module-navigation__active' ?>">

			<?= $this->Html->link($item['title'], $item['url']); ?>
		</li>
	<?php endforeach; ?>

</ul>