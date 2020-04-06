<div class="tab-content">

	<?php foreach ($tab_panes as $key => $pane) : ?>

		<?php

		reset($tab_panes);

		$is_first_iteration = $key === key($tab_panes)

		?>
		<?=
			$this->Element('AdminTheme.Components/Tabs/tabs_pane', [
				'id' => $pane['id'],
				'content' => $pane['content'],
				'is_active' => $is_first_iteration
			])
		?>
	<?php endforeach; ?>

</div>