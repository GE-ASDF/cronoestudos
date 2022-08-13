<?php
namespace app\controllers;
use app\models\Horarios\Horarios;
use app\classes\BlockNotLogged;
use app\classes\Validacao;
use app\core\Controller;

class HorariosController extends Controller{

    public function __construct()
    {
        BlockNotLogged::block($this, ['index', 'create', 'delete']);
    }

    public function index(){
        $dados = [
            "title"=>"Cadastrar horários",
            "view"=>"formularios/Horarios/Create",
        ];
        $this->load("template", $dados);
    }

    public function create(){

       $validate = isset($_POST) && array_keys($_POST) != '' ? $_POST:null;

       $objHorarios = new Horarios;
       $jaCadastrado = $objHorarios->findBy("idusuario", $validate["idusuario"]);

       if($jaCadastrado){
            setFlash("message", "Você já possui horários cadastrados.");
            return redirect(URL_BASE."horarios");
       }

       if(!$jaCadastrado){
           for($i = 0; $i < count($validate["horario"]); $i++){
               $a = 1;
                $validado = [
                    "idusuario"=>$validate["idusuario"],
                    "idhorario"=> $a + $i,
                    "horario"=>$validate["horario"][$i]
                ];
                
                $created = $objHorarios->create($validado);
            }
       }
        if($created){
            setFlash("message", "Os seus horários foram cadastrados com sucesso.", "success");
            return redirect(URL_BASE."horarios");
        }

    }

    public function delete(){

        $objHorarios = new Horarios;

        if($_POST){

        $validate = Validacao::validacao([
            "idusuario"=>"required",
        ]);

        $jaCadastrado = $objHorarios->findBy("idusuario", $validate["idusuario"]);
        if($validate["idusuario"] != IDUSUARIO){
            return redirect(URL_BASE."notallowed");
        }
        if(!$jaCadastrado){
             setFlash("message", "Você não possui horários cadastrados.");
             return redirect(URL_BASE."horarios");
        }
            
        if($jaCadastrado){
            $deleted = $objHorarios->delete($validate);
            if($deleted){
                setFlash("message", "Os seus horários foram resetados.");
                return redirect(URL_BASE."horarios");
        }
        }
    }else{
        return redirect(URL_BASE."horarios");
    }

    }

}