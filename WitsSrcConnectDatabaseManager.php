<?php

require_once("Constants.php");
require_once("ServerInfo.php");

class WitsSrcConnectDatabaseManager {
    private $pdo;

    function __construct() {
        $dbName = ServerInfo::database;
        $host = ServerInfo::serverProxy;
        $userName = ServerInfo::userName;
        $userPass = ServerInfo::userPassword;

        $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this -> pdo = new PDO($dsn, $userName, $userPass, $options);
        }
        catch (PDOException $e) {
            echo $e -> getMessage();
        }
    }

    function executeFetchStatement($stmt, $args){
        try{
            $execStmt = $this -> pdo -> prepare($stmt, $args);
            if ($execStmt -> execute($args)) echo json_encode($execStmt -> fetchAll());
            else echo Constants::DEFAULT_JSON;

        }
        catch (PDOException $e){
            echo Constants::DEFAULT_JSON;
        }
    }

    function executeStatement($stmt, $args){
        try{
            $execStmt = $this -> pdo -> prepare($stmt);

            if($execStmt -> execute($args)) echo Constants::SUCCESS;
            else echo Constants::FAILED;
        }
        catch(PDOException $e){
            echo $e -> getMessage();
        }
    }

    function exists($stmt, $args){
        try{
            $execStmt = $this -> pdo -> prepare($stmt);
            if($execStmt -> execute($args)) return $execStmt -> rowCount() > 0;
            else return false;
        }
        catch(PDOException $e){
            echo $e -> getMessage();
            return false;
        }

    }
}