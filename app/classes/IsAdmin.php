<?php
namespace app\classes;

class IsAdmin{
    public static function isAdmin(string|int|null $verificar = null, string|int $parametro = 1){
        if($verificar == null){
            return false;
        }
        if($verificar != $parametro){
            return false;
        }
        return true;
    }
}