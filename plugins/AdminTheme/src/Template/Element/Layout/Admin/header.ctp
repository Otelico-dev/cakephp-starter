<div class="header__brand">
	<?php if (!empty($domain_parameters['admin_logo'])) : ?>
		<?= $this->Html->image('/assets/dist/img/' . $domain_parameters['admin_logo']) ?>
	<?php endif; ?>

</div>

<div class="header__navigation">
	<ul>
		<li>
			<?=
				$this->Html->link(
					__d('admin', 'Configuration'),
					[
						'controller' => 'configuration',
						'action' => 'index'
					]
				)
			?>
		</li>
		<li>
			<?=
				$this->Html->link(
					__d('admin', 'Adhérents'),
					[
						'controller' => 'members',
						'action' => 'index'
					]
				)
			?>
		</li>
		<li>
			<?=
				$this->Html->link(
					__d('admin', 'Newsletters'),
					[
						'controller' => 'newsletters',
						'action' => 'index'
					]
				)
			?>
		</li>
	</ul>
</div>

<div class="header__signout">
	<?=
		$this->Html->link(
			'<i class="fa fa-sign-out" aria-hidden="true" title="' .	__d('admin', 'Déconnexion') . '"></i>',
			'/logout',
			[
				'escape' => false,
			]
		)
	?>

</div>