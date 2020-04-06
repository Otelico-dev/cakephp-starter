<ul class="nav nav-tabs nav-form">
	<?php foreach ($nav_items as $key => $item) : ?>
		<?php

		reset($nav_items);

		$is_first_iteration = $key === key($nav_items)

		?>
		<li class="nav-item">
			<a class="nav-link <?php if ($is_first_iteration) echo 'active'; ?>" href="#<?= $item['id']; ?>" data-toggle="tab"><?= $item['label'] ?></a>
		</li>
	<?php endforeach; ?>
</ul>