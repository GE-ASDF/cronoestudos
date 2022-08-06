<?php
namespace app\models\Usuarios;

use PDO;
use app\core\Model;
use stdClass;

class Usuarios extends Model{
 
    protected $table = "usuarios";

    public function all($fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_OBJ);
    }

    public function findBy($field, $value, $criterio = "=", $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} {$criterio} :{$field}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute([$field => $value]);
        return $prepare->fetch(PDO::FETCH_OBJ);
    }

    public function create($dados){
        $sql = "INSERT INTO {$this->table}(";
        $sql.= implode(", ", array_keys($dados)) . ")";
        $sql.= " VALUES(";
        $sql.= ":". implode(", :", array_keys($dados)). ")";
        $prepare = $this->db->prepare($sql);
        foreach($dados as $key=>$dado){
            if($key == "senha"){
                $dado = password_hash($dado, PASSWORD_DEFAULT);
            }
            $prepare->bindValue(":".$key, $dado);
        }
        $cadastrado = $prepare->execute();
        return $cadastrado;
    }

    public function colaborador($field, $value, $parameter = "="){
        $colaborador = $this->findBy($field, $value, "=");

        $atualizado = false;

        if($colaborador->colaborador == 0){
            $sql = "UPDATE {$this->table} SET 
            colaborador = 1 WHERE
            {$field} {$parameter} :{$field}";
            $prepare = $this->db->prepare($sql);
            $prepare->execute([
                $field=>$value,
            ]);
            $atualizado = $prepare->execute();
        }else{
            $sql = "UPDATE {$this->table} SET 
            colaborador = 0 WHERE
            {$field} {$parameter} :{$field}";
            $prepare = $this->db->prepare($sql);
            $prepare->execute([
            $field=>$value,
            ]);
            $atualizado = $prepare->execute();
        }
        
        return $atualizado;
    }

    public function update($dados, $field, $value){

        $sql = "UPDATE {$this->table} SET " ;
        
        foreach($dados as $key => $valor){
            $sql.= $key ." =:".$key .", "; 
        }
        $sql=rtrim($sql, ", ");
        $sql.=" WHERE {$field} = :{$field}";
        $prepare = $this->db->prepare($sql);
        foreach($dados as $key=> $valor){
            if(!str_contains($key, "idusuario")){
                $prepare->bindValue(":".$key, $valor);
            }
        }
        $prepare->bindValue(":".$field, $value);
        return $prepare->execute();        
    }

}