<?php
/**
 * Class responsável pelo login do sistema e cadastro inicial
 * A class é responsável pelo login do usuário no sistema e pelo cadastro inicial dele.
 * 
 * @author Anderson Souza <andersonsouza007@live.com>
 */
namespace app\controllers;
use app\classes\Validacao;
use app\core\Controller;
use app\models\Usuarios\Usuarios;

class LoginController extends Controller{

    /** Esta função não possui retorno, ou seu retorno é void 
     * @var void */
    public function index(){
        $dados["view"] = "login";
        $dados["title"] = "Login necessário";
        $this->load("login", $dados);
    }
    
    /** Função responsável pelo login no sistema
     * a variável $validate é responsável por enviar as informação para a class de validação.
     * Caso o retorno seja falso o usuário é redirecionado para a página de login novamente.
     * Caso o retorno seja verdadeiro o controller verificará se os dados enviados coincidem com os do banco de dados.
     * @access public
     */
    public function logar(){
        
        $validate = (new Validacao)::validacao([
            "email" => "required|email|existe:usuarios",
            "senha" => "required"
        ]);
        

        if(!$validate){
            return redirect(URL_BASE);
        }

        $objUsuario = new Usuarios;
        /**Verfica se o e-mail está cadastrado no banco de dados */
        $usuario = $objUsuario->findBy(field:"email", value:$validate["email"]);

        if($usuario->email != $validate["email"]){
            setFlash("email", "E-mail não cadastrado.");
            return redirect(URL_BASE);
        }

        $passwordMatch = password_verify($validate["senha"], $usuario->senha);
        if(!$passwordMatch){
            setFlash("senha", "Senha inválida.");
            return redirect(URL_BASE);
        }
        unset($usuario->senha);
        $_SESSION[SESSION_LOGIN] = $usuario;
        return redirect(URL_BASE);
   }

   public function cadastrar(){

        $cadastrar = new Usuarios;
    
        $validate = (new Validacao)::validacao([
            "nome"=>"required",
            "sobrenome"=>"required",
            "email"=>"required|email|unique:usuarios",
            "senha"=>"required"
        ]);
        

        if(!$validate){
            echo json_encode(0);
            setFlash("message", "Tente realizar o cadastro novamente.");
        }
      
        if($validate){
            $cadastrar->nome = $validate["nome"];
            $cadastrar->sobrenome = $validate["sobrenome"];
            $cadastrar->email = $validate["email"];
            $cadastrar->senha = password_hash($validate["senha"], PASSWORD_DEFAULT);

            $cadastrado = $cadastrar->create($validate);

            if($cadastrado){
                echo json_encode(1);
            }else{
                echo json_encode(0);
            }    

        }
    }

    public function recuperarsenha(){

            $validate = (new Validacao)::validacao([
                "email" => "required|email|existe:usuarios",
            ]);
            
            if($validate == false){
                echo json_encode(0);
            }
            
            /**Verfica se o e-mail está cadastrado no banco de dados */
            if($validate){ 
                $objUsuario = new Usuarios;
                $usuario = $objUsuario->findBy(field:"email", value:$validate["email"]);

            if($usuario){            
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