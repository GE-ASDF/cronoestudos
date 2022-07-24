<?php
namespace app\controllers;

use app\classes\Flash;
use app\models\Login;
use app\core\Controller;
use app\models\Activerecord;
use app\models\FindBy;
use app\models\tables\Usuarios;

class LoginController extends Controller{

    public function index(){
        $dados["view"] = "login";
        $this->load("login", $dados);
    }
    public function logar(){
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $senha = strip_tags($_POST["senha"]);

        $objUsuario = new Usuarios;
        $usuario = $objUsuario->execute(new FindBy(field:"email", value:$email));

        if($usuario->email != $email){
            setFlash("email", "E-mail não cadastrado.");
            return header("location:". URL_BASE ."login");
        }

        $passwordMatch = password_verify($senha, $usuario->senha);
        if(!$passwordMatch){
            setFlash("senha", "Senha inválida.");
            return header("location:". URL_BASE ."login");
        }
        unset($usuario->senha);
        $_SESSION[SESSION_LOGIN] = $usuario;
        return header("location:" . URL_BASE);
   }
   public function logout(){
        if(isset($_SESSION[SESSION_LOGIN])){
            session_destroy();
        }
        return header("location:" . URL_BASE . "login");
   }
}