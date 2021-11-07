<?php
namespace DAO\DAOdB;

use Models\Company as Company;
use DAO\DAOdB\Connection as Connection;
use PDOException as PDOException;

class CompanyDAO implements IDAO{  
    private $tableName = "COMPANIES";
    private $connection;
    private static $compDAO = null;

    public static function GetInstance(){
        return ((self::$compDAO == null) ? self::$compDAO = new CompanyDAO() : self::$compDAO);
    }

    public function Add($company){
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (idCompany,nameFantasy,cuit,phoneNumber,email,jobOffers,isActive)
                      VALUES(:idCompany,:nameFantasy,:cuit,:phoneNumber,:email,:jobOffers,:isActive);";

            $value['idCompany'] = $company->getIdCompany();
            $value['nameFantasy'] = $company->getName();
            $value['cuit'] = $company->getCuit();
            $value['phoneNumber'] = $company->getPhoneNumber();
            $value['email'] = $company->getEmail();
            $value['jobOffers'] = $company->getJobOffers();
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
                $company->setName($value['nameFantasy']);
                $company->setCuit($value['cuit']);
                $company->setPhoneNumber($value['phoneNumber']);
                $company->setEmail($value['email']);
                $company->setJobOffers($value['jobOffers']);
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
            $query = "UPDATE ".$this->tableName." SET nameFantasy= :nameFantasy,cuit= :cuit,
                     phoneNumber= :phoneNumber, email= :email,jobOffers= :jobOffers,isActive= :isActive
                     WHERE idCompany= :idCompany;"; 
            $this->connection = Connection::GetInstance();
            $value['idCompany'] = $company->getIdCompany();
            $value['nameFantasy'] = $company->getName();
            $value['cuit'] = $company->getCuit();
            $value['phoneNumber'] = $company->getPhoneNumber();
            $value['email'] = $company->getEmail();
            $value['jobOffers'] = $company->getJobOffers();
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