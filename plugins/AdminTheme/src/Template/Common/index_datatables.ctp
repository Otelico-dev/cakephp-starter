<?= $this->fetch('before_index'); ?>

<h1><?= $this->fetch('title') ?></h1>

<?= $this->Element('AdminTheme.Tables/datatable') ?>

<?= $this->fetch('content') ?>