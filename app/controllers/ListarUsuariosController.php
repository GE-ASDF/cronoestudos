<?php
namespace app\controllers;

use app\classes\IsAdmin;
use app\classes\IsProtected;
use app\core\Controller;
use app\classes\NotLogged;
use app\classes\Validacao;
use app\models\Usuarios\Usuarios;

class ListarUsuariosController extends Controller{

    function __construct(){  
        if(!IsAdmin::isAdmin()){
            IsProtected::isProtected();
        }
        NotLogged::notLogged();        
    }

    public function index(){
        $dados["usuarios"] = (new Usuarios)->all();
        $dados["view"] = "formularios/Usuarios/Index";
        $dados["title"] = "Lista de usuários";
        $this->load("template", $dados);
    }

    public function colaborador(){

        if(!IsAdmin::isAdmin()){
            IsProtected::isProtected();
        }

        NotLogged::notLogged();

        if(IsAdmin::isAdmin()){
            $idusuario = strip_tags($_GET["idusuario"]);
            if($idusuario == null || $idusuario == ''){
                echo json_encode(0);
            }
            $atualizado = (new Usuarios)->colaborador("idusuario", $idusuario);
            
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