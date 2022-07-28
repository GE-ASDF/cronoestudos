<?php
namespace app\models;

use Exception;
use PDOException;
use app\models\database\Connection;
use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordInterfaceExecute;

class FindAll implements ActiveRecordInterfaceExecute{

    public function __construct(
        private array $where = [],
        private string|int $limit = '',
        private string|int $offset = '',
        private string $fields = "*",
        private $group = ""
    )
    {
        
    }

    public function execute(ActiveRecordInterface $ActiveRecordInterface)
    {
        try{
            $con = Connection::connect();
            $query = $this->createQuery($ActiveRecordInterface);
            $prepare = $con->prepare($query);
            $prepare->execute($this->where);
            return $prepare->fetchAll();
        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }
    private function createQuery($activeRecordInterface){
        if(count($this->where) > 1){
            throw new Exception("O where só pode ter um parâmetro");
        }
        $where = array_keys($this->where);
        $sql = "SELECT {$this->fields} FROM {$activeRecordInterface->getTable()} ";
        $sql.= (!$this->where) ? "":" WHERE {$where[0]} = :{$where[0]}";
        $sql.= (!$this->limit) ? "": " LIMIT {$this->limit} = :{$this->limit} ";
        $sql.= (!$this->offset) ? "": " OFFSET {$this->offset} = :{$this->offset}";
        $sql.= (!$this->group) ? "": " GROUP BY {$this->group}";
        return $sql;
    }
}