<?php
namespace app\models\Blog;

use PDO;
use app\core\Model;

class Blog extends Model{

    private $table = "blog";

    public function findAll(){
        $sql = "SELECT * FROM {$this->table} ORDER BY data_publicacao DESC";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function findBy($field, $value){
        $sql = "SELECT * FROM {$this->table} WHERE {$field}= :{$field}";
        $query = $this->db->prepare($sql);
        $query->execute([
            $field => $value,
        ]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function create($dados){
        $sql = "INSERT INTO {$this->table}(";
        $sql.= implode(", ", array_keys($dados)) . ")";
        $sql.= " VALUES(";
        $sql.= ":". implode(", :", array_keys($dados)). ")";
        $prepare = $this->db->prepare($sql);
        
        foreach($dados as $key=>$dado){
            if($key == "data_publicacao"){
                $dado.= date(" H:i:s");
            }
            $prepare->bindValue(":".$key, $dado);
        }

        $cadastrado = $prepare->execute();
        return $cadastrado;
    }

}