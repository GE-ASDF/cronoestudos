<?php

namespace app\controllers;

use app\core\Controller;
use app\classes\NotLogged;
use app\models\Usuarios\CursosUsuarios;

class MeusCursosController extends Controller{

    public function __construct()
    {   
        NotLogged::notLogged();
    }

   public function index(){
        $objCursosUsuario = new CursosUsuarios;
        $dados["cursos"] = ($objCursosUsuario->cursosPorUsuario());
        $dados["view"] = "formularios/MeusCursos/Index";
        $dados["title"] = "Página inicial | " . $_SESSION[SESSION_LOGIN]->nome;
        $this->load("template", $dados);
   } 
  
}
