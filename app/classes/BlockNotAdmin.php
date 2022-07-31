<?php
namespace app\classes;

class BlockNotAdmin{

    public static function block($controller, array $methodsToBlock){
        $block = Block::getMethodsTolock($controller, $methodsToBlock);
        
        if(!IsAdmin::isAdmin() && $block){
            
            if(NotLogged::notLogged() && BlockRequestPostGet::block()){
                redirect(URL_BASE . "notallowed");
                die();
            }

            if(!IsAdmin::isAdmin() && BlockRequestPostGet::block()){
                redirect(URL_BASE . "notallowed");
                die(); 
            }

            if(!BlockRequestPostGet::block() && !IsAdmin::isAdmin() || NotLogged::notLogged()){
                return redirect(URL_BASE);
            }

        }
       
    }

}