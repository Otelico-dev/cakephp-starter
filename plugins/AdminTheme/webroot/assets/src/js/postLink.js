$('body').on('click', '[data-post_link_delete]', function () {

    let link = $(this),
        form_name = link.data('form_name'),
        confirm_message = link.data('confirm_message');

    Swal.fire({
        title: 'Vous êtes sur?',
        text: confirm_message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.value) {
            $('form[name=' + form_name + ']').submit();
        }
    });

    return false;

});
