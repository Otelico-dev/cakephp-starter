<div class="card">
	<div class="card-header" id="<?= $card['header_id'];  ?>">
		<h2 class="mb-0">
			<button class="btn btn-link <?php if (!$is_first_iteration) echo  'collapsed'; ?>" type="button" data-toggle="collapse" data-target="#<?= $card['id'];  ?>" aria-expanded="true" aria-controls="<?= $card['id'];  ?>">
				<?= $card['header']; ?>
			</button>
		</h2>
	</div>

	<div id="<?= $card['id'];  ?>" class="collapse <?php if ($is_first_iteration) echo  'show'; ?>" aria-labelledby="<?= $card['header_id'];  ?>" data-parent="#accordion-<?= $accordion['id'];  ?>">
		<div class="card-body">
			<?= $card['body']; ?>
		</div>
	</div>
</div>