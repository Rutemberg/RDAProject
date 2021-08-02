<?php

require_once 'conexao.php';
//
//$valores = $_POST['salasmontadas'];
//var_dump($valores);
//$num = 001;
//try {
//    $pdo = conexao::getInstance();
//    $sql = "INSERT INTO tabela(numero,idrelatorio) VALUES";
//    foreach ($valores as $numerosala) {
//        // Monta a parte consulta de cada usuário
//        $sql .= " ('{$numerosala}', '$num'),";
//    }
//    $sql = substr($sql, 0, -1);
//    $stmt = $pdo->prepare($sql);
//    $stmt->execute();
//    echo $stmt->rowCount();
//} catch (PDOException $exc) {
//    echo $exc->getMessage();
//}
//
//
//PROCURAR REGISTROS REPETIDOS
try {
    $pdo = conexao::getInstance();
    $sql = "SELECT numero, COUNT( * ) n FROM Tabela
GROUP BY numero
ORDER BY n DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $n = $stmt->fetchAll();
//    var_dump($n);
    extract($n);
    foreach ($n as $values):
        extract($values);
        echo "Nome:{$numero}<br>visualizaçoes:{$n}<hr>";
    endforeach;
} catch (PDOException $exc) {
    echo $exc->getMessage();
}


$array1 = array(10, 10, 80, 80, 80);
$rs = array_unique( array_diff_assoc( $array1, array_unique( $array1 ) ) );
$arra = implode("/", $rs);
$arra2 = explode("/", $arra);
var_dump($arra2);


//SELECT CLI, COUNT( * ) n FROM Tabela
//GROUP BY CLI
//ORDER BY n DESC 
//LIMIT 5

//SELECT problema, COUNT( * ) n FROM problemas
//WHERE problema LIKE '%hard%'
//GROUP BY problema
//ORDER BY n DESC