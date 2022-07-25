<?php
namespace app\interfaces;

use app\interfaces\ActiveRecordInterfaceExecute;

interface ActiveRecordInterface{
    public function getTable();
    public function __set($atributos, $valor);
    public function execute(ActiveRecordInterfaceExecute $activeRecordExecuteInterface);
    public function __get($atributos);
    public function getAtributos();
}