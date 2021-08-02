function Data(str) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ajaxfiltros").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "../Controlador/FiltroRelatorios.php?ano=" + str, true);
    xmlhttp.send();
    data = str;
}
function Mes(str2) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ajaxfiltros").innerHTML = this.responseText;
        }
    };
    if (typeof data == 'undefined') {
        data = 0;
    }
    xmlhttp.open("GET", "../Controlador/FiltroRelatorios.php?ano=" + data + "&mes=" + str2, true);
    xmlhttp.send();
    mes = str2;
}
function dia(str3) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ajaxfiltros").innerHTML = this.responseText;
        }
    };
    if (typeof data == 'undefined') {
        data = 0;
    }
    if (typeof mes == 'undefined') {
        mes = 0;
    }
    xmlhttp.open("GET", "../Controlador/FiltroRelatorios.php?ano=" + data + "&mes=" + mes + "&dia=" + str3, true);
    xmlhttp.send();
}

function viewreport(value) {
    $("#visualizarrelatorio").velocity('stop');
    $("#visualizarrelatorio").velocity('transition.slideRightIn');
//    alert(value);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("visualizarrelatorio").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "../Controlador/visualizarRelatorio.php?idRelatorio=" + value, true);
    xmlhttp.send();
}

function estatisticaano(ano) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("problemas_mes").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "../Controlador/EstatisticaAjax/EstatisticasMes.php?ano=" + ano, true);
    xmlhttp.send();
}
function estatisticames(mes,ano) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("Estatisticas").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "../Controlador/EstatisticaAjax/EstatisticasInformacoes.php?mes=" + mes + "&ano=" + ano, true);
    xmlhttp.send();
}