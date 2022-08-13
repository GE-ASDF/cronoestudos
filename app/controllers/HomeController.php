<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Blog\Blog;
use app\classes\NotLogged;
use app\core\MethodExtract;
use app\classes\BlockNotLogged;
use app\models\ActiveRecord;
use app\models\Aulas\Aulasassistidas;
use app\models\Create;
use app\models\Cursos\Cursosassistidos;
use app\models\Horarios\Horarios;
use app\models\Usuarios\CursosUsuarios;
use app\models\Usuarios\Usuarios;

class HomeController extends Controller{

    public function __construct(){   
        // NotLogged::notLogged();
        
        BlockNotLogged::block($this, ['index']);

    }

   public function index(){
        $objCursosUsuario = new CursosUsuarios;
        $dados["news"] = (new Blog)->findAll();
        $dados["qtd_aulas_assistidas"] = (array) (new Aulasassistidas)->findBy("idusuario", IDUSUARIO);
        $dados["qtd_cursos_assistidos"] = (array) (new Cursosassistidos)->findBy("idusuario", IDUSUARIO);
        $dados["usuario"] = (new Usuarios)->findBy("idusuario", $_SESSION[SESSION_LOGIN]->idusuario);
        $dados["cursos"] = ($objCursosUsuario->cursosPorUsuario());
        $dados["qtd_cursos"] = (new CursosUsuarios)->count("idusuario", IDUSUARIO);
        $dados["view"] = "index";
        $dados["title"] = "Página inicial | " . $_SESSION[SESSION_LOGIN]->nome;
        $this->load("template", $dados);
   } 
}
