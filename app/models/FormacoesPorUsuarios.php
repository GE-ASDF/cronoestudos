<?php
namespace app\models;

use app\core\Model;
use app\models\database\Connection;

class FormacoesPorUsuarios extends Model{
    public function formacoesPorUsuarios($idformacao, $idusuario){
        $sql = "SELECT * FROM usuarios_formacoes WHERE idformacao = :idformacao AND idusuario= :idusuario";
        $conn = Connection::connect();
        $query = $conn->prepare($sql);
        $query->bindValue(":idformacao", $idformacao);
        $query->bindValue(":idusuario", $idusuario);
        $query->execute();
        return $query->fetchAll();
    }
}