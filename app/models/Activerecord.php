<?php
namespace app\models;

use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordInterfaceExecute;
use ReflectionClass;

abstract class Activerecord implements ActiveRecordInterface{
    
    protected $table;
    protected $atributos = [];
    protected $valor;

    public function __construct()
    {
        if(!$this->table){
            $this->table = strtolower((new ReflectionClass($this))->getShortName());
        }
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getAtributos(){
        return $this->atributos;
    }

    public function __set($atributos, $valor)
    {
        $this->atributos[$atributos] = $valor;
    }
    public function __get($atributos)
    {
        return $atributos[$atributos];
    }
    public function execute(ActiveRecordInterfaceExecute $activeRecordInterfaceExecute){
        return $activeRecordInterfaceExecute->execute($this);
    }
}