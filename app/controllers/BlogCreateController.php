<?php
namespace app\controllers;

use app\classes\BlockNotAdmin;
use app\classes\BlockNotLogged;
use app\classes\Validacao;
use app\core\Controller;
use app\models\Blog\Blog;

class BlogCreateController extends Controller{

    public function __construct()
    {
        BlockNotLogged::block($this, ['index', 'create']);
        BlockNotAdmin::block($this, ['index', 'create']);
    }

    public function index(){
        $dados["title"] = "Postar no blog";
        $dados["view"] = "formularios/Blog/Create";
        $this->load("template", $dados);
    }

    public function create(){

        $objBlog = new Blog;

        $validate = Validacao::validacao([
            "titulo" => "required",
            "autor" => "required",
            "conteudo"=>"required",
            "imagem"=>"image",
            "data_publicacao" => "data"
        ]);

        if($validate == false){
            
            foreach($_POST as $key => $valor){
                $info = strip_tags($_POST[$key]);
                setOld($key, $info);
            }   
            
            setFlash("message", "A postagem não foi feita");
            return redirect(URL_BASE."blogcreate");
        }
               
        if($validate == true){
            $created = $objBlog->create($validate);
            if($created){
                setFlash("message", "Postagem feita com sucesso", "success");
                return redirect(URL_BASE."blogcreate");
            }else{
                setFlash("message", "A postagem não foi feita");
                return redirect(URL_BASE."blogcreate");
            }
        }

    }

}