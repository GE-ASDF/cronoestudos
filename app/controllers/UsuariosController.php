<?php

namespace app\controllers;

use app\classes\BlockNotAdmin;
use app\classes\IsAdmin;
use app\classes\IsProtected;
use app\classes\NotLogged;
use app\core\Controller;

class UsuariosController extends Controller{

    public function __construct()
    {   
        $isAdmin = IsAdmin::isAdmin(0,1);
        NotLogged::notLogged();
        if(!$isAdmin) IsProtected::isProtected();
    }

   public function index(){
       echo "Controller usuários";
   } 

    public function cadastrar(){
        echo "Controller cadastrar";
    } 

}
