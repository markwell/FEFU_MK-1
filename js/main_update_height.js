$(document).ready(function() {
    var StopHeight = 100;
    var resizeHeight = $('body').height()/6;
    var days;
    resizeHeight = resizeHeight > StopHeight ? resizeHeight : StopHeight;
    $('.calendar_day').css({'height':resizeHeight + 'px'});
    $(window).resize(function() {
        days = $('.calendar_day');
        resizeHeight = $('body').height()/6;
        resizeHeight = resizeHeight > StopHeight ? resizeHeight : StopHeight;
            days.css({'height':resizeHeight + 'px'},5000);
    });

    $('.form_container').bind('click',function(e) {
        $(this).css({
            'display': 'none'
        });
    });
    $('.create_event_show').bind('click',function(e) {
        $('.form_container').css({
            'display': 'block'
        });
    });
    $('#event_form').bind('click', function(e) {
        e.stopPropagation();
    })
});
