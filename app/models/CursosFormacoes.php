<?php
namespace app\models;

use app\core\Model;
use app\models\database\Connection;

class CursosFormacoes extends Model{
    public function cursosFormacoes($idformacao){
        $sql = "SELECT * FROM cursos WHERE idformacao = :idformacao";
        $conn = Connection::connect();
        $query = $conn->prepare($sql);
        $query->bindValue(":idformacao", $idformacao);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}