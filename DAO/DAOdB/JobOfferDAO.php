<?php
namespace DAO\DAOdB;

use Models\JobOffer as JobOffer;
use DAO\DAOdB\Connection as Connection;
use PDOException as PDOException;

class JobOfferDAO implements IDAO{  
    private $tableName = "JOBOFFERS";
    private $connection;

    public function Add($jobOffer){
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (offerID, idCompany,tittle,creationDate,descriptionJob,salary,workDay,active,postulations)
                      VALUES(:offerID,:idCompany,:tittle,:creationDate,:descriptionJob,:salary,:workDay,:active,:postulations);";

            $value['offerID'] = $jobOffer->getOfferID();
            $value['idCompany'] = $jobOffer->getIdCompany();
            $value['tittle'] = $jobOffer->getTittle();
            $value['creationDate'] = $jobOffer->getDate();
            $value['descriptionJob'] = $jobOffer->getDescription();
            $value['salary'] = $jobOffer->getSalary();
            $value['workDay'] = $jobOffer->getWorkDay();
            $value['active'] = $jobOffer->getActive();
            $value['reference'] = $jobOffer->getReference();
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
                $jobOffer->getOfferID($value['offerID']);
                $jobOffer->getIdCompany($value['idCompany']);
                $jobOffer->getTittle($value['tittle']);
                $jobOffer->getDate($value['creationDate']);
                $jobOffer->getDescription($value['descriptionJob']);
                $jobOffer->getSalary($value['salary']);
                $jobOffer->getWorkDay($value['workDay']);
                $jobOffer->getActive($value['active']);
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
            $query = "UPDATE ".$this->tableName." SET active = 0 WHERE offerID = :offerID;"; 
            $this->connection = Connection::GetInstance();
            $value['offerID'] = $jobOfferID;
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
            $query = "UPDATE ".$this->tableName." SET idCompany= :idCompany, tittle= :tittle, creationDate= :creationDate,
                     descriptionJob= :descriptionJob,salary= :salary, workDay= :workDay, active= :active,postulations= :postulations
                     WHERE offerID= :offerID;"; 
            $this->connection = Connection::GetInstance();
            $value['offerID'] = $jobOffer->getOfferID();
            $value['idCompany'] = $jobOffer->getIdCompany();
            $value['tittle']= $jobOffer->getTittle();
            $value['creationDate'] = $jobOffer->getDate();
            $value['descriptionJob'] = $jobOffer->getDescription();
            $value['salary'] = $jobOffer->getSalary();
            $value['workDay'] = $jobOffer->getWorkDay();
            $value['active'] = $jobOffer->getActive();
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