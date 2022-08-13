<?php
namespace app\controllers;


use app\classes\BlockNotLogged;
use app\classes\Validacao;
use app\core\Controller;
use app\models\Cidades\Cidades;
use app\models\Estados\Estados;
use app\models\Usuarios\Usuarios;

class PerfilController extends Controller{

    public function __construct()
    {
        BlockNotLogged::block($this, ['index', 'detalhe', 'create', "buscarCidades"]);
    }

    public function index(){
        redirect(URL_BASE."perfil/detalhe/".IDUSUARIO);
    }
    public function detalhe($idusuario = null){
        $dados["usuario"] = (new Usuarios)->findBy("idusuario", $idusuario);
        $dados["estados"] = (new Estados)->findAll();
        $dados["view"] = "formularios/Perfil/Create";
        $dados["title"] = "Meu perfil";
        $this->load("template", $dados);
    }
    public function create(){

        $validate = Validacao::validacao([
            "idusuario"=>"required|existe:usuarios",
            "nome"=>"required",
            "sobrenome"=>"required",
            "email"=>"required|email|existe:usuarios",
            "nascimento"=>"data",
            "rua"=>"required",
            "cpf"=>"required|unique:usuarios",
            "numero"=>"required",
            "bairro"=>"required",
            "idestado"=>"required",
            "idcidade"=>"required",
            "telresidencial"=>"required",
            "telcomercial"=>"required",
            "celular"=>"required",
            "foto"=>"image"
        ]);

        if($validate == false){ 
            setFlash("message", "Verifique os campos e tente novamente");
            return redirect(URL_BASE."perfil/detalhe/".IDUSUARIO);
        }

        if($validate){
            $create = (new Usuarios)->update($validate, "idusuario", IDUSUARIO);
            if($create){
                setFlash("message", "Usuário cadastrado com sucesso!", "success");
                return redirect(URL_BASE."perfil/detalhe/".IDUSUARIO);
            }else{
                setFlash("message", "O usuário não foi cadastrado!");
                return redirect(URL_BASE."perfil/detalhe/".IDUSUARIO);
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