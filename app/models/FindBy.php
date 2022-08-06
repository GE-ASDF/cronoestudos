<?php
namespace app\models;

use app\core\Model;
use PDO;

class FindBy extends Model{

    public function findBy($table, $field, $value){
        $sql = "SELECT * FROM {$table} WHERE {$field} = :{$field}";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(":".$field, $value);
        $prepare->execute();
        return $prepare->fetch(PDO::FETCH_OBJ);
    }

}