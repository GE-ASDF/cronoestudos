<?php
namespace app\models\Usuarios;

use PDO;
use app\core\Model;
use app\models\Cursos\Cursos;

class CursosUsuarios extends Model{
 
    protected $table = "usuarios_cursos";

    public function findBy($field, $value, $criterio = "=", $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} {$criterio} :{$field}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute([$field => $value]);
        return $prepare->fetch(PDO::FETCH_OBJ);
    }

    public function count($field, $value){
        $sql = "SELECT COUNT(*) AS qtd FROM {$this->table} WHERE {$field} = :{$field}";
        $resultado = $this->db->prepare($sql);
        $resultado->execute([
            $field => $value,
        ]);
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function cursosPorUsuario(){
        $objCursos = new Cursos;
        $todosCursos = $objCursos->findAll();
        $lista = array();
        foreach($todosCursos as $curso){
            $matriculado = $this->cursosUsuario($curso->idcurso);
            if($matriculado){
                $data = $matriculado->data;
                $lista[] = ([
                    "idcurso"=>$curso->idcurso,
                    "foto" => $curso->foto,
                    "curso" => $curso->nome,
                    "professor"=> $curso->professor,
                    "descricao"=> $curso->descricao,
                    "data"=> $data,
                ]);
            }
        }
        return $lista;
    }
    
    private function cursosUsuario($idcurso, $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE idcurso = :idcurso AND idusuario = :idusuario";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(":idcurso", $idcurso);
        $prepare->bindValue(":idusuario", IDUSUARIO);
        $prepare->execute();
        return $prepare->fetch(PDO::FETCH_OBJ);
    }
}