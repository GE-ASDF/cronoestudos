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

    public function create($dados){
        $sql = "INSERT INTO {$this->table}(";
        $sql.= implode(", ", array_keys($dados)) . ")";
        $sql.= " VALUES(";
        $sql.= ":". implode(", :", array_keys($dados)). ")";
        $prepare = $this->db->prepare($sql);
        foreach($dados as $key=>$dado){
            $prepare->bindValue(":".$key, $dado);
        }
        $cadastrado = $prepare->execute();
        return $cadastrado;
    }

    public function get(){
        
    }
}