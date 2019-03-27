<?php

require_once("Constants.php");
require_once("ServerInfo.php");

class WitsSrcConnectDatabaseManager {
    private $pdo;

    function __construct() {
        $this -> pdo = new PDO('mysql:dbname='.ServerInfo::database.';host='.ServerInfo::serverProxy.';charset=utf8',
            ServerInfo::userName, ServerInfo::userPassword);
        $this -> pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this -> pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            echo Constants::FAILED;
        }
    }

    function exists($stmt, $args){
        try{
            $execStmt = $this -> pdo -> prepare($stmt);

            if($execStmt -> execute($args)) return $execStmt -> rowCount() > 0;
            else return false;
        }
        catch(PDOException $e){
            return false;
        }

    }
}