<?php

function setFlash($key, $message, $alert = "danger"){
    if(!isset($_SESSION["message"][$key])){
        $_SESSION["message"][$key] = [
            "message" => $message,
            "alert" => $alert
        ];
    }
}

function getFlash($key){
    if(isset($_SESSION["message"][$key])){
        $flash = $_SESSION["message"][$key];
        unset($_SESSION["message"][$key]);
        return "<span class='alert alert-{$flash['alert']}'>{$flash['message']}</span>";
    }
}