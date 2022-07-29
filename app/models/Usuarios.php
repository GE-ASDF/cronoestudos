<?php
namespace app\models;

use Throwable;
use app\core\Model;
use app\models\tables\Usuarios AS userExecute;
use app\models\database\Connection;
use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordInterfaceExecute;
use PDO;

class Usuarios extends Model{

    public function eColaborador($idusuario){
        $sql = "SELECT * FROM usuarios WHERE idusuario= :idusuario";        
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue("idusuario", $idusuario);
        $prepare->execute();
        $usuario = $prepare->fetch(PDO::FETCH_OBJ);
        if($usuario->colaborador != 1){
            $sql = "UPDATE usuarios SET colaborador = 1 WHERE idusuario= :idusuario";
            $prepare = $this->db->prepare($sql);
            $prepare->bindValue("idusuario", $idusuario);
            $atualizado = $prepare->execute();
            return $atualizado;
        }else{
            $sql = "UPDATE usuarios SET colaborador = 0 WHERE idusuario= :idusuario";
            $prepare = $this->db->prepare($sql);
            $prepare->bindValue("idusuario", $idusuario);
            $atualizado = $prepare->execute();
            return $atualizado;
        }
    }
    
}