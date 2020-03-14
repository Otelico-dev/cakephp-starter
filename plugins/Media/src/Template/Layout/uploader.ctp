<!DOCTYPE html>
<html>
    <head>
        <title>Uploader</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.css'); ?>
        <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.1/jquery.fancybox.min.css'); ?>
        <?= $this->Html->css('/media/js/jQuery-File-Upload/css/jquery.fileupload'); ?>
        <?= $this->Html->css('/media/js/jQuery-File-Upload/css/jquery.fileupload-ui'); ?>
        <?= $this->Html->css('/media/js/bootstrap-sweetalert/dist/sweetalert.css'); ?>
        <?= $this->Html->css('/media/css/app.css'); ?>
    </head>
    <body>

	   <?= $this->Flash->render('Auth')?>
	   <?= $this->Flash->render()?>

       <?= $this->fetch('content'); ?>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.1/jquery.fancybox.min.js"></script>
        <?php

        $file_upload_scripts = [
            '/media/js/jQuery-File-Upload/js/vendor/jquery.ui.widget',
            '/media/js/jQuery-File-Upload/js/tmpl.min',
            '/media/js/jQuery-File-Upload/js/load-image.all.min',
            '/media/js/jQuery-File-Upload/js/canvas-to-blob.min',
            '/media/js/jQuery-File-Upload/js/jquery.iframe-transport',
            '/media/js/jQuery-File-Upload/js/jquery.fileupload',
            '/media/js/jQuery-File-Upload/js/jquery.fileupload-process',
            '/media/js/jQuery-File-Upload/js/jquery.fileupload-image',
            '/media/js/jQuery-File-Upload/js/jquery.fileupload-audio',
            '/media/js/jQuery-File-Upload/js/jquery.fileupload-video',
            '/media/js/jQuery-File-Upload/js/jquery.fileupload-validate',
            '/media/js/jQuery-File-Upload/js/jquery.fileupload-ui',
            '/media/js/bootstrap-sweetalert/dist/sweetalert.min',
            '/media/js/jquery-sortable/source/js/jquery-sortable-min',
            '/media/js/jquery-dragster/jquery.dragster'
            // '/media/js/app.js',

            ];
        echo $this->Html->script($file_upload_scripts);
         ?>
        <!-- The main application script -->
         <!-- <script src="/media/js/jQuery-File-Upload/js/main.js"></script>  -->
        <?= $this->fetch('script'); ?>
    	<?= $this->fetch('mediaScriptBottom'); ?>

    </body>
</html>
