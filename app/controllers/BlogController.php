<?php

namespace app\controllers;

use app\core\Controller;
use app\classes\NotLogged;
use app\models\Blog;

class BlogController extends Controller{

    public function __construct()
    {   
        NotLogged::notLogged();
    }

   public function index(){
       $objBlog = new Blog;
        $dados["view"] = "formularios/blog/blog";
        $dados["news"] = $objBlog->selectAll();
        $dados["title"] = "Blog";
        $this->load("template", $dados);
   } 

   public function detalhe($id = null){
    if($id == null){
        redirect(URL_BASE . "blog");
    }
            $objBlog = new Blog;
            $dados["news"] = $objBlog->find($id);
            $dados["view"] = "formularios/Blog/detalhe";
            $dados["title"] = "Blog";
            $this->load("template", $dados);
      
   }
  
}
