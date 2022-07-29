<?php

namespace app\controllers;

use app\classes\IsAdmin;
use app\classes\IsProtected;
use app\classes\NotLogged;
use app\core\Controller;
use app\models\FindAll;
use app\models\FindBy;
use app\models\tables\Usuarios;
use app\models\Usuarios as User;

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
    public function colaborador(){
        if($_SESSION[SESSION_LOGIN]->colaborador == 1){
            $objUpdate = new User();
            $idusuario = strip_tags($_GET["idusuario"]);  
            $atualizado = $objUpdate->eColaborador($idusuario);
            if($atualizado){
                echo json_encode(1);
            }else{
                echo json_encode(0);
            }
        }else{
            return redirect(URL_BASE);
        }
    }
}
