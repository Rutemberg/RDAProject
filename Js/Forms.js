//function ValidaRelatorio() {
//    if (document.getElementById('data').value == "") {
//        return false;
//    }
//    if (document.getElementById('hora').value == "") {
//        return false;
//    }
//    if (document.getElementById('salasmontadas').checked == false) {
//        return false;
//    }
//    if (document.getElementById('notebookfuncionando').checked == false) {
//        return false;
//    }
//    if (document.getElementById('salasmontadas').checked == false) {
//        return false;
//    }
//
//    return true;
//}

$(document).ready(function () {

    $('.csscheckbox').click(function () {
        document.getElementById("botaoprosseguirsalas").style.display = "block";
    });

    $('.csscheckboxnote').click(function () {
        document.getElementById("botaoprosseguirnotebookproblema").style.display = "block";
    });
    $('.especificar').click(function () {
        document.getElementById("botaoprosseguirespecificarproblema").style.display = "block";
    });

    $('.simN').click(function () {
        document.getElementById("form_notebookproblema").style.display = "none";
        document.getElementById("form_Especificarproblema").style.display = "none";
        document.getElementById("form_relateproblema").style.display = "none";
        document.getElementById('textareanote').value = "Notebooks funcionando corretamente";

    });
    $('.naoP').click(function () {
        document.getElementById("form_relatealgumoutroproblema").style.display = "none";
    });


});





$(document).ready(function () {
    $(".background_relatorio").velocity({scale: "1.1"}, {duration: 15000, easing: "easeOutQuad", loop: true}).velocity("reverse");
});



function animaçaoform(classe) {
    $("." + classe).velocity('transition.slideLeftOut', 500);
}


//checkbox em radio
$(document).ready(function () {

    $(".radio").on('click', function () {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
});
function checkAll(o,classe) {
    var boxes = document.getElementsByClassName(classe);
    for (var x = 0; x < boxes.length; x++) {
        var obj = boxes[x];
        if (obj.type == "checkbox") {
            if (obj.name != "check")
                obj.checked = o.checked;
        }
    }
}
