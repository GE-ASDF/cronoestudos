<?php
namespace app\models\Cursos;

use app\core\Model;
use PDO;

class Cursos extends Model{

    protected $table = "cursos";

    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    

    public function findBy($field, $value, $criterio = "=", $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} {$criterio} :{$field}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute([$field => $value]);
        return $prepare->fetch(PDO::FETCH_OBJ);
    }

    public function ativo($field, $value, $parameter = "="){
        $situacao = $this->findBy($field, $value, "=");
        $atualizado = false;

        if($situacao->situacao == 0){
            $sql = "UPDATE {$this->table} SET 
            situacao = 1 WHERE
            {$field} {$parameter} :{$field}";
            $prepare = $this->db->prepare($sql);
            $prepare->execute([
                $field=>$value,
            ]);
            $atualizado = $prepare->execute();
        }else{
            $sql = "UPDATE {$this->table} SET 
            situacao = 0 WHERE
            {$field} {$parameter} :{$field}";
            $prepare = $this->db->prepare($sql);
            $prepare->execute([
            $field=>$value,
            ]);
            $atualizado = $prepare->execute();
        }
        
        return $atualizado;
    }
}