<?php
namespace app\classes;

use app\core\MethodExtract;

class Block{
    public static function getMethodsTolock($controller, array $blockMethods){
        $methods = get_class_methods($controller);
        [$actualMethod] = MethodExtract::extract($controller);
        $blockMethod = false;
        foreach($methods as $method){
            if(in_array($method, $blockMethods) and $method == $actualMethod){
                $blockMethod = true;
            }
        }
        return $blockMethod;
    }
}