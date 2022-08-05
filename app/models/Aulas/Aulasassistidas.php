<?php
namespace app\models\Aulas;

use PDO;
use app\core\Model;

class Aulasassistidas extends Model{

    private $table = "aulas_assistidas";

    // public function findAll(){
    //     $sql = "SELECT * FROM {$this->table}";
    //     $query = $this->db->query($sql);
    //     return $query->fetchAll(PDO::FETCH_OBJ);
    // }

    public function findBy($field, $value, $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} = :{$field}";
        $query = $this->db->prepare($sql);
        $query->execute([
            $field => $value,
        ]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    private function findByUser($field, $value, $idusuario, $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} = :{$field} AND idusuario = :idusuario";
        $query = $this->db->prepare($sql);
        $query->bindValue(":idusuario", $idusuario);
        $query->bindValue(":".$field, $value);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function aulasPorCurso($idcurso){
        $objAulas = (new Aulas)->findBy("idcurso", $idcurso);
        $lista = array();
        $assistiu = false;
        foreach($objAulas as $aula){
            $assistido = $this->findByUser("idaula", $aula->idaula, IDUSUARIO);
            if($assistido){
                $data = isset($aula->data_assistida) ? $aula->data_assistida:"00/00/00";
                $hora = isset($aula->hora_assistida) ? $aula->hora_assistida:"00:00:00";
                $assistiu = true; 
            }else{
                $data = "00/00/00";
                $hora = "00:00:00";
                $assistiu = false;
            }
            $lista[] = ([
                "idaula"=>$aula->idaula,
                "aula" => $aula->nome,
                "nraula" => $aula->nraula,
                "descricao" => $aula->descricao,
                "assistiu"=>$assistiu,
                "data" => $data,
                "hora"=>$hora,
                "material_apoio"=>$aula->material_apoio,
                "link"=>$aula->link,
                "exercicios"=>$aula->exercicios,
                "simulados"=>$aula->simulados
            ]);
        }
        return $lista;
    }
    public function concluirAula($idaula){
        
        $jaConcluiu = $this->findByUser("idaula", $idaula, IDUSUARIO);

        if($jaConcluiu){
            $sql = "DELETE FROM {$this->table}
            WHERE idusuario = :idusuario AND idaula= :idaula
            ";
            $prepare = $this->db->prepare($sql);
            $prepare->bindValue(":idusuario", IDUSUARIO);
            $prepare->bindValue(":idaula", $idaula);
            $deletado = $prepare->execute();
            var_dump($deletado);
            die();
            return $deletado;
        }else{            
            $sql = "INSERT INTO {$this->table} SET
            idaula= :idaula,
            idusuario= :idusuario,
            data_assistida = :data,
            hora_assistida= :hora
        ";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(":idaula", $idaula);
        $prepare->bindValue(":idusuario", IDUSUARIO);
        $prepare->bindValue(":data", date("Y-m-d"));
        $prepare->bindValue(":hora", date("H:i:s"));
        $concluida = $prepare->execute();
        return $concluida;
        }
    }
}