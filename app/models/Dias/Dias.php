<?php
namespace app\models\Dias;

use PDO;
use app\core\Model;

class Dias extends Model{

    private $table = "dias";
    
    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_OBJ);
    }

}