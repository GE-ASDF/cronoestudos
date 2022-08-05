<?php
namespace app\controllers;

use app\classes\BlockNotAdmin;
use app\classes\BlockNotLogged;
use app\classes\Validacao;
use app\core\Controller;
use app\core\Uri;
use app\models\Aulas\Aulas;
use app\models\Aulas\Aulasassistidas;
use app\models\Cursos\Cursos;
use app\models\Matriculas\Matriculas;
use app\models\Usuarios\Usuarios;
use stdClass;

class MatriculasController extends Controller{

    public function __construct()
    {
        BlockNotLogged::block($this, ['index', 'create', 'listarcursos', 'delete']);
        BlockNotAdmin::block($this, ['index', 'create', 'listarcursos', 'delete']);
    }

    public function index(){
         
        $dados["title"] = "Matricular usuário";
        $dados["view"] = "formularios/Matriculas/Create";
        $dados["cursos"] = (new Cursos)->findAll();
        $dados["usuarios"] = (new Usuarios)->all();
        
        $this->load("template", $dados);
    }

    public function create(){

       $objMatricula = new Matriculas;
       $validate = (new Validacao)::validacao([
            "idusuario" =>"required|existe:usuarios",
       ]);

       if(!$validate){
        setFlash("message", "Escolha um usuário válido.");
        return redirect(URL_BASE."matriculas");
       }

       $matricula = false;
       
       $idcurso = $_POST["idcurso"];
       $idusuario = $validate["idusuario"];

       foreach($idcurso as $key => $valor){

            $validado = [
                "idusuario" => $idusuario,
                "idcurso" => $valor
            ];

            $matriculado = $objMatricula->findBy($validado);

            if(!$matriculado){
                $matricula = $objMatricula->create($validado);                
            }

        }

        if($matricula > 0){
            setFlash("message", "O aluno foi matriculado com sucesso", "success");
            return redirect(URL_BASE."matriculas");
        }else{
            setFlash("message", "O aluno não foi matriculado. Um dos motivos é por ele já estar matriculado no curso.");
            return redirect(URL_BASE."matriculas");
        }
        
    }
    public function listarcursos(){
        $idusuario = $_GET["idusuario"];
        $objCursos = (new Cursos)->findAll();
        $newObj = new stdClass;
        $lista = array();
        if($objCursos){
            $matri = false;
            foreach($objCursos as $matriculado){
            $matricula =  (new Matriculas)->findTeste($idusuario, $matriculado->idcurso);
            if($matricula){
                $matri = true;
            }else{
                $matri = false;
            }
            $lista[] = ([
                "idcurso"=>$matriculado->idcurso,
                "nome" => $matriculado->nome,
                "matriculado"=>$matri
            ]);
        }
        echo json_encode($lista);

    }
}

    public function delete(){

        $validate = Validacao::validacao([
            "idcurso" => "required",
            "idusuario" => "required",
        ]);
        
        if($validate){
            $objMatricula = (new Matriculas)->delete($validate);
            if($objMatricula){
                echo json_encode(1);
            }else{
                echo json_encode(0);
            }
        }

    }

}

