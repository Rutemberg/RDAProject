<?php

require_once 'conexao.php';

class classeRelatoriosDAO {

    private $ResultadoR;
    private $ResultadoS;
    private $ResultadoN;
    private $ResultadoRN;
    private $ResultadoRP;
    private $ResultadoCP;
    private $Numeroderelatorios;
    private $Ultimoid;
    private $ResultadolistarFULL;
    private $ResultadoDeletar;

    public function cadastrarRelatorio(classeRelatorios $novoRelatorio, $idfuncionariologado) {
        $pdo = conexao::getInstance();
        $sql = "INSERT INTO relatorios(`data`,hora,wifi,notebooksfuncionando,outrosproblemas,mes,turno,ano,idfuncionario) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $novoRelatorio->getData());
        $stmt->bindValue(2, $novoRelatorio->getHora());
        $stmt->bindValue(3, $novoRelatorio->getWifi());
        $stmt->bindValue(4, $novoRelatorio->getNotebooksfuncionando());
        $stmt->bindValue(5, $novoRelatorio->getOutrosproblemas());
        $stmt->bindValue(6, $novoRelatorio->getMes());
        $stmt->bindValue(7, $novoRelatorio->getTurno());
        $stmt->bindValue(8, $novoRelatorio->getAno());
        $stmt->bindValue(9, $idfuncionariologado);
        $stmt->execute();
        $this->Resultado = $stmt->rowCount();
        $this->Ultimoid = $pdo->lastInsertId();
        return $stmt;
    }

    public function cadastrarSalas($salasmontadas, $idfuncionariologado, $data, $ano, $mes) {
        $pdo = conexao::getInstance();
        $idrelatorio = $this->Ultimoid;
        $sql = "INSERT INTO salasmontadas(numerosala,idrelatorio,idfuncionario, datasm, anosm, messm) VALUES";
        foreach ($salasmontadas as $numerosala) {
            // Monta a parte consulta de cada usuário
            $sql .= " ('{$numerosala}', '$idrelatorio',$idfuncionariologado,'$data', $ano,'{$mes}'),";
        }
        $sql = substr($sql, 0, -1);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->ResultadoS = $stmt->rowCount();
        return $stmt;
    }

    public function cadastrarNotebooks($notebooks, $idfuncionariologado, $data, $ano, $mes) {
        $pdo = conexao::getInstance();
        $idrelatorio = $this->Ultimoid;
        $sql = "INSERT INTO notebooks(numeronotebook,idrelatorio,idfuncionario,datan,anon,mesn) VALUES";
        foreach ($notebooks as $numeronote) {
            // Monta a parte consulta de cada usuário
            $sql .= " ('{$numeronote}', '$idrelatorio',$idfuncionariologado,'$data', $ano,'{$mes}'),";
        }
        $sql = substr($sql, 0, -1);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->ResultadoN = $stmt->rowCount();
        return $stmt;
    }

    public function cadastrarProblema($problemasespecificos, $idfuncionariologado, $data, $ano, $mes) {
        $pdo = conexao::getInstance();
        $idrelatorio = $this->Ultimoid;
        $sql = "INSERT INTO problemas(problema,idrelatorio,idfuncionario,datap,anop,mesp) VALUES";
        foreach ($problemasespecificos as $problemas) {
            // Monta a parte consulta de cada usuário
            $sql .= " ('{$problemas}', '$idrelatorio',$idfuncionariologado, '$data', $ano,'{$mes}'),";
        }
        $sql = substr($sql, 0, -1);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->ResultadoCP = $stmt->rowCount();
        return $stmt;
    }

    public function alterarProblema($problemasespecificos, $idRelatorioAlterar, $idfuncionariologado, $dataalterar, $anoalterar, $mesalterar) {
        $pdo = conexao::getInstance();
        $sql = "INSERT INTO problemas(problema,idrelatorio,idfuncionario,datap,anop,mesp) VALUES";
        foreach ($problemasespecificos as $problemas) {
            // Monta a parte consulta de cada usuário
            $sql .= " ('{$problemas}', '$idRelatorioAlterar',$idfuncionariologado,'$dataalterar',$anoalterar,'{$mesalterar}'),";
        }
        $sql = substr($sql, 0, -1);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->ResultadoCP = $stmt->rowCount();
        return $stmt;
    }

    public function cadastrarRelatorio_Notebook($relatorio_notebook, $idfuncionariologado) {
        $pdo = conexao::getInstance();
        $idrelatorio = $this->Ultimoid;
        $sql = "INSERT INTO relatorio_notebook(relatorio,idrelatorio,idfuncionario) VALUES(?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $relatorio_notebook);
        $stmt->bindValue(2, $idrelatorio);
        $stmt->bindValue(3, $idfuncionariologado);
        $stmt->execute();
        $this->ResultadoRN = $stmt->rowCount();
        return $stmt;
    }

