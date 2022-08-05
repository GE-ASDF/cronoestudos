<?php
namespace app\controllers;

use app\core\Controller;

class UsuariosController extends Controller{

    public function index(){
        $dados["view"] = "formularios/Usuarios/Create";
        $dados["title"] = "Cadastrar usuários";
        $this->load("template", $dados);
    }

}