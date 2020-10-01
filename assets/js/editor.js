import $ from "jquery";
import bsCustomFileInput from "bs-custom-file-input";

$(document).ready(function() {
    var $wrapper = $('.js-tag-wrapper');

    $wrapper.on('click', '.js-remove-tag', function(e) {
        e.preventDefault();

        $(this).closest('.js-tag-item')
            .fadeOut()
            .remove();
    });

    $wrapper.on('click', '.js-tag-add', function(e) {
        e.preventDefault();

        // Get the data-prototype explained earlier
        var prototype = $wrapper.data('prototype');

        // get the new index
        var index = $wrapper.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $wrapper.data('index', index + 1);

        // Display the form in the page before the "new" link
        $(this).before(newForm);
    });
});

$(document).ready(function () {
    bsCustomFileInput.init()
})

// Handling the modal confirmation message.
$(document).on('submit', 'form[data-confirmation]', function (event) {
    var $form = $(this),
        $confirm = $('#confirmationModal');

    if ($confirm.data('result') !== 'yes') {
        //cancel submit event
        event.preventDefault();

        $confirm
            .off('click', '#btnYes')
            .on('click', '#btnYes', function () {
                $confirm.data('result', 'yes');
                $form.find('input[type="submit"]').attr('disabled', 'disabled');
                $form.submit();
            })
            .modal('show');
    }
});
