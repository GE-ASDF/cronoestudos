<?php
namespace app\models\Cidades;


use PDO;
use app\core\Model;

class Cidades extends Model{

    private $table = "cidades";

    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function findBy($field, $value, $criterio = "=", $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} {$criterio} :{$field}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute([$field => $value]);
        return $prepare->fetchAll(PDO::FETCH_OBJ);
    }

}