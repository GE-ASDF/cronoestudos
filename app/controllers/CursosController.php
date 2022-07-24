<?php

namespace app\controllers;

use app\core\Controller;
use app\classes\NotLogged;
use app\models\FindAll;
use app\models\tables\Cursos;

class CursosController extends Controller{

    public function __construct()
    {   
        NotLogged::notLogged();
    }

   public function index(){
    $objCursos = new Cursos;
    $dados["cursos"] = $objCursos->execute(new FindAll());
       $dados["view"] = "formularios/Cursos/Index";
       $this->load("template", $dados);
   } 
  
}
