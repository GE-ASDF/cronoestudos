<?php
namespace app\controllers;

use app\classes\BlockNotLogged;
use app\core\Controller;
use app\models\Blog\Blog;
use app\classes\NotLogged;

class BlogController extends Controller{

    public function __construct()
    {   
        BlockNotLogged::block($this, ['index', 'detalhe']);
    }

    public function index(){
        $dados["view"] = "formularios/Blog/Index";
        $dados["title"] = "Nosso blog";
        $dados["news"] = (new Blog)->findAll();
        $this->load("template", $dados);
    }

    public function detalhe($id = null){
        if($id == null){
            return redirect(URL_BASE."Blog");
        }
        $dados["view"] = "formularios/Blog/detalhe";
        $dados["title"] = "Nosso blog";
        if((new Blog)->findBy("id", $id)){
            $dados["news"] = (new Blog)->findBy("id", $id);
        }
        $this->load("template", $dados);
    }

}