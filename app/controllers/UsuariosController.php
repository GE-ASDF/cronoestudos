<?php
namespace app\controllers;

use app\classes\IsAdmin;
use app\core\Controller;
use app\classes\NotLogged;
use app\classes\IsProtected;

class UsuariosController extends Controller{

    public function __construct()
    {   
        $isAdmin = IsAdmin::isAdmin($_SESSION[SESSION_LOGIN]->colaborador,1);
        NotLogged::notLogged();
        if(!$isAdmin) IsProtected::isProtected();
    }

    public function index(){
        $dados["title"] = "Cadastro de usuários";
        $dados["view"] = "formularios/Usuarios/Create";
        $this->load("template", $dados);
    }

}