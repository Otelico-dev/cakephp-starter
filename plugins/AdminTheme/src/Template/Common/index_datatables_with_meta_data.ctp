<?= $this->fetch('before_index'); ?>

<h1><?= $this->fetch('title') ?></h1>

<?=

	$this->Element('AdminTheme.Components/Tabs/tabs_navigation', [
		'nav_items' => [
			[
				'id' => 'index',
				'label' =>  $this->fetch('title')
			],
			[
				'id' => 'metadata_content',
				'label' => __d('admin', 'Titre et intro')
			],
			[
				'id' => 'metadata_meta',
				'label' => __d('admin', 'Metadonnées')
			]
		]
	]);
?>

<?=

	$this->Element('AdminTheme.Components/Tabs/tabs_content', [
		'tab_panes' => [
			[
				'id' => 'index',
				'content' => $this->Element('AdminTheme.Tables/datatable')
			],
			[
				'id' => 'metadata_content',
				'content' => $this->Element('AdminTheme.MetaData/form_content')
			],
			[
				'id' => 'metadata_meta',
				'content' => $this->Element('AdminTheme.MetaData/form_meta_data')
			]
		]
	]);

?>

<?= $this->fetch('content') ?>