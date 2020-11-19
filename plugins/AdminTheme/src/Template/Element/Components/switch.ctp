<?php

if (empty($toggle_name)) {
	$toggle_name = 'toggle';
}
if (empty($on_text)) {
	$on_text = __d('admin', 'Oui');
}

if (empty($off_text)) {
	$off_text = __d('admin', 'Non');
}

if (empty($size)) {
	$size = 'sm';
}
?>

<input type="checkbox" data-target="<?= $target ?>" data-toggle="<?= $toggle_name; ?>" data-on="<?= $on_text; ?>" data-off="<?= $off_text; ?>" data-size="<?= $size; ?>" id="<?= $id; ?>" <?php if ($checked) echo 'checked'; ?> />