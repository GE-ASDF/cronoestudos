<?php
namespace app\models\Cursos;

use app\core\Model;
use app\models\Aulas\Aulas;
use app\models\Professores\Professores;
use PDO;
use Throwable;

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

    public function findByAll($field, $value, $criterio = "=", $fields = "*"){
        $sql = "SELECT {$fields} FROM {$this->table} WHERE {$field} {$criterio} :{$field}";
        $prepare = $this->db->prepare($sql);
        $prepare->execute([$field => $value]);
        return $prepare->fetchAll(PDO::FETCH_OBJ);
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
    public function create($dados){
        $sql = "INSERT INTO {$this->table}(";
        $sql.= implode(", ", array_keys($dados)) . ")";
        $sql.= " VALUES(";
        $sql.= ":". implode(", :", array_keys($dados)). ")";
        $prepare = $this->db->prepare($sql);
        
        foreach($dados as $key=>$dado){
            if($key == "datacadastro"){
                $dado.= date(" H:i:s");
            }
            $prepare->bindValue(":".$key, $dado);
        }

        $cadastrado = $prepare->execute();
        return $cadastrado;
    }
    public function get($id = null){
        try{  
        if($id){
            $curso =  $this->findBy("idcurso", $id);
            if($curso){

                $aulas = (new Aulas)->findBy("idcurso", $id);
                $prof = $curso->professor;
                $professor = (new Professores)->findBy("idprofessor", $prof);
                $curso->professor = $professor->nome;
                foreach($aulas as $aula){
                    $nome[] = $aula->nome;
                }
                $retorno = [
                    "Curso"=>$curso,
                    "Aulas"=>$nome,
                ];
                return $retorno;
            }else{
                die("Desculpe, mas este curso não foi encontrado no nosso banco de dados.");
            }
        }else{
            return $this->findAll();
        }
        }catch(Throwable $e){
            die($e->getMessage());
        }

    }
}