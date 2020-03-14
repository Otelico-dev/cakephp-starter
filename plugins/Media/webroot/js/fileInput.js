$(document).ready(function () {

    $('.delete-media').hover(
        function () {
            $(this).find('span').css('opacity', 1);
        },
        function () {
            $(this).find('span').css('opacity', 0);
        }
    );

    $('.delete-media').click(function () {

        var link = $(this),
            confirmation_text = link.data('confirmation_text');

        if (confirm(confirmation_text)) {

            $.ajax({
                    url: link.attr('href'),
                })
                .done(function (data) {

                    data = $.parseJSON(data);
                    if (data.status == 'success') {
                        $('.media__img_preview').fadeOut();
                    }

                });

        }

        return false;

    });

});
