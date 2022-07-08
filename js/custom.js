// Trigger Pagetop
var triggerPageTop = function() {
    var $pageTop = $('.js-pageTop');
    if ($(this).scrollTop() > 200) {
        $pageTop.addClass('active');
    } else {
        $pageTop.removeClass('active');
    }
}  

// Animation scroll to top
var clickPageTop = function() {
    var $pageTop = $('.js-pageTop');
    $pageTop.click(function(e) {
        $('html,body').animate({ scrollTop: 0 }, 300);
    });
}


$(function(){
    triggerPageTop();
    clickPageTop();

    $(window).scroll(function() {
        triggerPageTop();
    });
});