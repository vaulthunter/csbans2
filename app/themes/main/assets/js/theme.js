$(document).ready(function(){
    $(document).on('click', '[data-popup-toggle]', function(event) {
        event.preventDefault();
        var selector = $(this).data('popup-toggle');
        var popupModal = $(selector);
        console.log(popupModal);
        popupModal.toggle();
    });
});