<?php
namespace app\controllers;

use app\classes\Flash;
use app\classes\Validacao;
use app\models\Login;
use app\core\Controller;
use app\models\Activerecord;
use app\models\FindBy;
use app\models\Insert;
use app\models\tables\Usuarios;
use app\models\Usuarios as ModelsUsuarios;

class LoginController extends Controller{

    public function index(){
        $dados["view"] = "login";
        $this->load("login", $dados);
    }
    public function logar(){
        // $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        // $senha = strip_tags($_POST["senha"]);
        
        $validate = (new Validacao)::validacao([
            "email" => "required|email|existe:usuarios",
            "senha" => "required"
        ]);
        

        if(!$validate){
            return redirect("login");
        }

        $objUsuario = new Usuarios;
        $usuario = $objUsuario->execute(new FindBy(field:"email", value:$validate["email"]));

        if($usuario->email != $validate["email"]){
            setFlash("email", "E-mail não cadastrado.");
            return header("location:". URL_BASE ."login");
        }

        $passwordMatch = password_verify($validate["senha"], $usuario->senha);
        if(!$passwordMatch){
            setFlash("senha", "Senha inválida.");
            return header("location:". URL_BASE ."login");
        }
        unset($usuario->senha);
        $_SESSION[SESSION_LOGIN] = $usuario;
        return header("location:" . URL_BASE);
   }

   public function cadastrar(){

        $cadastrar = new Usuarios;
    
        $validate = (new Validacao)::validacao([
            "nome"=>"required",
            "sobrenome"=>"required",
            "email"=>"required|unique:usuarios",
            "senha"=>"required"
        ]);
        

        if(!$validate){
            echo json_encode(0);
            // setFlash("message", "Tente realizar o cadastro novamente.");
            // return redirect(URL_BASE);
        }
        
        if($validate){
            $cadastrar->nome = $validate["nome"];
            $cadastrar->sobrenome = $validate["sobrenome"];
            $cadastrar->email = $validate["email"];
            $cadastrar->senha = password_hash($validate["senha"], PASSWORD_DEFAULT);

            $cadastrado = $cadastrar->execute(new Insert($validate));
            
            if($cadastrado){
                echo json_encode(1);
            }else{
                echo json_encode(0);
            }    

        }
    }

   public function logout(){
        if(isset($_SESSION[SESSION_LOGIN])){
            unset($_SESSION[SESSION_LOGIN]);
        }
        return header("location:" . URL_BASE . "login");
   }
}