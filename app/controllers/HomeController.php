<?php

namespace app\controllers;

use app\models\Blog;
use app\models\FindAll;
use app\core\Controller;
use app\classes\NotLogged;
use app\models\daos\FormacoesUsuarios;
use app\models\tables\Aulas_assistidas;
use app\models\tables\Cursos_assistidos;
use app\models\tables\Usuarios_formacoes;

class HomeController extends Controller{

    public function __construct()
    {   
        NotLogged::notLogged();
    }

   public function index(){
        $findAllFormacoes = new Usuarios_formacoes;
        $findAllAulasAssistidas = new Aulas_assistidas;
        $findAllCursosAssistidos = new Cursos_assistidos;
        $objBlog = new Blog;
        $allFormacoes = new FormacoesUsuarios;
        $dados["formacoes_matriculado"] = $allFormacoes->usuariosPorFormacao();
        $formacoes_matriculado = ($findAllFormacoes->execute(new FindAll(["idusuario"=>IDUSUARIO], group:"idformacao")));
        $aulas_assistidas = ($findAllAulasAssistidas->execute(new FindAll(["idusuario"=>IDUSUARIO])));
        $cursos_assistidos = ($findAllCursosAssistidos->execute(new FindAll(["idusuario"=>IDUSUARIO])));
        $dados["news"] = $objBlog->selectAll();
        $dados["qtd_usuario_formacoes"] = countAll($formacoes_matriculado);
        $dados["qtd_aulas_assistidas"] = countAll($aulas_assistidas);
        $dados["qtd_cursos_assistidos"] = countAll($cursos_assistidos);
        $dados["view"] = "index";
        $dados["title"] = "Página inicial | " . $_SESSION[SESSION_LOGIN]->nome;
        $this->load("template", $dados);
   } 
  
}
