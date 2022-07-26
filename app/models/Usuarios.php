<?php
namespace app\models;

use PDOException;
use app\models\database\Connection;

class Usuarios{

    public function insert($nome, $sobrenome, $email, $senha){
        $sql = "INSERT INTO usuarios(nome, sobrenome, email, senha)
        VALUES(:nome, :sobrenome, :email, :senha)";
        try{
            $conn = Connection::connect();
            $prepare = $conn->prepare($sql);
            $prepare->bindValue(":nome", $nome);
            $prepare->bindValue(":sobrenome", $sobrenome);
            $prepare->bindValue(":email", $email);
            $prepare->bindValue(":senha", $senha);
            return $prepare->execute();
        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }

}