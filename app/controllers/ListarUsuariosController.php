<?php
namespace app\controllers;

use app\classes\BlockNotAdmin;
use app\classes\BlockNotLogged;
use app\classes\IsAdmin;
use app\classes\IsProtected;
use app\core\Controller;
use app\classes\NotLogged;
use app\classes\Validacao;
use app\models\Usuarios\Usuarios;

class ListarUsuariosController extends Controller{

    function __construct(){ 
        
        BlockNotAdmin::block($this, ['index','colaborador']);
        BlockNotLogged::block($this, ['index', 'colaborador']);
           
    }

    public function index(){
        $dados["usuarios"] = (new Usuarios)->all();
        $dados["view"] = "formularios/Usuarios/Index";
        $dados["title"] = "Lista de usuários";
        $this->load("template", $dados);
    }

    public function colaborador(){

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

    }

}