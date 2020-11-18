<?php
$default_options = [
	'escape' => false,
	'class' => '',
	'data-fancybox' => true,
	'data-src' => $src,
	'data-options' => htmlspecialchars(json_encode([
		'arrows' => false,
		'touch' => false,
		'infobar' => false,
		'loop' => false
	]), ENT_QUOTES, 'UTF-8')
];

if (!empty($options)) {
	$default_options = array_merge($default_options, $options);
}

?>

<?=
	$this->Html->link(
		$text,
		'javascipt:;',
		$default_options
	)
?>