<?php
namespace app\controllers;

use app\classes\Api;
use app\core\Controller;
use app\core\Uri;
use PDOException;
use Throwable;

class ApiController extends Controller{

        public function __construct()
        {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST');
            header("Access-Control-Allow-Headers: X-Requested-With");
            header('Content-Type: text/html; charset=utf-8');
        }

    public function index(){
        Api::api();
    }

}