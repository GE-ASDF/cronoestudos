<?php

namespace app\controllers;

use app\classes\BlockNotAdmin;
use app\classes\BlockNotLogged;
use app\classes\IsAdmin;
use app\classes\IsProtected;
use app\core\Controller;
use app\classes\NotLogged;
use app\models\Cursos\Cursos;

class ListarCursosController extends Controller{

    public function __construct()
    {   
        BlockNotLogged::block($this, ['index','ativo']);
        BlockNotAdmin::block($this, ['index','ativo']);
    }

   public function index(){
        $objCursosUsuario = new Cursos;
        $dados["cursos"] = ($objCursosUsuario->findAll());
        $dados["view"] = "formularios/Cursos/Index";
        $dados["title"] = "Lista de cursos";
        $this->load("template", $dados);
   } 

   public function ativo(){
     
            $idcurso = strip_tags($_GET["idcurso"]);
            if($idcurso == null || $idcurso == ''){
                echo json_encode(0);
            }
            $atualizado = (new Cursos)->ativo("idcurso", $idcurso);
            
            if($atualizado){
                echo json_encode(1);
            }else{
                echo json_encode(0);
            }
   }
  
}
