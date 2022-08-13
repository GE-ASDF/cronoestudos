<?php
namespace app\models\Horarios;

use PDO;
use app\core\Model;
use app\models\Dias\Dias;

class Horarios extends Model{

    private $table = "horarios";

    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_OBJ);
    }

    public function findBy($field, $value, $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} = :{$field}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute([
            $field=>$value,
        ]);
        return $prepare->fetchAll(PDO::FETCH_OBJ);
    }

    public function findBy2($field, $value, $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} = :{$field}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute([
            $field=>$value,
        ]);
        return $prepare->fetch(PDO::FETCH_OBJ);
    }

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

    public function delete($dados){
        $sql = "DELETE FROM {$this->table} WHERE ";
        foreach($dados as $key => $dado){
            $sql.= $key ."= :".$key .", ";
        }
        $sql = rtrim($sql, ", ");
        $prepare = $this->db->prepare($sql);
        foreach($dados as $key => $dado){
            $prepare->bindValue(":".$key, $dado);
        }
        $prepare->execute();
        return $prepare->rowCount();
    }
    public function teste(){
        $dias = (new Dias)->findAll();
        $lista = array();
        foreach($dias as $key => $dia){
            $horarios = $this->findBy("idusuario", IDUSUARIO);
            foreach($horarios as $horario){
                $lista[] = ([
                    "iddia"=>$dia->iddia,
                    "dia"=>$dia->dia,
                    "idhorario"=>$horario->idhorario,
                    "horario"=>$horario->horario,
                ]);
            } 
        }
        return $lista;   
    }
}