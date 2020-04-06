<div class="accordion" id="accordion-languages">
	<?php foreach ($accepted_languages as $language_code => $language) : ?>

		<?php
		$is_first_iteration = ($language === reset($accepted_languages));
		?>
		<div class="card">
			<div class="card-header" id="heading-<?= $language_code; ?>">
				<h2 class="mb-0">
					<button class="btn btn-link <?php if (!$is_first_iteration) echo  'collapsed'; ?>" type="button" data-toggle="collapse" data-target="#collapse-<?= $language_code; ?>" aria-expanded="true" aria-controls="collapse-<?= $language_code; ?>">
						<?= __d('admin', 'Contenu en'); ?> <?= $language['name']; ?>
					</button>
				</h2>
			</div>

			<div id="collapse-<?= $language_code; ?>" class="collapse <?php if ($is_first_iteration) echo  'show'; ?>" aria-labelledby="heading-<?= $language_code; ?>" data-parent="#accordion-languages">
				<div class="card-body">

					<?php
					foreach ($inputs as $input) {
						echo $this->Form->control('_translations.' . $language['locale'] . '.' . $input['name'], [
							'label' => $input['label']
						]);

						if (isset($input['rich_text'])) {
							$this->Html->scriptStart(['block' => true]);
							echo $this->CkEditor->getJavascript('_translations.' . $language['locale'] . '.' . $input['name']);
							$this->Html->scriptEnd();
						}
					}
					?>

				</div>
			</div>

		</div>
	<?php endforeach; ?>
</div>