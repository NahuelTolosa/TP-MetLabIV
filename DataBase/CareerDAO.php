<?php
namespace DataBase;

use Models\Career as Career;
use DataBase\Connection as Connection;
use PDOException as PDOException;

class CareerDAO{  

    private $tableName = "CAREERS";
    private $connection;

    public function Add(Career $career){
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (careerId,descriptionCareer,active)
                      VALUES(:careerId,:descriptionCareer,:active);";

            $value['careerId'] = $career->getCareerId();
            $value['descriptionCareer'] = $career->getDescription();
            $value['active'] = $career->getActive();

            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query, $value);
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }
    
    public function GetAll(){
        $careerList = array();
        $response = null;
        try{
            $query = "SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            foreach($result as $value){
                $career = new Career();
                $career->setCareerId($value['careerId']);
                $career->setDescription($value['descriptionCareer']);
                $career->setActive($value['active']);

                array_push($careerList, $career);
            }
            $response = $careerList;
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function Delete($careerID){
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET active = 0 WHERE careerId = :careerId;"; 
            $this->connection = Connection::GetInstance();
            $value['careerId'] = $careerID;
            $response = $this->connection->ExecuteNonQuery($query,$value); 
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function Update(Career $career){
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET descriptionCareer= :descriptionCareer, active= :active
                     WHERE careerId= :careerId;"; 
            $this->connection = Connection::GetInstance();

            $value['careerId'] = $career->getCareerId();
            $value['descriptionCareer'] = $career->getDescription();
            $value['active'] = $career->getActive();
        
            $response = $this->connection->ExecuteNonQuery($query,$value); 
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }


}
?>
