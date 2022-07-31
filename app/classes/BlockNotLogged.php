<?php
namespace app\classes;

class BlockNotLogged{
    public static function block($controller, array $blockMethods){
        $methodToBlock = Block::getMethodsTolock($controller, $blockMethods);
        
        if(!isset($_SESSION[SESSION_LOGIN]) and $methodToBlock){
            return redirect(URL_BASE . "login");
        }
    }
}