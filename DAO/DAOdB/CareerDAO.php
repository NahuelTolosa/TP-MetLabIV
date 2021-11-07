<?php
namespace DAO\DAOdB;

use Models\Career as Career;
use DAO\DAOdB\Connection;
use PDOException as PDOException;

class CareerDAO implements IDAO{  

    private $tableName = "CAREERS";
    private $connection;
    private static $caDAO = null;

    public static function GetInstance(){
        return ((self::$caDAO == null) ? self::$caDAO = new CareerDAO() : self::$caDAO);
    }

    public function Add($career){
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

    public function Update($career){
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
