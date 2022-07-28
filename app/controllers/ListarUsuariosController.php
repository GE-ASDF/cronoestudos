<?php

namespace app\controllers;

use app\classes\IsAdmin;
use app\classes\IsProtected;
use app\classes\NotLogged;
use app\core\Controller;
use app\models\FindAll;
use app\models\FindBy;
use app\models\tables\Usuarios;

class ListarUsuariosController extends Controller{

    public function __construct()
    {   
        $isAdmin = IsAdmin::isAdmin($_SESSION[SESSION_LOGIN]->colaborador,1);
        NotLogged::notLogged();
        if(!$isAdmin) IsProtected::isProtected();
    }

   public function index(){
    $objFindAll = new Usuarios;
        $dados["usuarios"] = $objFindAll->execute(new FindAll);
       $dados["title"] = "Lista de usuários";
       $dados["view"] = "formularios/usuarios/Index";
       $this->load("template", $dados);
   } 

    public function cadastrar(){
        echo "Controller cadastrar";
    } 

}
