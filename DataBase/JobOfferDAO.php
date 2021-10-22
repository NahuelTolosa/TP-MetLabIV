<?php
namespace DataBase;

use Models\JobOffer as JobOffer;
use DataBase\Connection as Connection;
use PDOException as PDOException;

class JobOfferDAO{  
    private $tableName = "JOBOFFERS";
    private $connection;

    public function Add($jobOffer){
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (idCompany,creationDate,descriptionJob,salary,active,postulations)
                      VALUES(:idCompany,:creationDate,:descriptionJob,:salary,:active,:postulations);";

            $value['idCompany'] = $jobOffer->getIdCompany();
            $value['creationDate'] = $jobOffer->getCreationDate();
            $value['descriptionJob'] = $jobOffer->getDescription();
            $value['salary'] = $jobOffer->getSalary();
            $value['active'] = $jobOffer->isActive();
            $value['postulations'] = $jobOffer->getPostulations();

            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query, $value);
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }
    
    public function GetAll(){
        $jobOfferList = array();
        $response = null;
        try{
            $query = "SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            foreach($result as $value){
                $jobOffer = new JobOffer();
                $jobOffer->getIdCompany($value['idCompany']);
                $jobOffer->getCreationDate($value['creationDate']);
                $jobOffer->getDescription($value['descriptionJob']);
                $jobOffer->getSalary($value['salary']);
                $jobOffer->isActive($value['active']);
                $jobOffer->getPostulations($value['postulations']);

                array_push($jobOfferList, $jobOffer);
            }
        $response = $jobOfferList;
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function Delete($jobOfferID){
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET active = 0 WHERE idCompany = :idCompany;"; 
            $this->connection = Connection::GetInstance();
            $value['idCompany'] = $jobOfferID; //me hace ruido que no tenga id offer
            $response = $this->connection->ExecuteNonQuery($query,$value); 
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function Update($jobOffer){
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET creationDate= :creationDate,
                     descriptionJob= :descriptionJob,salary= :salary, active= :active,postulations= :postulations
                     WHERE idCompany= :idCompany;"; 
            $this->connection = Connection::GetInstance();
            $value['idCompany'] = $jobOffer->getIdCompany();
            $value['creationDate'] = $jobOffer->getCreationDate();
            $value['descriptionJob'] = $jobOffer->getDescription();
            $value['salary'] = $jobOffer->getSalary();
            $value['active'] = $jobOffer->isActive();
            $value['postulations'] = $jobOffer->getPostulations();
            $response = $this->connection->ExecuteNonQuery($query,$value); 
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }
}
?>