<div class="accordion" id="accordion-<?= $accordion['id']; ?>">
	<?php foreach ($accordion['cards'] as $card) : ?>

		<?php
		$is_first_iteration = ($card === reset($accordion['cards']));
		?>
		<?=

			$this->Element(
				'AdminTheme.Components/Accordions/accordion_card',
				[
					'accordion' => $accordion,
					'card' => $card,
					'is_first_iteration' => $is_first_iteration
				]
			);

		?>
	<?php endforeach; ?>

</div>