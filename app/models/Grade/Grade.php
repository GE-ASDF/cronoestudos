<?php
namespace app\models\Grade;

use app\core\Model;
use PDO;

class Grade extends Model{

    private $table = "grade";

    public function create($dados){
        $sql = "INSERT INTO {$this->table}(";
        $sql.=implode(", ", array_keys($dados)) .") VALUES(";
        $sql.= ":" .implode(", :", array_keys($dados)).")";
        $prepare = $this->db->prepare($sql);
        foreach($dados as $key => $dado){
            $prepare->bindValue(":".$key, $dado);
        }
        $prepare->execute();
        return $this->db->lastInsertId();
    }

    public function findBy($field = [], $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE ";
        foreach($field as $key => $valor){
            $sql.=$key ."= :".$key . " AND ";
        }
        $sql = rtrim($sql , " AND ");
        $prepare = $this->db->prepare($sql);
        foreach($field as $key => $valor){
            $prepare->bindValue(":".$key, $valor);
        }
        $prepare->execute();
        return $prepare->fetch(PDO::FETCH_OBJ);
    }

    public function grade(){
        $sql = "SELECT * FROM {$this->table}, cursos, horarios, dias WHERE 
        {$this->table}.idusuario= :idusuario AND 
        {$this->table}.idcurso = cursos.idcurso AND
        {$this->table}.iddia = dias.iddia AND
        {$this->table}.idhorario = horarios.idhorario";
        $query = $this->db->prepare($sql);
        $query->bindValue(":idusuario", IDUSUARIO);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function delete($dados){
        $sql = "DELETE FROM {$this->table} WHERE ";
        foreach($dados as $key => $dado){
            $sql.= $key ."= :".$key ." AND ";
        }
        $sql = rtrim($sql, " AND ");
        $prepare = $this->db->prepare($sql);
        foreach($dados as $key => $dado){
            $prepare->bindValue(":".$key, $dado);
        }
        $prepare->execute();
        return $prepare->rowCount();
    }
}