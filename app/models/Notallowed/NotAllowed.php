<?php
namespace app\models\Notallowed;

use app\core\Model;

class NotAllowed extends Model{
    
    private $table = "acessos_suspeitos";

    public function create(array $dados){
        $sql = "INSERT INTO {$this->table}(";
        $sql.= implode(", ", array_keys($dados)).") VALUES(";
        $sql.= ":" .implode(", :", array_keys($dados)).")";
        $prepare = $this->db->prepare($sql);

        foreach($dados as $key=>$dado){
            $prepare->bindValue(":".$key, $dado);
        }
        $cadastrado = $prepare->execute();
        return $cadastrado;
    }

}