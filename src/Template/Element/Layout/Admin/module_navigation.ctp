<?php

$navigation_items = [
	[
		'title' => __d('admin', 'Examples'),
		'url' => ['controller' => 'examples', 'action' => 'index']
	],
	[
		'title' => __d('admin', 'Catégories exemples'),
		'url' => ['controller' => 'exampleCategories', 'action' => 'index']
	]
];

?>

<ul>

	<?php foreach ($navigation_items as $item) : ?>

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