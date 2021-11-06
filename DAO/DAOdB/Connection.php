<?php
namespace DAO\DAOdB;

use \PDO as PDO;
use DAO\DAOdB\QueryType as QueryType;
use Exception;
use PDOException as PDOException;

class Connection{
    private $pdo = null;
    private $pdoStatement = null;
    private static $instance = null;

    private function __construct()
    {
        try{	
            $this->pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            throw $e;
        }
    }

    public static function GetInstance(){
        return ((self::$instance == null) ? self::$instance = new Connection() : self::$instance);
    }

    public function Execute($query, $parameters = array(), $queryType = QueryType::Query){
        try{
            $this->Prepare($query);
            $this->BindParameters($parameters, $queryType);
            $this->pdoStatement->execute();
            return $this->pdoStatement->fetchAll();
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function ExecuteNonQuery($query, $parameters = array(), $queryType = QueryType::Query){
        try{
            $this->Prepare($query);
            $this->BindParameters($parameters, $queryType);
            
            $this->pdoStatement->execute();
            return $this->pdoStatement->rowCount();
        }catch(PDOException $e){
            return $e->getMessage();

        }
    }

    public function Prepare($query){
        try{
            $this->pdoStatement = $this->pdo->prepare($query);

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function BindParameters($parameters = array(), $queryType = QueryType::Query){
        $i = 0;
        foreach($parameters as $parameterName => $value){
            $i++;
            if($queryType == QueryType::Query){
                $this->pdoStatement->bindParam(":".$parameterName, $parameters[$parameterName]); 
            }else{
                $this->pdoStatement->bindParam($i,$parameters[$parameterName]);
            }
        }
    }

    public function Exec($query, $parameters = array())
    {
        try{
            $this->pdoStatement = $this->pdo->prepare($query);

            foreach ($parameters as $key => $value) {
                $this->pdoStatement->bindParam(":".$value, $key);
            }

            $this->pdoStatement->execute();

            return $this->pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
}
?>