$(document).ready(function () {

    $("#popup").velocity('transition.slideRightIn', 1000);
    $(".popup img, .sucess, .view, .fail").delay(1000).velocity('transition.slideRightIn', 1000);
    $(".popup .mensagensfailcadastro, .mensagenssucesscadastro").delay(1500).velocity('transition.slideRightIn', {stagger: 300});

    setTimeout(function () {
        $(".popup .mensagensfailcadastro, .mensagenssucesscadastro").velocity('transition.slideRightOut', {stagger: 300});
        $(".popup img, .sucess, .view, .fail").delay(2100).velocity('transition.slideRightOut', 500);
        $(".closepopup").delay(2600).velocity('transition.slideRightOut', {stagger: 300});
    }, 10000);



});


$(document).ready(function () {

    $(".backmensagem").velocity('transition.fadeIn', 500);
    $(".mensagem_top p").delay(1000).velocity('transition.slideLeftBigIn', 2000);
    $(".mensagem_bottom hr").delay(1000).velocity('transition.slideRightBigIn', 2000);
    $("#mensagem_corpo_img img, #mensagem_corpo_img p").delay(1000).velocity('transition.slideRightIn', 1000);
    $(".mensagem_corpo_corpo_top").delay(1000).velocity('transition.slideLeftIn', 1000);
    $(".mensagem_corpo_corpo_mensagens").delay(1500).velocity('transition.slideLeftIn', {stagger: 300});
    $(".botaofechar").delay(1000).velocity('transition.fadeIn', 1000);
});

function fecharmensagem() {
    $(".backmensagem").velocity('transition.fadeOut', 500);
}

