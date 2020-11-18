<?php

$default_options = [
	'escape' => false,
	'class' => 'btn btn-success btn-lg',
];

if (empty($url)) {
	$url = ['action' => 'add'];
}

if (!empty($options)) {

	if (!empty($options['class'])) {
		$options['class'] = $default_options['class'] . ' ' . $options['class'];
	}

	$default_options = array_merge($default_options, $options);
}
?>

<?=
	$this->Html->link(
		'<i class="fa fa-plus"></i> ' . $text,
		$url,
		$default_options
	);
?>