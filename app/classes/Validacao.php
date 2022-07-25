<?php
namespace app\classes;

use app\models\FindBy;
use app\models\tables\Usuarios;

class Validacao{

    public static function validacao(array $validacoes){
        $result = [];
        $param = '';
        foreach($validacoes as $field => $validate){
            $result[$field] = (!str_contains($validate, "|")) ?
            [$validate, $param] = self::validacaoUnica($validate, $field, $param):
            $result[$field] = self::validacaoMultipla($validate, $field, $param);
        }
        if(in_array(false, $result)){
            return false;
        }
        return $result;
    }

    private static function validacaoUnica($validate, $field, $param){
        if(str_contains($validate, ":")){
            [$validate, $param] = explode(":", $validate);
        }
        return self::$validate($field, $param);
    }

    private static function validacaoMultipla($validate, $field, $param){
        $result = [];
        $explodeValidatePipe = explode("|", $validate);
            foreach($explodeValidatePipe as $validate){
                if(str_contains($validate, ":")){
                    [$validate, $param] = explode(":", $validate);
                }
                $result[$field] = self::$validate($field, $param);
                if(isset($result[$field]) and $result[$field] === false){
                    break;
                }
            }
            return $result[$field];
    }

    private static function required($field){
        if($_POST[$field] === ''){
            setFlash($field, "O campo {$field} é obrigatório");
            return false;
        }
        return filter_input(INPUT_POST, $field, FILTER_SANITIZE_EMAIL);
    }

    private static function email($field){
        $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);
            if(!$emailIsValid){
                setFlash($field, "O campo precisa ter um {$field} válido.");
                return false;
            }
        return filter_input(INPUT_POST, $field, FILTER_SANITIZE_EMAIL);
    }

    private static function maxlen($field, $param){
        $data = strip_tags($_POST[$field]);
        if(strlen($data) > $param){
            setFlash($field, "O campo {$field} tem um limite de {$param} caracteres.");
            return false;
        }
        return $data;
    }
    private static function unique($field, $param){
        $usuario = new Usuarios;
        $campo = strip_tags($_POST[$field]);
        $existe = $usuario->execute(new FindBy(field:$field, value:$campo));
        if($existe){
            setFlash($field, "Este {$field} já está cadastrado no nosso banco de dados.");
            return false;
        }        
        return $campo;
    }
    
    private static function existe($field, $param){
        $usuario = new Usuarios;
        $campo = strip_tags($_POST[$field]);
        $existe = $usuario->execute(new FindBy(field:$field, value:$campo));
        if(!$existe){
            setFlash($field, "Este {$field} não está cadastrado no nosso banco de dados.");
            return false;
        }        
        return $campo;
    }

}