    public function cadastrarRelatorio_Problema($relatorio_problema, $idfuncionariologado) {
        $pdo = conexao::getInstance();
        $idrelatorio = $this->Ultimoid;
        $sql = "INSERT INTO relatorio_problema(relatoriop,idrelatorio,idfuncionario) VALUES(?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $relatorio_problema);
        $stmt->bindValue(2, $idrelatorio);
        $stmt->bindValue(3, $idfuncionariologado);
        $stmt->execute();
        $this->ResultadoRP = $stmt->rowCount();
        return $stmt;
    }

    public function alterarRelatorio_Problema($relatorio_problema, $idrelatorio, $idfuncionariologado) {
        $pdo = conexao::getInstance();
        $sql = "INSERT INTO relatorio_problema(relatoriop,idrelatorio,idfuncionario) VALUES(?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $relatorio_problema);
        $stmt->bindValue(2, $idrelatorio);
        $stmt->bindValue(3, $idfuncionariologado);
        $stmt->execute();
        return $stmt;
    }

    public function Linhasafetadas() {
        return $this->Resultado;
    }

    public function LinhasafetadasS() {
        return $this->ResultadoS;
    }

    public function LinhasafetadasN() {
        return $this->ResultadoN;
    }

    public function LinhasafetadasRN() {
        return $this->ResultadoRN;
    }

    public function LinhasafetadasRP() {
        return $this->ResultadoRP;
    }

    public function LinhasafetadasCP() {
        return $this->ResultadoCP;
    }

