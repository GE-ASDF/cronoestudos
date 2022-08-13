<?php
namespace app\controllers;

use app\classes\ArquivoXml;
use app\classes\BlockNotAdmin;
use Throwable;
use app\core\Controller;
use app\classes\Validacao;
use app\models\Aulas\Aulas;
use app\models\Cursos\Cursos;
use app\classes\BlockNotLogged;
use app\classes\Teste;
use DOMDocument;

class CadastrarAulasController extends Controller{

    public function __construct()
    {   
        BlockNotLogged::block($this, ['index', 'create']);
        BlockNotAdmin::block($this, ["index", 'create']);
    }

    public function index(){

        try{
            $dados["cursos"] = (new Cursos)->findAll();
            $dados['title'] = "Cadastrar aulas";
            $dados["view"] = "formularios/Aulas/Create";
            $this->load("template", $dados);
        }catch(Throwable $e){
            return redirect(URL_BASE."meuscursos");
        }

    }

    public function create(){

        if(!empty($_FILES["arquivo"]["tmp_name"])){

            $validate = Validacao::validacao([
                "idcurso"=>"required",
            ]);
            if(!(new Aulas)->findBy("idcurso", $validate["idcurso"])){
                $validaXml = ArquivoXml::valida("arquivo", "idcurso");
                if($validaXml){
                    setFlash("message","Aulas cadastradas com sucesso","success");
                    return redirect(URL_BASE."cadastraraulas");
                }else{
                    setFlash("message","Ocorreu um erro. Tente novamente.");
                    return redirect(URL_BASE."cadastraraulas");
                }
            }else{
                setFlash("message","Já existem aulas cadastradas para este curso.");
                    return redirect(URL_BASE."cadastraraulas");
            }

        }
        
    }
}

