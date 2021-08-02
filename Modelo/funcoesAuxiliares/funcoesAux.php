<?php

function mesData($data) {
    $m = explode("-", $data);
    switch ($m[1]) {
        case "01": $mes = "Janeiro";
            break;
        case "02": $mes = "Fevereiro";
            break;
        case "03": $mes = "Março";
            break;
        case "04": $mes = "Abril";
            break;
        case "05": $mes = "Maio";
            break;
        case "06": $mes = "Junho";
            break;
        case "07": $mes = "Julho";
            break;
        case "08": $mes = "Agosto";
            break;
        case "09": $mes = "Setembro";
            break;
        case "10": $mes = "Outubro";
            break;
        case "11": $mes = "Novembro";
            break;
        case "12": $mes = "Dezembro";
            break;
    }
    return $mes;
}

function convertMesEmNumero($mes) {
    $mes = ucfirst(strtolower($mes));
    switch ($mes) {
        case "Janeiro": $mes = "01";
            break;
        case "Fevereiro": $mes = "02";
            break;
        case "Março": $mes = "03";
            break;
        case "Abril": $mes = "04";
            break;
        case "Maio": $mes = "05";
            break;
        case "Junho": $mes = "06";
            break;
        case "Julho": $mes = "07";
            break;
        case "Agosto": $mes = "08";
            break;
        case "Setembro": $mes = "09";
            break;
        case "Outubro": $mes = "10";
            break;
        case "Novembro": $mes = "11";
            break;
        case "Dezembro": $mes = "12";
            break;
    }
    return $mes;
}

function turno($hora) {
    $t = explode(":", $hora);

    if ($t[0] >= 01 && $t[0] <= 12) {
        $turno = "matutino";
    }
    if ($t[0] >= 13 && $t[0] <= 17) {
        $turno = "vespertino";
    }
    if ($t[0] >= 18 && $t[0] <= 24) {
        $turno = "noturno";
    }

    return $turno;
}

function calculardata($data, $dataatual) {
    $d = explode("-", $data);
    $d2 = explode("-", $dataatual);

    $calculo = $d2[2] - $d[2];
    if ($calculo < 0) {
        $calculo = $calculo + 31;
    }
    if ($calculo == 0) {
        $result = 'Hoje';
    }
    if ($calculo == 1) {
        $result = 'Ontem';
    }
    if ($calculo > 1) {
        $result = $calculo;
    }

    return $result;
}

function calcularporcentagem($qntd, $TOTAL) {
    $calcular = ($qntd / $TOTAL) * 100;
    $altura = round($calcular, 0);
    return $altura;
}
