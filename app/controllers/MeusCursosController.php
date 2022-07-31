<?php

namespace app\controllers;

use app\classes\BlockNotLogged;
use app\core\Controller;
use app\classes\NotLogged;
use app\models\Usuarios\CursosUsuarios;

class MeusCursosController extends Controller{

    public function __construct()
    {   
        BlockNotLogged::block($this, ["index"]);
    }

   public function index(){
        $dados["cursos"] = (new CursosUsuarios)->cursosPorUsuario();
        $dados["view"] = "formularios/MeusCursos/Index";
        $dados["title"] = "Página inicial | " . $_SESSION[SESSION_LOGIN]->nome;
        $this->load("template", $dados);
   } 
  
}
