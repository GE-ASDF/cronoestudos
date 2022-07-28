<?php

$idusuario = isset($_SESSION[SESSION_LOGIN]) ? $_SESSION[SESSION_LOGIN]->idusuario:null;
define("IDUSUARIO", $idusuario);