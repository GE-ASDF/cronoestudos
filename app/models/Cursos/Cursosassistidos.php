<?php
namespace app\models\Cursos;

use app\core\Model;
use PDO;

class Cursosassistidos extends Model{

    protected $table = "cursos_assistidos";

    public function findBy($field, $value, $criterio = "=", $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} {$criterio} :{$field}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute([$field => $value]);
        return $prepare->fetchAll(PDO::FETCH_OBJ);
    }

}