<?=

	$this->Element('AdminTheme.Components/Tabs/tabs_navigation', [
		'nav_items' => [
			[
				'id' => 'details',
				'label' => __d('admin', 'Détails de la page')
			],
			[
				'id' => 'images',
				'label' => __d('admin', 'Images de la page')
			],
			[
				'id' => 'meta',
				'label' => __d('admin', 'Métadonnées')
			]
		]
	]);
?>

<?=

	$this->Element('AdminTheme.Components/Tabs/tabs_content', [
		'tab_panes' => [
			[
				'id' => 'details',
				'content' => $this->Element('../Admin/Pages/formPages')
			],
			[
				'id' => 'images',
				'content' => $this->Element('../Admin/Pages/images')
			],
			[
				'id' => 'meta',
				'content' => $this->Element(
					'AdminTheme.MetaData/form_meta_data',
					[
						'action' => 'index',
						'identifier' => $page->id,
						'redirect_url' => [
							'controller' => 'Pages',
							'action' => 'edit',
							$page->id
						]
					]
				)
			]
		]
	]);

?>