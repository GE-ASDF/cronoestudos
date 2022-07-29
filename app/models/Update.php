<?php
namespace app\models;

use app\core\Model;

class Update extends Model{
    
    public function update(string $table, array $fields, $where, $parameter = "="){

        if(is_array($fields)){
            $sql = "UPDATE {$table} SET ";
            foreach($fields as $key => $valor){
                if($key != "idusuario"){
                    $sql.= $key ."= :{$key}, ";
                }
            }
            $sql = rtrim($sql, ", ");
            $sql.= " WHERE {$where} {$parameter} :{$where}";
            $prepare= $this->db->prepare($sql);
            foreach($fields as $key => $valor){ 
                $prepare->bindValue($key, $valor);
            }
            $prepare->execute();
            return $prepare->rowCount();
        }
        
    }

}