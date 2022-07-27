<?php

namespace app\controllers;

use app\core\Controller;
use app\classes\NotLogged;

class HomeController extends Controller{

    public function __construct()
    {   
        NotLogged::notLogged();
    }

   public function index(){
       $dados["view"] = "index";
       $dados["title"] = "Página inicial | " . $_SESSION[SESSION_LOGIN]->nome;
       $this->load("template", $dados);
   } 
  
}
