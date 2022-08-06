<?php
namespace app\models\Estados;

use PDO;
use app\core\Model;

class Estados extends Model{

    private $table = "estados";

    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}