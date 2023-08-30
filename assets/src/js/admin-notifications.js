document.addEventListener('DOMContentLoaded', () => {
    // alert('notifications');
})

jQuery(document).ready(function($) {
    const selectGlobalForm =  $('.select-global-form select');
    selectGlobalForm.on('focus', function(e) {
        $(this).parent().addClass('active');
    });
    selectGlobalForm.on('blur', function(e) {
        $(this).parent().removeClass('active');
    });
});