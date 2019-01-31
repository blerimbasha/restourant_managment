$(document).ready(function () {
    let modalId = $('#image-gallery');

    $('.select2').select2();
    tinymce.init({
        selector:'textarea',
        height: 300
    })

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
        $('#show-previous-image, #show-next-image')
            .show();
        if (counter_max === counter_current) {
            $('#show-next-image')
                .hide();
        } else if (counter_current === 1) {
            $('#show-previous-image')
                .hide();
        }
    }

    function loadGallery(setIDs, setClickAttr) {
        let current_image,
            selector,
            counter = 0;

        $('#show-next-image, #show-previous-image')
            .click(function () {
                if ($(this)
                    .attr('id') === 'show-previous-image') {
                    current_image--;
                } else {
                    current_image++;
                }

                selector = $('[data-image-id="' + current_image + '"]');
                updateGallery(selector);
            });

        function updateGallery(selector) {
            let $sel = selector;
            current_image = $sel.data('image-id');
            $('#image-gallery-title')
                .text($sel.data('title'));
            $('#image-gallery-image')
                .attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }

        if (setIDs == true) {
            $('[data-image-id]')
                .each(function () {
                    counter++;
                    $(this)
                        .attr('data-image-id', counter);
                });
        }
        $(setClickAttr)
            .on('click', function () {
                updateGallery($(this));
            });
    }

});

