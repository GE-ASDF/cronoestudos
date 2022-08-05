<?php
namespace app\models\Aulas;

use PDO;
use app\core\Model;

class Aulas extends Model{

    private $table = "aulas";

    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function findBy($field, $value, $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} = :{$field}";
        $query = $this->db->prepare($sql);
        $query->execute([
            $field => $value,
        ]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}