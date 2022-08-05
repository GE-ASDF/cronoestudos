<?php
namespace app\models\Matriculas;

use app\core\Model;
use PDO;

class Matriculas extends Model{

    private $table = "usuarios_cursos";

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

    public function findBy($validado){
        $sql = "SELECT * FROM {$this->table} WHERE ";

        foreach($validado as $key=>$valor){
            $sql.= $key ."= " .":".$key ." AND ";
        }

        $sql = rtrim($sql, " AND ");
        $prepare  = $this->db->prepare($sql);

        foreach($validado as $chave => $valor){
            $prepare->bindValue(":".$chave, $valor);
        }

        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_OBJ);        
        // return $rs;
    }

    public function findTeste($idusuario, $idcurso){
        $sql = "SELECT * FROM {$this->table} WHERE idusuario= :idusuario AND idcurso= :idcurso";
        $prepare  = $this->db->prepare($sql);
        $prepare->bindValue(":idusuario", $idusuario);
        $prepare->bindValue(":idcurso", $idcurso);
        $prepare->execute();
        return $prepare->fetch(PDO::FETCH_OBJ);   
    }
    public function delete($dados){
        $sql = "DELETE FROM {$this->table} WHERE ";
        foreach($dados as $key => $valor){
            $sql.= $key  ."= :" .$key . " AND ";
        }
        $sql = rtrim($sql, " AND ");
        $prepare = $this->db->prepare($sql);
        foreach($dados as $key => $valor){
            $prepare->bindValue(":".$key, $valor);
        }
        $deletado = $prepare->execute();
        return $deletado;
    }
}