function resizeMain() {
    var navigation = $(".navigation").length === 0 ? 0 : $(".navigation").height() + parseInt($(".navigation").css('padding-top'));

    $("main").css('height', window.innerHeight - $('header').height() - navigation - 30);
}

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    $('[data-toggle="popover"]').popover();

    if(window.innerWidth <= 992) {
        var width = 3;

        $(".scrolled .nav-item").each(function(index, item) {
            width += parseInt($(item).width()) + parseInt($(item).css('padding-left')) + parseInt($(item).css('padding-right'));
        });

        $(".scrolled").css('width', width);
    } else {
        resizeMain();

        $(window).resize(resizeMain);
    }
});