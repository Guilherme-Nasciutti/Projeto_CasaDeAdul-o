$(document).ready(function () {
    let status = false;

    $('.check_all').click(function () {
        status = !status;
        chekcboxControl(status);
    });

    function chekcboxControl(status) {
        $('.guests input:checkbox').each(function () {
            $(this).prop('checked', status);
        });
    }
});
