<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Dias\Dias;
use app\classes\Validacao;
use app\models\Grade\Grade;
use app\classes\BlockNotLogged;
use app\models\Aulas\Aulas;
use app\models\Aulas\Aulasassistidas;
use app\models\Horarios\Horarios;
use app\models\Usuarios\CursosUsuarios;

class GradeController extends Controller{

    public function __construct()
    {
        BlockNotLogged::block($this, ["index", "create", "delete"]);
    }

    public function index(){
        $objAulas = new Aulasassistidas;
        $dados = [
            "grade"=>(new Grade)->grade(),
            "cursos" => (new CursosUsuarios)->cursosPorUsuario(),
            "dias"=> (new Dias)->findAll(), 
            "horarios"=> (new Horarios)->findBy("idusuario", IDUSUARIO), 
            "title"=>"Grade de horários",
            "view"=>"formularios/Grade/Index",
            "aulas" => $objAulas->findBy("idusuario", IDUSUARIO),
        ];       
        $this->load("template", $dados);
    }
    public function create(){
        
        if($_POST){
            $validate = Validacao::validacao([
                "idcurso"=>"required",
                "idusuario"=>"required",
                "iddia"=>"required",
                "idhorario"=>"required",
            ]);

            $objUsuariosCurso = (new CursosUsuarios)->coursesByUser(["idcurso"=>$validate["idcurso"], "idusuario"=>$validate["idusuario"]]);
            
            if(!$objUsuariosCurso){
                setFlash("message", "Você precisa estar matriculado no curso.");
                redirect(URL_BASE."grade");
                die();
            }

            if(!$validate){
                setFlash("message", "Alguns campos obrigatórios estão faltando");
                return redirect(URL_BASE."grade");
            }
            
            

            if($validate){
                $objGrade = new Grade;
                $jaCadastrado = $objGrade->findBy([
                        "idusuario"=> $validate["idusuario"],
                        "iddia"=> $validate["iddia"],
                        "idhorario"=> $validate["idhorario"],
                    ]
                );

                if(!$jaCadastrado){
                    $created = $objGrade->create($validate);
                    if($created){
                        setFlash("message", "Sucesso!", "success");
                        return redirect(URL_BASE."grade");
                    }else{
                        setFlash("message", "Horário não cadastrado.");
                        return redirect(URL_BASE ."grade");
                    }
                }else{
                    setFlash("message", "Você não pode sobrepor horários.");
                    return redirect(URL_BASE."grade");
                }
            }

        }else{
            return redirect(URL_BASE."grade");
        }
    }

    public function delete(){
        $objGrade = new Grade;
        if($_POST){

            $validate = Validacao::validacao([
                "idusuario"=>"required",
                "idhorario"=>"required",
                "iddia"=>"required",
                "idcurso"=>"required"
            ]);

            if($validate["idusuario"] != IDUSUARIO){
                redirect(URL_BASE."notallowed");
                die();
            }
            $cadastrado = $objGrade->findBy(["idhorario"=>$validate["idhorario"], 
            "idusuario"=>$validate["idusuario"], "iddia"=>$validate["iddia"], "idcurso"=>$validate["idcurso"]]);
       
            if($cadastrado->idusuario !== IDUSUARIO){
                redirect(URL_BASE."notallowed");
                die();
            }

            if($cadastrado){
                $deleted = $objGrade->delete($validate);
                if($deleted){
                    setFlash("message", "Horário desmarcado", "success");
                    return redirect(URL_BASE."grade");
                }else{
                    setFlash("message", "Ocorreu um erro. Tente novamente.");
                }
            }else{
                redirect(URL_BASE."grade");
                die();
            }
        }else{
            redirect(URL_BASE."notallowed");
            die();
        }
    }
}