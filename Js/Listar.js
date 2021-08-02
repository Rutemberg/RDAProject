$(document).ready(function () {
//    $("#vrelatorio").addClass("bloquear");
});


$(document).ready(function () {

    $('.habilitarediçao').mouseover(function () {
        $(".habilitarediçao").velocity('stop');
        $(".habilitarediçao").velocity({width: "300px"}, {duration: 300, easing: "easeOutQuad"});
    });
    $('.habilitarediçao').mouseleave(function () {
        $(".habilitarediçao").velocity('stop');
        $(".habilitarediçao").velocity({width: "250px"}, {duration: 300, easing: "easeOutQuad"});
    });
});

function habilitarEdicao() {
    $("#vrelatorio").removeClass("bloquear");
    $(".habilitarediçao_button").velocity('transition.fadeOut', 500);
    $(".habilitarediçao_buttonsair").velocity('transition.fadeIn', 500);
    $(".vrelatorio_data,.vhora,.vwifi,.vrelatorio_salas,.vnotes,.vproblema").velocity({opacity: ".4"}, {duration: 300, easing: "easeOutQuad"});
    $(".adicionarproblema").delay(500).velocity('transition.slideRightBigIn', 500);

}
function sairEdicao() {
    $("#vrelatorio").addClass("bloquear");
    $(".habilitarediçao_button").velocity('transition.fadeIn', 500);
    $(".habilitarediçao_buttonsair").velocity('transition.fadeOut', 500);
    $(".vrelatorio_data,.vhora,.vwifi,.vrelatorio_salas,.vnotes,.vproblema").velocity({opacity: "1"}, {duration: 300, easing: "easeOutQuad"});
    $(".adicionarproblema").delay(500).velocity('transition.slideRightBigOut', 500);

}
//function editar(classe) {
//    $("." + classe).velocity('stop');
//    $("." + classe).velocity({
//        // Can't use rgb, hsla, and color keywords
//        "borderColor": "#000000",
//        "borderColorAlpha": .2
//    }, 500);
//}
//function editarleave(classe) {
//    $("." + classe).velocity('stop');
//    $("." + classe).velocity({
//        // Can't use rgb, hsla, and color keywords
//        "borderColor": "#000000",
//        "borderColorAlpha": 0
//    }, 500);
//}
function animaçaoformsaida(classe) {
    $("." + classe).velocity('transition.slideLeftOut', 500);
}

function animaçaoformalterar(classe) {
    $(document).ready(function () {
        $("." + classe).velocity('transition.fadeIn', 1000);
        $(".corpo_formalterar_top p").delay(1000).velocity('transition.slideLeftBigIn', 2000);
        $(".corpo_formalterar_bottom hr").delay(1000).velocity('transition.slideRightBigIn', 2000);
        $(".corpoformalterarcarousel").delay(1000).velocity('transition.slideRightIn', 1000);
        $(".botaofecharalterar").delay(1000).velocity('transition.fadeIn', 1000);
    });
}
function animaçaoformalterarfechar(classe, class2) {
    $(document).ready(function () {
        $("." + classe).velocity('transition.fadeOut', 1000);
        $(".corpoformalterarcarousel, .corpo_formalterar_top p, .corpo_formalterar_bottom hr, .botaofecharalterar").delay(1000).velocity('transition.fadeOut', 300);
        $("." + class2).delay(2000).velocity('transition.slideLeftIn', 500);
    });
}
function animaçaoformalterarfechar2(classe, class1, class2, class3) {
    $(document).ready(function () {
        $("." + classe).velocity('transition.fadeOut', 1000);
        $(".corpoformalterarcarousel, .corpo_formalterar_top p, .corpo_formalterar_bottom hr, .botaofecharalterar").delay(1000).velocity('transition.fadeOut', 300);
        $("." + class1 + ", ." + class2 + ", ." + class3).delay(2000).velocity('transition.slideLeftIn', 500);
    });
}

$(document).ready(function () {

    $('.csscheckboxnote').click(function () {
        document.getElementById("botaoprosseguirnotebookproblema").style.display = "block";
    });

    $('.simN').click(function () {
        document.getElementById('textareanote').value = "Notebooks funcionando corretamente";
    });
    $('.naoN').click(function () {
        setTimeout(function () {

            document.getElementById("form_problema").style.display = "block";
            document.getElementById("form_notebookproblema").style.display = "block";
            document.getElementById("form_relateproblema").style.display = "block";

        }, 500);
    });

    $('.simP').click(function () {
        setTimeout(function () {
            document.getElementById("form_informarproblema").style.display = "block";
        }, 500);
    });


});

//function animacaoEdit() {
//    $("#relatorio").removeClass("bloquear");
//    $(".verrelatorio").velocity({
//        // Can't use rgb, hsla, and color keywords
//        "borderColor": "#984B43",
//        "borderColorAlpha": 1
//    }, 1000);
//    document.getElementById("corpoedit").style.display = "block";
//    document.getElementById("editback").style.display = "block";
//    $("#corpoedit").addClass("Bounce");
//
//}
;
function animacaoEditback() {
    $("#relatorio").addClass("bloquear");
    $(".verrelatorio").velocity({
        // Can't use rgb, hsla, and color keywords
        "borderColor": "#ffffff",
        "borderColorAlpha": 1
    }, 1000);
    document.getElementById("corpoedit").style.display = "none";
    document.getElementById("editback").style.display = "none";
    $("#corpoedit").removeClass("Bounce");
    $("#corpoedit").addClass("animacaocomsombra");
}
;
function excluirRelatorio() {
    $(document).ready(function () {
    $(".backexlcuir").velocity('transition.fadeIn', 500);
    $(".backexlcuir_top p").delay(1000).velocity('transition.slideLeftBigIn', 2000);
    $(".backexlcuir_bottom hr").delay(1000).velocity('transition.slideRightBigIn', 2000);
    $(".backexcluir_corpo_img img").delay(1000).velocity('transition.slideRightIn', 1000);
    $(".backexcluir_corpo_corpo_top").delay(1000).velocity('transition.slideLeftIn', 1000);
    $(".backexcluir_corpo_corpo_mensagem").delay(1500).velocity('transition.slideLeftIn', {stagger: 300});
    $(".botaofecharexcluir").delay(1000).velocity('transition.fadeIn', 1000);
});
}
function fecharexcluirRelatorio() {
    $(document).ready(function () {
    $(".backexlcuir").velocity('transition.fadeOut', 500);
    $(".backexlcuir_top p,.backexlcuir_bottom hr,.backexcluir_corpo_img img,.backexcluir_corpo_corpo_top,.backexcluir_corpo_corpo_mensagem,.botaofecharexcluir").delay(500).velocity('transition.fadeOut', 500);
});
}