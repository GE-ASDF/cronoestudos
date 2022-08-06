<?php
namespace app\controllers;

use app\classes\BlockNotAdmin;
use app\classes\BlockNotLogged;
use app\classes\Validacao;
use app\core\Controller;
use app\models\Cidades\Cidades;
use app\models\Estados\Estados;
use app\models\Usuarios\Usuarios;

class UsuariosController extends Controller{

    public function __construct()
    {
        BlockNotAdmin::block($this, ['index', "create", "update","editar","buscarCidades"]);
        BlockNotLogged::block($this, ['index', "create", "update","editar","buscarCidades"]);
    }

    public function index(){
        $dados["estados"] = (new Estados)->findAll();
        $dados["view"] = "formularios/Usuarios/Create";
        $dados["title"] = "Cadastrar usuários";
        $this->load("template", $dados);
    }
    
    public function create(){

        $validate = Validacao::validacao([
            "nome"=>"required",
            "sobrenome"=>"required",
            "email"=>"required|email|unique:usuarios",
            "senha"=>"required|senha",
            "nascimento"=>"data",
            "rua"=>"required",
            "cpf"=>"required|unique:usuarios",
            "numero"=>"required",
            "bairro"=>"required",
            "idestado"=>"required",
            "idcidade"=>"required",
            "telresidencial"=>"required|maxlen:15",
            "telcomercial"=>"required|maxlen:15",
            "celular"=>"required|maxlen:15",
            "foto"=>"image:usuarios"
        ]);


        
        if($validate == false){
            foreach($_POST as $key => $valor){
                $info = strip_tags($_POST[$key]);
                setOld($key, $info);
            }   
            setFlash("message", "Verifique os campos e tente novamente");
            return redirect(URL_BASE."usuarios");
        }

        if($validate){
            $create = (new Usuarios)->create($validate);
            if($create){
                setFlash("message", "Usuário cadastrado com sucesso!", "success");
                return redirect(URL_BASE."usuarios");
            }else{
                setFlash("message", "O usuário não foi cadastrado!");
                return redirect(URL_BASE."usuarios");
            }
        }

    }

    public function editar($idusuario = null){
        if($idusuario == null){
            return redirect(URL_BASE."listarusuarios");
        }
        $dados["estados"] = (new Estados)->findAll();
        $dados["usuario"] = (new Usuarios)->findBy("idusuario", $idusuario);
        $dados["view"] = "formularios/Usuarios/Edit";
        $dados["title"] = "Editar usuário";
        $this->load("template", $dados);
    }
    public function update(){
        $validate = Validacao::validacao([
            "idusuario"=>"required",
            "nome"=>"required",
            "sobrenome"=>"required",
            "email"=>"required|email|existe:usuarios",
            "nascimento"=>"data",
            "rua"=>"required",
            "cpf"=>"required|maxlen:15",
            "numero"=>"required",
            "bairro"=>"required",
            "idestado"=>"required",
            "idcidade"=>"required",
            "telresidencial"=>"required|maxlen:15",
            "telcomercial"=>"required|maxlen:15",
            "celular"=>"required|maxlen:15",
            "foto"=>"image"
        ]);

        if($validate == false){ 
            setFlash("message", "Verifique os campos e tente novamente");
            return redirect(URL_BASE."usuarios/editar/".$_POST["idusuario"]);
        }

        
        if($validate){
            $create = (new Usuarios)->update($validate, "idusuario", $validate["idusuario"]);
            if($create){
                setFlash("message", "Usuário cadastrado com sucesso!", "success");
                return redirect(URL_BASE."usuarios/editar/".$validate["idusuario"]);
            }else{
                setFlash("message", "O usuário não foi cadastrado!");
                return redirect(URL_BASE."usuarios/editar/".$validate["idusuario"]);
            }
        }
    }
    public function buscarCidades(){
        $idestado = isset($_GET["idestado"]) ? strip_tags($_GET["idestado"]):null;
        if($idestado){
            $cidades = (new Cidades)->findBy("idestado", $idestado);
            if($cidades){
                echo json_encode($cidades);
            }
        }
    }
}