<?php

namespace app\controllers;

use app\core\Controller;
use app\classes\Validacao;
use app\classes\BlockNotAdmin;
use app\classes\BlockNotLogged;
use app\models\Cursos\Cursos;
use app\models\Professores\Professores;

class CursosController extends Controller{

    public function __construct()
    {   
        BlockNotLogged::block($this, ['index','create']);
        BlockNotAdmin::block($this, ['index','create']);
    }

   public function index(){
        $dados["professores"] = (new Professores)->findAll();
        $dados["view"] = "formularios/Cursos/Create";
        $dados["title"] = "Cadastro de cursos";
        $this->load("template", $dados);
   } 

   public function create(){

    $objCursos = new Cursos;

    $validate = Validacao::validacao([
        "nome" => "required",
        "professor" => "required",
        "descricao"=>"required",
        "foto"=>"image",
        "datacadastro" => "data"
    ]);

    if($validate == false){
        
        foreach($_POST as $key => $valor){
            $info = strip_tags($_POST[$key]);
            setOld($key, $info);
        }   
        
        setFlash("message", "O curso não foi cadastrado. Tente novamente");
        return redirect(URL_BASE."cursos");
    }
           
    if($validate == true){
        $created = $objCursos->create($validate);
        if($created){
            setFlash("message", "Cadastro feito com sucesso", "success");
            return redirect(URL_BASE."cursos");
        }else{
            setFlash("message", "O curso não foi cadastrado. Tente novamente");
            return redirect(URL_BASE."cursos");
        }
    }
        

   }
  
}