    public function verRelatorios($idfuncionariologado, $ordenarpor, $DESC_ASC_and_limite) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM relatorios WHERE idfuncionario = {$idfuncionariologado} ORDER BY $ordenarpor {$DESC_ASC_and_limite}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarRelatoriosPorID($idRelatorio, $ordenarpor, $DESC_ASC_and_limite = null) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM relatorios WHERE idrelatorios = {$idRelatorio} ORDER BY $ordenarpor {$DESC_ASC_and_limite}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarESPECIFIC($select, $nometabela, $ordenarpor, $DESC_ASC_and_limite = null, $WHEREnomeColuna = null, $ResultWHEREnomeColuna = null) {
        $pdo = conexao::getInstance();
        $sql = "SELECT $select FROM $nometabela $WHEREnomeColuna $ResultWHEREnomeColuna ORDER BY $ordenarpor {$DESC_ASC_and_limite}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarRelatoriosFULL($idfuncionariologado, $ordenarpor, $DESC_ASC_and_limite = null) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM relatorios WHERE idfuncionario = {$idfuncionariologado} ORDER BY $ordenarpor {$DESC_ASC_and_limite}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->Numeroderelatorios = $stmt->rowCount();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarTodososRelatorios($ordenarpor, $DESC_ASC_and_limite = null) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM relatorios ORDER BY $ordenarpor {$DESC_ASC_and_limite}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->Numeroderelatorios = $stmt->rowCount();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarDistinct($coluna, $tabela, $ordenarpor, $DESC_ASC_and_limite = null, $WHERE_nomecoluna_igual = null, $Valornomecoluna = null, $and_nomecoluna_igual = null, $Valor_andnomecoluna = null, $and_nomecoluna_igual2 = null, $Valor_andnomecoluna2 = null) {
        $pdo = conexao::getInstance();
        $sql = "SELECT DISTINCT $coluna FROM $tabela $WHERE_nomecoluna_igual $Valornomecoluna $and_nomecoluna_igual $Valor_andnomecoluna $and_nomecoluna_igual2 $Valor_andnomecoluna2 ORDER BY $ordenarpor {$DESC_ASC_and_limite}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->Numeroderelatorios = $stmt->rowCount();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarDistinct2($coluna, $tabela, $whereColuna, $valorwhereColuna, $andColuna, $valorandColuna, $ordenarpor, $DESC_ASC_and_limite = null) {
        $pdo = conexao::getInstance();
        $sql = "SELECT DISTINCT $coluna FROM $tabela WHERE $whereColuna = '$valorwhereColuna' AND $andColuna = '$valorandColuna' ORDER BY $ordenarpor $DESC_ASC_and_limite";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->Numeroderelatorios = $stmt->rowCount();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarTodososRelatoriosData($data, $ordenarpor, $DESC_ASC_and_limite = null) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM relatorios WHERE data = '$data' ORDER BY $ordenarpor {$DESC_ASC_and_limite}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function resultadolistarRelatoriosFULL() {
        return $this->Numeroderelatorios;
    }

    public function listarsalasFULL($idrelatorio) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM salasmontadas WHERE idrelatorio = {$idrelatorio}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarrelatorionotebookFULL($idrelatorio) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM relatorio_notebook WHERE idrelatorio = {$idrelatorio}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarnotebookFULL($idrelatorio) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM notebooks WHERE idrelatorio = {$idrelatorio}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarFULL($nome_tabela, $idrelatorio) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM {$nome_tabela} WHERE idrelatorio = {$idrelatorio}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->ResultadolistarFULL = $stmt->rowCount();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function resultadolistarFULL() {
        return $this->ResultadolistarFULL;
    }

    public function COUNT($nome_tabela, $nomecoluna, $valornomecoluna) {
        $pdo = conexao::getInstance();
        $sql = "SELECT COUNT(*) FROM $nome_tabela WHERE $nomecoluna = $valornomecoluna";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetch();
        return $Resultado;
    }

    public function COUNT2($nome_tabela, $nomecoluna, $valornomecoluna, $AND_nomecoluna_Igual = null, $valorcolunaAnd = null) {
        $pdo = conexao::getInstance();
        $sql = "SELECT COUNT(*) FROM $nome_tabela WHERE $nomecoluna = $valornomecoluna $AND_nomecoluna_Igual $valorcolunaAnd";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetch();
        return $Resultado;
    }

    public function listarproblemaFULL($idrelatorio) {
        $pdo = conexao::getInstance();
        $sql = "SELECT * FROM relatorio_problema WHERE idrelatorio = {$idrelatorio}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function listarRegistrosRepetidos($coluna, $tabela, $DESC, $WHERE_nome_da_coluna_igual = null, $valorcoluna = null, $AND_valor_da_coluna_igual = null, $valorcoluna2 = null, $LIMIT = null) {
        $pdo = conexao::getInstance();
        $sql = "SELECT $coluna, COUNT( * ) qntd FROM $tabela $WHERE_nome_da_coluna_igual $valorcoluna $AND_valor_da_coluna_igual $valorcoluna2
GROUP BY $coluna
ORDER BY qntd {$DESC} {$LIMIT}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Resultado;
    }

    public function alterarColunaRelatorio($nometabela, $nomecoluna, $novovalor, $idrelatorio) {
        $pdo = conexao::getInstance();
        $sql = "UPDATE {$nometabela} SET {$nomecoluna} = '{$novovalor}' WHERE idrelatorios = {$idrelatorio}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function alterarColuna($nometabela, $nomecoluna, $novovalor, $identificador, $idrelatorio) {
        $pdo = conexao::getInstance();
        $sql = "UPDATE {$nometabela} SET {$nomecoluna} = '{$novovalor}' WHERE $identificador = {$idrelatorio}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function alterarSalas($salasmontadas, $idrelatorio, $idfuncionariologado, $dataalterar, $anoalterar, $mesalterar) {
        $pdo = conexao::getInstance();
        $sql = "INSERT INTO salasmontadas(numerosala,idrelatorio,idfuncionario,datasm,anosm,messm) VALUES";
        foreach ($salasmontadas as $numerosala) {
            // Monta a parte consulta de cada usuário
            $sql .= " ('{$numerosala}', '$idrelatorio',$idfuncionariologado,'$dataalterar',$anoalterar,'{$mesalterar}'),";
        }
        $sql = substr($sql, 0, -1);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function alterarNotebooks($notebooks, $idrelatorio, $idfuncionariologado, $dataalterar, $anoalterar, $mesalterar) {
        $pdo = conexao::getInstance();
        $sql = "INSERT INTO notebooks(numeronotebook,idrelatorio,idfuncionario,datan,anon,mesn) VALUES";
        foreach ($notebooks as $numeronote) {
            // Monta a parte consulta de cada usuário
            $sql .= " ('{$numeronote}', '$idrelatorio',$idfuncionariologado,'$dataalterar',$anoalterar,'{$mesalterar}'),";
        }
        $sql = substr($sql, 0, -1);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->Resultadoalterarnotebooks = $stmt->rowCount();
        return $stmt;
    }

    public function resultadoAlterarNotebooks() {
        return $this->Resultadoalterarnotebooks;
    }

    public function deletar($nome_tabela, $idrelatorio, $nomecampoID = null) {
        $pdo = conexao::getInstance();
        $sql = "DELETE FROM {$nome_tabela} WHERE idrelatorio = {$idrelatorio}";
        if (!empty($nomecampoID)) {
            $sql = "DELETE FROM {$nome_tabela} WHERE $nomecampoID = {$idrelatorio}";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $this->ResultadoDeletar = $stmt->rowCount();
        return $stmt;
    }

    public function resultadoDeletar() {
        return $this->ResultadoDeletar;
    }

}
