<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>

<head>
	<?= $this->Html->charset() ?>
	<title>
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->css('/admin_theme/assets/dist/css/app') ?>
</head>

<body class="body--error">
	<div class="container-error">
		<h1 class="text-center"><?= __d('error', 'Quelque chose a mal tourné'); ?></h1>
		<div id="content">
			<?= $this->Flash->render() ?>

			<?= $this->fetch('content') ?>
		</div>
		<div id="footer">
			<p class="text-center">
				<?= $this->Html->link(__d('error', 'Retour'), 'javascript:history.back()', ['class' => 'btn btn-lg btn-primary']) ?>
			</p>

		</div>
	</div>
</body>

</html>