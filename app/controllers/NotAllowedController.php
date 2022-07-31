<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Notallowed\NotAllowed;

class NotAllowedController extends Controller{
    
    public function index(){
        $notAllowed = new NotAllowed;
        $notAllowedIp = array();
        $ip = filter_var($_SERVER["REMOTE_ADDR"], FILTER_VALIDATE_IP);
        $notAllowedIp = ([
            "ip"=>$ip,
            "data"=>date("Y-m-d H:i:s")
        ]);
        $notAllowed->create($notAllowedIp);
        $dados["title"] = "Not allowed";
        $dados["view"] = "formularios/NotAllowed/403";
        $this->load("formularios/NotAllowed/403", $dados);
    }

}