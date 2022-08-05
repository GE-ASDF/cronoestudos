<?php
namespace app\models\Professores;

use PDO;
use app\core\Model;

class Professores extends Model{

    private $table = "professores";

    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}