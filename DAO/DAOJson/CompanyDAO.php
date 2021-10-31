<?php namespace DAO\DAOJson;

use Models\Company as Company;
use DAO\DAOJson\JobOfferDAO as JobOfferDAO;

class CompanyDAO implements IDAO{

    private $companyList = array();

    public function Add($company)
    {
        $this->RetrieveData();
            
        array_push($this->companyList, $company);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->companyList;
    }

    public function Delete($companyID)
    {
        $this->RetrieveData();

        foreach($this->companyList as $company){
            
            if($company->getIdCompany() == $companyID){
                $company->setIsActive(false);
            }

        }

        $this->SaveData();
    }

    public function Update($object)
    {
        $this->RetrieveData();
        
        foreach($this->companyList as $company){
            if($company->getIdCompany() == $object->getIdCompany()){
                
            
            $company->setName($object->getName());
            $company->setCuit($object->getCuit());
            $company->setPhoneNumber($object->getPhoneNumber());
            $company->setEmail($object->getEmail());
            }
        }

        $this->SaveData();
    }
    
    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->companyList as $company)
        {
            
            $valuesArray["idCompany"] = $company->getIdCompany();
            $valuesArray["name"] = $company->getName();
            $valuesArray["cuit"] = $company->getCuit();
            $valuesArray["phoneNumber"] = $company->getPhoneNumber();
            $valuesArray["email"] = $company->getEmail();
            $valuesArray["isActive"] = $company->getIsActive();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/companies.json', $jsonContent);
    }

    private function RetrieveData()
    {
        $this->companyList = array();

        if(file_exists('Data/companies.json'))
        {
            $jsonContent = file_get_contents('Data/companies.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $company = new Company();
                $company->setIdCompany($valuesArray["idCompany"]);
                $company->setName($valuesArray["name"]);
                $company->setCuit($valuesArray["cuit"]);
                $company->setPhoneNumber($valuesArray["phoneNumber"]);
                $company->setEmail($valuesArray["email"]);
                $company->setIsActive($valuesArray["isActive"]);

                array_push($this->companyList, $company);
            }
        }
    }

    public function GetByID($companyID)
    {
        $this->RetrieveData();

        foreach($this->companyList as $company){ // Se puede cambiar a un for para retornar el indice
            if($company->getIdCompany() == $companyID){
                return $company;
            }
        }
    }


}

?>