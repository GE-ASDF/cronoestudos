<?php
namespace app\controllers;

use Throwable;
use app\core\Uri;
use app\core\Controller;
use app\classes\Validacao;
use app\models\Aulas\Aulas;
use app\models\Cursos\Cursos;
use app\classes\BlockNotLogged;
use app\models\Usuarios\Usuarios;
use app\models\Aulas\Aulasassistidas;
use app\models\Matriculas\Matriculas;
use app\models\Professores\Professores;

class AulasController extends Controller{

    public function __construct()
    {   
        BlockNotLogged::block($this, ['index', 'assistir', 'concluirAula']);
    }

    public function index(){

        try{
            $dados["view"] = "formularios/Aulas/Index";
            $this->load("template", $dados);
        }catch(Throwable $e){
            return redirect(URL_BASE."meuscursos");
        }

    }

    public function assistir($idcurso = null){
        $matriculado = (new Matriculas)->findTeste(IDUSUARIO, $idcurso);
        $cursoExiste = (new Cursos)->findBy("idcurso", $idcurso);
        if($matriculado && $cursoExiste){
            $dados["curso"] = (new Cursos)->findBy("idcurso", $idcurso);
            $dados["professores"] = (new Professores)->findAll();
            $dados["qtdAulas"] = (new Aulas)->findBy("idcurso", $idcurso);
            $objAulas = new Aulasassistidas;
            $dados["aulas"] = $objAulas->aulasPorCurso($idcurso);
            $dados["title"] = "Assistir aula";
            $dados["view"] = "formularios/Aulas/Index";
            $this->load("template", $dados);
        }else{
            return redirect(URL_BASE);
        }
        
    }

    public function concluirAula($idaula = null){
        
        $idaula = strip_tags($_GET["idaula"]);
        $idcurso = strip_tags($_GET["idcurso"]);
        
        if(!$idaula){
            echo json_encode(0);
        }

        if($idaula){
            $concluido = (new Aulasassistidas)->concluirAula($idaula, $idcurso);
            if($concluido){
                echo json_encode(1);
            }else{
                echo json_encode(0);
            }
        }

    }

}

