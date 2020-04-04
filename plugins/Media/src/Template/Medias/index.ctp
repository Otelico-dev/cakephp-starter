<?php

use Cake\Routing\Router; ?>
<div style="padding:10px;">
	<?= $this->Element('Media.file_upload_form') ?>

	<?= $this->Element('Media.file_upload_templates') ?>

	<?= $this->Element('Media.media_list') ?>
</div>

<?php $this->start('mediaScriptBottom'); ?>
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
				console.log('result', data.result.files[0]);

				console.log('ID #file_' + data.result.files[0].id);
				$('#file_' + data.result.files[0].id).css('display', 'none');
				var image = '<img src="' + data.result.files[0].media_list_url + '" />';
				console.log(image);

				var image_buttons = '<div class="container_images_controls">' +
					// '<p><small><?php echo __d('media', 'MSG_NO_IMAGE_CAPTION') ?></small></p>' +
					'<p class="btns_images_controls">' +
					'<a title="MSG_NO_IMAGE_CAPTION" rel="gallery" class="btn btn-info btn-sm show_image" href="' + data.result.files[0].url + '"><i class="glyphicon glyphicon-zoom-in"></i></a>&nbsp;' +
					// '<a title="Modify" class="btn btn-info btn-sm" href="' + data.result.files[0].edit_url + '"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;' +
					'<a title="Delete" class="btn btn-danger btn-sm delete_image" href="' + data.result.files[0].delete_url + '"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;' +
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
		$('body').on('click', '.delete_image', function() {
			var link = $(this);
			var href = link.attr('href');

			swal({
					title: '<?= __d('media', 'Suppression') ?>',
					text: '<?= __d('media', 'Etes-vous sur de vouloir supprimer cette image?') ?>',
					type: "warning",
					showCancelButton: true,

					confirmButtonText: '<?= __d('media', 'Supprimer') ?>',
					cancelButtonText: '<?= __d('media', 'Annuler') ?>'
				},
				function() {
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

						})
						.fail(function() {
							console.log("error");
						})
						.always(function() {
							console.log("complete");
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