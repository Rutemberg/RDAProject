$(document).ready(function () {

//mouseover cards
    $('.relatorio').mouseover(function () {
        var animationSequence = [
            {e: $(".Img_relatorioFundo img"), p: {scale: "1.1"}, o: {duration: 100, easing: "easeInOutQuart"}}];
        $.Velocity.RunSequence(animationSequence);
        var animationSequence1 = [
            {e: $(".Img_usuarioFundo img"), p: {opacity: ".5"}, o: {duration: 100, easing: "easeInOutQuart"}}];
        $.Velocity.RunSequence(animationSequence1);

    });
    $('.relatorio').mouseleave(function () {
        var animationSequence1 = [
            {e: $(".Img_relatorioFundo img"), p: {scale: "1"}, o: {duration: 100, easing: "easeInOutQuart"}}];
        $.Velocity.RunSequence(animationSequence1);
        var animationSequence2 = [
            {e: $(".Img_usuarioFundo img"), p: {opacity: "1"}, o: {duration: 100, easing: "easeInOutQuart"}}];
        $.Velocity.RunSequence(animationSequence2);
    });





    $('.usuario').mouseover(function () {
        var animationSequence2 = [
            {e: $(".Img_usuarioFundo img"), p: {scale: "1.1"}, o: {duration: 100, easing: "easeInOutQuart"}}];
        $.Velocity.RunSequence(animationSequence2);
        var animationSequence1 = [
            {e: $(".Img_relatorioFundo img"), p: {opacity: "0.5"}, o: {duration: 100, easing: "easeInOutQuart"}}];
        $.Velocity.RunSequence(animationSequence1);
    });
    $('.usuario').mouseleave(function () {
        var animationSequence3 = [
            {e: $(".Img_usuarioFundo img"), p: {scale: "1"}, o: {duration: 100, easing: "easeInOutQuart"}}];
        $.Velocity.RunSequence(animationSequence3);
        var animationSequence2 = [
            {e: $(".Img_relatorioFundo img"), p: {opacity: "1"}, o: {duration: 100, easing: "easeInOutQuart"}}];
        $.Velocity.RunSequence(animationSequence2);
    });
//mouseover cards

});
$(document).ready(function () {

    $(".background_relatorio").velocity({scale: "1.1"}, {duration: 15000, easing: "easeOutQuad", loop: true}).velocity("reverse");

});

function voltar() {
    window.location.href = "Home.php";
}
function redirectionform(endereco) {
    window.location.href = endereco;
}
function redirection(endereco) {
    window.location.href = endereco;
}



