$(document).ready(function() {
                          //id sesuaiin kebutuhan
    $(document).on('click', '#see_password_old', function() {
        if ($(this).data('is_password')) {
            $(this).parent().find('input[type=password]').attr('type', 'text');
            $(this).data('is_password', false)
        } else {
            $(this).parent().find('input[type=text]').attr('type', 'password');
            $(this).data('is_password', true)
        }
    })
});