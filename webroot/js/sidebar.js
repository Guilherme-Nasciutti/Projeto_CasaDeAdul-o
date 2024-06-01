$(document).ready(function() {
    const $hamburguer = $('#expand');
    const $sidebar = $('.sidebar');
    const $toolbar = $('.toolbar');
    const $container = $('.container_main');

    $hamburguer.on('click', function() {
        $sidebar.toggleClass('hide_sidebar');
        $toolbar.toggleClass('toolbar_full');
        $container.toggleClass('container_full');
    });
});
