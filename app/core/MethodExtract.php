<?php
namespace app\core;

class MethodExtract{
    public static function extract($controller, string $method){
        $uri = Uri::uri();
        $method = strtolower(Uri::uriExiste($uri, 1));
        $method = "index";

        if($method === ''){
            $method = "index";
        }

        if(!method_exists($controller, $method)){
            $method = "index";
        }else{
            $method = $method;
        }
        
        return $method;
    }
}