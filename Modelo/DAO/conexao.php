<?php

abstract class conexao {
    function __construct() {        
    }
    public static function getInstance() {
        try {
            $pdo = new PDO("mysql:host=localhost; dbname=rdadatabase", "root", "", array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            )
                    );
            return $pdo;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
