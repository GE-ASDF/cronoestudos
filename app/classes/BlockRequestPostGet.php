<?php
namespace app\classes;

class BlockRequestPostGet{

    public static function block(){
        
        if($_SERVER["REQUEST_METHOD"] === 'POST' || $_SERVER["REQUEST_METHOD"] === 'GET'){
                redirect(URL_BASE . "notallowed");
                die();
            }
        }
}