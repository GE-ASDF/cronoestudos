<?php
namespace app\models;

use PDO;
use Throwable;
use app\core\Model;
use app\models\database\Connection;
use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordInterfaceExecute;

class FindBy implements ActiveRecordInterfaceExecute{
    
    public function __construct(private string $field, private string|int $value, private string $fields = "*")
    {
        
    }

    public function execute(ActiveRecordInterface $activeRecordInterface){

        try{
            $query = $this->createQuery($activeRecordInterface);
            $con = Connection::connect();
            $prepare = $con->prepare($query);
            $prepare->execute([
                $this->field => $this->value,
            ]);
            return $prepare->fetch(PDO::FETCH_OBJ);
        }catch(Throwable $throw){
            var_dump($throw->getMessage());
        }
        
    }

    private function createQuery($activeRecordInterface)
    {
        $sql = "SELECT {$this->fields} FROM {$activeRecordInterface->getTable()} WHERE {$this->field} = :{$this->field}";
        return $sql;
    }

}