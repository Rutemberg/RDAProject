// Contador de segundos
function Contador(tempo, id, relatorio = null) {

    var seconds = 0;

    var counter = document.getElementById(id);

    if (relatorio === 1) {
        function increment() {
            if (seconds < tempo) {
                counter.innerHTML = ++seconds;
            }
        }
    } else {
        function increment() {
            if (seconds < tempo) {
                counter.innerHTML = '<b>' + ++seconds + '</b>' + '<b>%</b>';
            }
        }
    }


    var run = setInterval(increment, 50);

}
function progress(altura, idele) {

    var elem = document.getElementById(idele);
    var height = 0;
    var id = setInterval(frame, 50);
    function frame() {
        if (height >= altura) {
            clearInterval(id);
        } else {
            height++;
            elem.style.height = height + '%';
        }
    }
}
function progressH(largura, idele) {

    var elem = document.getElementById(idele);
    var width = 0;
    var id = setInterval(frame, 50);
    function frame() {
        if (width >= largura) {
            clearInterval(id);
        } else {
            width++;
            elem.style.width = width + '%';
        }
    }
}

function abrir(id,link) {
    document.getElementById(id).src = link;
}