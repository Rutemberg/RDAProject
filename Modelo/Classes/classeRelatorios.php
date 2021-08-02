<?php

class classeRelatorios {

    private $idrelatorios;
    private $data;
    private $hora;
    private $wifi;
    private $notebooksfuncionando;
    private $outrosproblemas;
    private $mes;
    private $turno;
    private $idfuncionario;
    private $ano;

    function getAno() {
        return $this->ano;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }

    function getIdrelatorios() {
        return $this->idrelatorios;
    }

    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getWifi() {
        return $this->wifi;
    }

    function getNotebooksfuncionando() {
        return $this->notebooksfuncionando;
    }

    function getOutrosproblemas() {
        return $this->outrosproblemas;
    }

    function getMes() {
        return $this->mes;
    }

    function getTurno() {
        return $this->turno;
    }

    function getIdfuncionario() {
        return $this->idfuncionario;
    }

    function setIdrelatorios($idrelatorios) {
        $this->idrelatorios = $idrelatorios;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setWifi($wifi) {
        $this->wifi = $wifi;
    }

    function setNotebooksfuncionando($notebooksfuncionando) {
        $this->notebooksfuncionando = $notebooksfuncionando;
    }

    function setOutrosproblemas($outrosproblemas) {
        $this->outrosproblemas = $outrosproblemas;
    }

    function setMes($mes) {
        $this->mes = $mes;
    }

    function setTurno($turno) {
        $this->turno = $turno;
    }

    function setIdfuncionario($idfuncionario) {
        $this->idfuncionario = $idfuncionario;
    }

}
