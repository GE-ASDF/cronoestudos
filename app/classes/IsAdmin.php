<?php
namespace app\classes;

class IsAdmin{
    public static function isAdmin(string $verificar, string|int $parametro = 1){
        if($verificar != $parametro){
            return false;
        }
        return true;
    }
}