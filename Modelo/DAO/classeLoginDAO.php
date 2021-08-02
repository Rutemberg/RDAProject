<?php

session_start();

require_once 'conexao.php';

class classeLoginDAO {

    public function fazerLogin($tag, $pin) { //valores definidos para o login
        try {
            $pdo = conexao::getInstance(); //PDO, comunicação com o BD relacional, padronização na comunicação.
            $sql = "SELECT tag,picture,perfil,idusuario,campus FROM usuarios
                    WHERE tag = ? AND pin = ?"; //SELECT FROM WERE recupera registros especificos de uma tabela.
            $stmt = $pdo->prepare($sql); //SQL Linquagem que administra acesso ao BD
            $stmt->bindValue(1, $tag);
            $stmt->bindValue(2, $pin);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario != NULL) {
                $_SESSION['UsuarioLogado'] =  1;
                $_SESSION['TagUsuarioLogado'] = $usuario['tag'];
                $_SESSION['PerfilUsuarLologado'] = $usuario['perfil'];
                $_SESSION['PictureUsuarLologado'] = $usuario['picture'];
                $_SESSION['IdUsuarioLogado'] = $usuario['idusuario'];
                $_SESSION['CampusUsuarioLogado'] = $usuario['campus'];
                return $usuario;
            } 
        } catch (Exception $ex) {
            echo "erro" . $exc->getMessage();
        }
    }

    public function fazerLogout() {
        try {
            unset($_SESSION['UsuarioLogado']);
            unset($_SESSION['TagUsuarioLogado']);
            unset($_SESSION['PerfilUsuarLologado']);
            unset($_SESSION['PictureUsuarLologado']);
            unset($_SESSION['IdUsuarLologado']);
            session_destroy();
            header("location:../index.php");
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
