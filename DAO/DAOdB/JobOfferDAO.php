<?php
namespace DAO\DAOdB;

use Models\JobOffer as JobOffer;
use DAO\DAOdB\Connection as Connection;
use PDOException as PDOException;

class JobOfferDAO implements IDAO{  
    private $tableName = "joboffers";
    private $connection;
    private static $joDAO = null;

    public static function GetInstance(){
        return ((self::$joDAO == null) ? self::$joDAO = new JobOfferDAO() : self::$joDAO);
    }

    public function Add($jobOffer){
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (offerID, tittle,idCompany,creationDate,description,salary,workDay,active,reference)
                      VALUES(:offerID,:tittle,:idCompany,:creationDate,:description,:salary,:workDay,:active,:reference);";

            $value['offerID'] = $jobOffer->getOfferID();
            $value['tittle'] = $jobOffer->getTittle();
            $value['idCompany'] = $jobOffer->getIdCompany();
            $value['creationDate'] = $jobOffer->getDate();
            $value['description'] = $jobOffer->getDescription();
            $value['salary'] = $jobOffer->getSalary();
            $value['workDay'] = $jobOffer->getWorkDay();
            $value['active'] = $jobOffer->getActive();
            $value['reference'] = $jobOffer->getReference();
            // die(var_dump($value));
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
                $jobOffer->setOfferID($value['offerID']);
                $jobOffer->setTittle($value['tittle']);
                $jobOffer->setIdCompany($value['idCompany']);
                $jobOffer->setDate($value['creationDate']);
                $jobOffer->setDescription($value['description']);
                $jobOffer->setSalary($value['salary']);
                $jobOffer->setWorkDay($value['workDay']);
                $jobOffer->setActive($value['active']);
                $jobOffer->setReference($value['reference']);
                $jobOffer->setPostulations($this->GetEmailsByOfferID($value['offerID']));
                
                array_push($jobOfferList, $jobOffer);
            }
        $response = $jobOfferList;
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function GetFiltered($filter){
        $jobOfferList = array();
        $response = null;
        try{
            $query = "SELECT * FROM ".$this->tableName." WHERE active=1;";
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
            foreach($result as $value){

                if($value['reference'] == $filter){

                    $jobOffer = new JobOffer();
                    $jobOffer->setOfferID($value['offerID']);
                    $jobOffer->setTittle($value['tittle']);
                    $jobOffer->setIdCompany($value['idCompany']);
                    $jobOffer->setDate($value['creationDate']);
                    $jobOffer->setDescription($value['description']);
                    $jobOffer->setSalary($value['salary']);
                    $jobOffer->setWorkDay($value['workDay']);
                    $jobOffer->setActive($value['active']);
                    $jobOffer->setReference($value['reference']);
                    $jobOffer->setPostulations($this->GetEmailsByOfferID($value['offerID']));
                    
                    array_push($jobOfferList, $jobOffer);
                }
            }
        $response = $jobOfferList;
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function GetEmailsByOfferID($offerID){

        $response = null;

        try{
            $query = "select users.userName from postulations as p inner join users on p.idUser = users.id where idJobOffer =".$offerID;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            $response = $result[0];

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
            $query = "UPDATE ".$this->tableName." SET   idCompany= :idCompany, tittle= :tittle, creationDate= :creationDate,
                     description= :description, salary= :salary, workDay= :workDay, active= :active, reference= :reference
                     WHERE offerID= :offerID;"; 
            $this->connection = Connection::GetInstance();
            $value['offerID'] = $jobOffer->getOfferID();
            $value['idCompany'] = $jobOffer->getIdCompany();
            $value['tittle']= $jobOffer->getTittle();
            $value['creationDate'] = $jobOffer->getDate();
            $value['description'] = $jobOffer->getDescription();
            $value['salary'] = $jobOffer->getSalary();
            $value['workDay'] = $jobOffer->getWorkDay();
            $value['active'] = true;
            $value['reference'] = 0;
            $response = $this->connection->ExecuteNonQuery($query,$value); 
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            
            return $response;
        }
    }

    public function GetById($idJobOffer){
        $parameters = array();
        $response = null;
        $user = null;

        $query = "SELECT * FROM " . $this->tableName . " WHERE offerID='" . $idJobOffer . "';";

        //$parameters['userName'] = $email;

        

        $jobOffer=new JobOffer();

        if($idJobOffer != null){
            $parameters = array();
            $this->connection = Connection::GetInstance();
            $response = null;
            $user = null;
            
            $query = "SELECT * FROM " . $this->tableName . " WHERE offerID='" . $idJobOffer . "';";
            
            try{

            $value = $this->connection->Exec($query, $parameters);

            $value[0]['active'] = $this->ActiveToBoolean($value[0]['active']);


            if($value[0]['active']){ 

                $jobOffer->setOfferID($value[0]['offerID']);
                $jobOffer->setTittle($value[0]['tittle']);
                $jobOffer->setIdCompany($value[0]['idCompany']);
                $jobOffer->setDate($value[0]['creationDate']);
                $jobOffer->setDescription($value[0]['description']);
                $jobOffer->setSalary($value[0]['salary']);
                $jobOffer->setWorkDay($value[0]['workDay']);
                $jobOffer->setActive($value[0]['active']);
                $jobOffer->setReference($value[0]['reference']);

            }else if(!$value[0]['active']){
                return null;
            }

            return $jobOffer;
        } catch (PDOException $e) {

            return $e->getMessage();
        }
        
        }
    }



    private function ActiveToBoolean($str){
        return ($str=='1') ? true : false;
    }

    public function GetAllViable(){
        $jobOfferList = array();
        $response = null;
        try{
            $query = "Select * from ".$this->tableName." where active = 1 and offerID not in (Select postulations.idJobOffer from postulations);";
            // $query = "Select * from ".$this->tableName." where active = 1 ;"; // descomentar para que hayan mas de 1 postulacion por oferta
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
            foreach($result as $value){

                
                $jobOffer = new JobOffer();
                $jobOffer->setOfferID($value['offerID']);
                $jobOffer->setTittle($value['tittle']);
                $jobOffer->setIdCompany($value['idCompany']);
                $jobOffer->setDate($value['creationDate']);
                $jobOffer->setDescription($value['description']);
                $jobOffer->setSalary($value['salary']);
                $jobOffer->setWorkDay($value['workDay']);
                $jobOffer->setActive($value['active']);
                $jobOffer->setReference($value['reference']);
                $jobOffer->setPostulations($this->GetEmailsByOfferID($value['offerID']));
                
                array_push($jobOfferList, $jobOffer);
            }
        $response = $jobOfferList;
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }
}
?>