<?php
namespace DAO\DAOdB;

use Models\Company as Company;
use DAO\DAOdB\Connection as Connection;
use PDOException as PDOException;

class CompanyDAO implements IDAO{  
    private $tableName = "COMPANIES";
    private $connection;

    public function Add($company){
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (idCompany,name,cuit,phoneNumber,email,isActive)
                      VALUES(:idCompany,:name,:cuit,:phoneNumber,:email,:isActive);";

            $value['idCompany'] = $company->getIdCompany();
            $value['name'] = $company->getName();
            $value['cuit'] = $company->getCuit();
            $value['phoneNumber'] = $company->getPhoneNumber();
            $value['email'] = $company->getEmail();
            //$value['jobOffers'] = $company->getJobOffers();
            $value['isActive'] = $company->getIsActive();

            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query, $value);
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }
    
    public function GetAll(){
        $companyList = array();
        $response = null;
        try{
            $query = "SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            foreach($result as $value){
                $company = new Company();
                $company->setIdCompany($value['idCompany']);
                $company->setName($value['name']);
                $company->setCuit($value['cuit']);
                $company->setPhoneNumber($value['phoneNumber']);
                $company->setEmail($value['email']);
                //$company->setJobOffers($value['jobOffers']);
                $company->setIsActive($value['isActive']);

                array_push($companyList, $company);
            }
        $response = $companyList;
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function Delete($companyID){
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET active = 0 WHERE idCompany = :idCompany;"; 
            $this->connection = Connection::GetInstance();
            $value['idCompany'] = $companyID;
            $response = $this->connection->ExecuteNonQuery($query,$value); 
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function Update($company){
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET name= :name,cuit= :cuit,
                     phoneNumber= :phoneNumber, email= :email,isActive= :isActive
                     WHERE idCompany= :idCompany;"; 
            $this->connection = Connection::GetInstance();
            $value['idCompany'] = $company->getIdCompany();
            $value['name'] = $company->getName();
            $value['cuit'] = $company->getCuit();
            $value['phoneNumber'] = $company->getPhoneNumber();
            $value['email'] = $company->getEmail();
            //$value['jobOffers'] = $company->getJobOffers();
            $value['isActive'] = $company->getIsActive();
            $response = $this->connection->ExecuteNonQuery($query,$value); 
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }


}
?>