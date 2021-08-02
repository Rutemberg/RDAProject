$(document).ready(function () {
$(".submit").focus();
});
function ValidaFormulario() {


    index = 0;

    if (document.getElementById('nome').value == "") {
        $(".nome").focus();
        index++
        return false;

    }
    if (document.getElementById('pin').value == "") {
        $(".pin").focus();
        index++
        return false;

    }
    
    return true


}
