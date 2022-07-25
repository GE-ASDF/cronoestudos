<?php
namespace app\models;

use Throwable;
use app\models\database\Connection;
use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordInterfaceExecute;

class Insert implements ActiveRecordInterfaceExecute{

    public function __construct(private array $dados)
    {
        
    }

    public function execute(ActiveRecordInterface $activeRecordInterface){
        try{
            $query = $this->createQuery($activeRecordInterface);
            $conn = Connection::connect();
            $prepare = $conn->prepare($query);
            return $prepare->execute($activeRecordInterface->getAtributos());
        }catch(Throwable $e){   
            var_dump($e->getMessage());
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface){
        $sql = "INSERT INTO {$activeRecordInterface->getTable()}(";
        $sql.= implode(", ", array_keys($this->dados)).") VALUES(";
        $sql.= ":" .implode(", :", array_keys($activeRecordInterface->getAtributos())) .")";
        return $sql;
    }

}