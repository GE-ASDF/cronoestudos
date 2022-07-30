<?php

namespace app\controllers;

use app\models\Blog\Blog;
use app\core\Controller;
use app\classes\NotLogged;
use app\models\Usuarios\CursosUsuarios;

class HomeController extends Controller{

    public function __construct()
    {   
        NotLogged::notLogged();
    }

   public function index(){
        $objCursosUsuario = new CursosUsuarios;
        $dados["news"] = (new Blog)->findAll();
        $dados["cursos"] = ($objCursosUsuario->cursosPorUsuario());
        $dados["qtd_cursos"] = (new CursosUsuarios)->count("idusuario", IDUSUARIO);
        $dados["view"] = "index";
        $dados["title"] = "Página inicial | " . $_SESSION[SESSION_LOGIN]->nome;
        $this->load("template", $dados);
   } 
  
}
