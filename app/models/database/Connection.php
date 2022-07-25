<?php
namespace app\models\database;

use PDO;
use PDOException;

class Connection{

    private static $pdo = null;
    
    public static function connect(){

        try{

            if(static::$pdo === null){
                static::$pdo = new PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA, [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ]);
            }
            return static::$pdo;

        }catch(PDOException $e){
            var_dump($e->getMessage());
        }

    }

}