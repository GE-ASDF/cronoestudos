<?php
namespace app\models;

use PDO;
use app\core\Model;

class Blog extends Model{

    public function selectAll(){
        $sql = "SELECT * FROM blog ORDER BY data_publicacao DESC";
        $prepare = $this->db->prepare($sql);
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_OBJ);
    }

    public function find($id){
        $sql = "SELECT * FROM blog WHERE id = :id";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue("id", $id);
        $prepare->execute();
        return $prepare->fetch(PDO::FETCH_OBJ);
    }

}