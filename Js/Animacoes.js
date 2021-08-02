$(document).ready(function () {
    $('.picuser').click(function () {
        $(".user_texts").velocity('transition.slideLeftIn', 200);
    });
    $('.user').mouseleave(function () {
        $(".user_texts").velocity('transition.slideRightOut', 200);
    });
});