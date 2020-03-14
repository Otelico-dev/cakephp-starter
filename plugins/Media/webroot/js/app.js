// $(document).ready(function() {
	
// 	/**
// 	 * Delete images from gallery
// 	 */
// 	$('.delete_image').click(function() {
// 		var link = $(this);
// 		var href= link.attr('href');
// 		var image = link.data('image');

// 		swal({
// 		  title: "Suppression",
// 		  text: 'Etes-vous sur de vouloir supprimer cette image?',
// 		  type: "warning",
// 		  showCancelButton: true,
// 		  confirmButtonColor: "#E50000",
// 		  confirmButtonText: "Supprimer",
// 		  cancelButtonText: "Annuler"
// 		},
// 		function(){
// 		    $.ajax({
// 		    	url: href			
// 		    })
// 		    .done(function() {
// 		    	link.remove();
// 		    	$('#'+image).fadeOut('fast', function() {

// 		    		$('#'+image).remove();
// 		    	});
// 		    })
// 		    .fail(function() {
// 		    	console.log("error");
// 		    })
// 		    .always(function() {
// 		    	console.log("complete");
// 		    });
// 		});

		
		
// 		return false;
// 	});
// });