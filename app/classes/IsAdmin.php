<?php
namespace app\classes;

class IsAdmin{
    public static function isAdmin(){
        $colaborador = $_SESSION[SESSION_LOGIN]->colaborador;
        if($colaborador == null){
            return false;
        }
        if($colaborador != 1){
            return false;
        }
        return true;
    }
}