<?= $this->cell('Media.Uploads', [$foreign_key, $model]) ?>

<?php

$file_upload_css = [
	'/media/js/jQuery-File-Upload/css/jquery.fileupload',
	'/media/js/jQuery-File-Upload/css/jquery.fileupload-ui',
	'/media/css/app.css',
];
$this->Html->css($file_upload_css, ['block' => true]);

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
	// '/media/js/bootstrap-sweetalert/dist/sweetalert.min',
	'/media/js/jquery-sortable/source/js/jquery-sortable-min',
	'/media/js/jquery-dragster/jquery.dragster'
	// '/media/js/app.js',

];
$this->Html->script($file_upload_scripts, ['block' => true]);
?>

<?php $this->start('scriptBottom'); ?>
<script>
	$(function() {
		'use strict';

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': <?= json_encode($this->request->param('_csrfToken')) ?>
			}
		});

		$('#fileupload').fileupload({
				// Uncomment the following to send cross-domain cookies:
				//xhrFields: {withCredentials: true},
				url: '/media/medias/upload?model=<?= $model ?>&foreign_key=<?= $foreign_key ?>',
				formData: [{}],
				dataType: 'json',
				autoUpload: false,
				dropZone: $('#dropzone'),
				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
				maxFileSize: 8000000, // 8 MB
				maxNumberOfFiles: 30,
				messages: {
					maxNumberOfFiles: 'Le nombre de fichers permis a été dépassé',
					acceptFileTypes: 'Ce type de fichier n\'est pas permis',
					maxFileSize: 'Le fichier est trop lourd',
					minFileSize: 'Le fichier est trop petit'
				},
				// Enable image resizing, except for Android and Opera,
				// which actually support image resizing, but fail to
				// send Blob objects via XHR requests:
				disableImageResize: /Android(?!.*Chrome)|Opera/
					.test(window.navigator.userAgent),
				previewMaxWidth: 100,
				previewMaxHeight: 100,
				previewCrop: true,
				processdone: function(e, data) {
					console.log(data.files[data.index]);
				}
			})
			.bind('fileuploaddone', function(e, data) {

				$('#file_' + data.result.files[0].id).css('display', 'none');
				var image = '<img src="' + data.result.files[0].media_list_url + '" />';

				var image_buttons = '<div class="container_images_controls">' +

					'<p class="btns_images_controls">' +
					'<a title="MSG_NO_IMAGE_CAPTION" class="btn btn-info btn-sm " href="' + data.result.files[0].url + '"><i class="fa fa-eye"></i></a>&nbsp;' +

					'<a title="Delete" class="btn btn-danger btn-sm delete_image" href="' + data.result.files[0].delete_url + '"><i class="fa fa-trash"></i></a>&nbsp;' +
					'</p>' +
					'</div>';

				$('<li / > ')
					.html(image + image_buttons)
					.attr('data-id', data.result.files[0].id)
					.appendTo('.media_gallery');

			});


		/**
		 * Delete images from gallery
		 */
		$('body').on('click', '.delete_image', function(e) {

			e.preventDefault();

			var link = $(this);
			var href = link.attr('href');

			Swal.fire({
				title: '<?= __d('media', 'Suppression') ?>',
				text: '<?= __d('media', 'Etes-vous sur de vouloir supprimer cette image?') ?>',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Oui, supprimer!',
				cancelButtonText: 'Annuler'
			}).then((result) => {
				$.ajax({
						url: href
					})
					.done(function(response) {
						response = $.parseJSON(response);
						console.log(response);
						if (response.status == 'success') {
							link.parents('li').fadeOut('fast', function() {

								link.parents('li').remove();
							});
						}

					});
			});



			return false;
		});

		var adjustment;
		var group = $('.media_gallery').sortable({
			group: 'serialization',

			// set $item relative to cursor position
			onDragStart: function($item, container, _super) {
				var offset = $item.offset(),
					pointer = container.rootGroup.pointer;

				adjustment = {
					left: pointer.left - offset.left,
					top: pointer.top - offset.top
				};


				_super($item, container);
			},
			onDrag: function($item, position) {
				$('.placeholder').css({
					'width': $item.outerWidth() + 'px',
					'height': $item.outerHeight() + 'px'
				});
				$item.css({
					left: position.left - adjustment.left,
					top: position.top - adjustment.top
				});
			},


			onDrop: function($item, container, _super, event) {
				var order = group.sortable("serialize").get();
				$.ajax({
					url: '/media/medias/order',
					type: 'POST',
					data: {
						model: '<?= $model ?>',
						foreign_key: <?= $foreign_key ?>,
						order: order[0]
					}
				});
				console.log(order[0]);
				_super($item, container);
			}
		});





		$('#dropzone').dragster({
			enter: function(dragsterEvent, event) {
				$(this).addClass('dragenter');
			},
			leave: function(dragsterEvent, event) {
				$(this).removeClass('dragenter');
			},
			drop: function(dragsterEvent, event) {
				$(this).removeClass('dragenter');
			}
		});

	});
</script>
<?php $this->end(); ?>