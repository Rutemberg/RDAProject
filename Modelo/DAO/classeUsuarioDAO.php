<?php

require_once 'conexao.php';

class classeUsuarioDAO {

//    private $ResultadoR;
//    private $ResultadoS;
//    private $ResultadoN;
//    private $ResultadoRN;
//    private $ResultadoRP;
//    private $Ultimoid;
//
//    public function cadastrarRelatorio(classeRelatorios $novoRelatorio, $idfuncionariologado) {
//        $pdo = conexao::getInstance();
//        $sql = "INSERT INTO relatorios(`data`,hora,wifi,notebooksfuncionando,outrosproblemas,mes,turno,idfuncionario) VALUES(?,?,?,?,?,?,?,?)";
//        $stmt = $pdo->prepare($sql);
//        $stmt->bindValue(1, $novoRelatorio->getData());
//        $stmt->bindValue(2, $novoRelatorio->getHora());
//        $stmt->bindValue(3, $novoRelatorio->getWifi());
//        $stmt->bindValue(4, $novoRelatorio->getNotebooksfuncionando());
//        $stmt->bindValue(5, $novoRelatorio->getOutrosproblemas());
//        $stmt->bindValue(6, $novoRelatorio->getMes());
//        $stmt->bindValue(7, $novoRelatorio->getTurno());
//        $stmt->bindValue(8, $idfuncionariologado);
//        $stmt->execute();
//        $this->Resultado = $stmt->rowCount();
//        $this->Ultimoid = $pdo->lastInsertId();
//        return $stmt;
//    }
//
//    public function cadastrarSalas($salasmontadas, $idfuncionariologado) {
//        $pdo = conexao::getInstance();
//        $idrelatorio = $this->Ultimoid;
//        $sql = "INSERT INTO salasmontadas(numerosala,idrelatorio,idfuncionario) VALUES";
//        foreach ($salasmontadas as $numerosala) {
//            // Monta a parte consulta de cada usuário
//            $sql .= " ('{$numerosala}', '$idrelatorio',$idfuncionariologado),";
//        }
//        $sql = substr($sql, 0, -1);
//        $stmt = $pdo->prepare($sql);
//        $stmt->execute();
//        $this->ResultadoS = $stmt->rowCount();
//        return $stmt;
//    }
//
//    public function cadastrarNotebooks($notebooks, $idfuncionariologado) {
//        $pdo = conexao::getInstance();
//        $idrelatorio = $this->Ultimoid;
//        $sql = "INSERT INTO notebooks(numeronotebook,idrelatorio,idfuncionario) VALUES";
//        foreach ($notebooks as $numeronote) {
//            // Monta a parte consulta de cada usuário
//            $sql .= " ('{$numeronote}', '$idrelatorio',$idfuncionariologado),";
//        }
//        $sql = substr($sql, 0, -1);
//        $stmt = $pdo->prepare($sql);
//        $stmt->execute();
//        $this->ResultadoN = $stmt->rowCount();
//        return $stmt;
//    }
//
//    public function cadastrarRelatorio_Notebook($relatorio_notebook, $idfuncionariologado) {
//        $pdo = conexao::getInstance();
//        $idrelatorio = $this->Ultimoid;
//        $sql = "INSERT INTO relatorio_notebook(relatorio,idrelatorio,idfuncionario) VALUES(?,?,?)";
//        $stmt = $pdo->prepare($sql);
//        $stmt->bindValue(1, $relatorio_notebook);
//        $stmt->bindValue(2, $idrelatorio);
//        $stmt->bindValue(3, $idfuncionariologado);
//        $stmt->execute();
//        $this->ResultadoRN = $stmt->rowCount();
//        return $stmt;
//    }
//
//    public function cadastrarRelatorio_Problema($relatorio_problema, $idfuncionariologado) {
//        $pdo = conexao::getInstance();
//        $idrelatorio = $this->Ultimoid;
//        $sql = "INSERT INTO relatorio_problema(realtoriop,idrelatorio,idfuncionario) VALUES(?,?,?)";
//        $stmt = $pdo->prepare($sql);
//        $stmt->bindValue(1, $relatorio_problema);
//        $stmt->bindValue(2, $idrelatorio);
//        $stmt->bindValue(3, $idfuncionariologado);
//        $stmt->execute();
//        $this->ResultadoRP = $stmt->rowCount();
//        return $stmt;
//    }
//
//    public function Linhasafetadas() {
//        return $this->Resultado;
//    }
//
//    public function LinhasafetadasS() {
//        return $this->ResultadoS;
//    }
//
//    public function LinhasafetadasN() {
//        return $this->ResultadoN;
//    }
//
//    public function LinhasafetadasRN() {
//        return $this->ResultadoRN;
//    }
//
//    public function LinhasafetadasRP() {
//        return $this->ResultadoRP;
//    }

    public function listarUsuarioFULL($idusuario, $ordenarpor, $DESC_ASC_and_limite) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM usuarios WHERE idusuario = {$idusuario} ORDER BY $ordenarpor {$DESC_ASC_and_limite}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }
    public function listarUsuario($select, $idusuario, $ordenarpor, $DESC_ASC_and_limite) {
        $pdo = conexao::getInstance();
        $sql = "SELECT {$select} FROM usuarios WHERE idusuario = {$idusuario} ORDER BY $ordenarpor {$DESC_ASC_and_limite}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

}
