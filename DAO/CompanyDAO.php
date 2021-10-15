<?php namespace DAO;

use Models\Company as Company;
use DAO\JobOfferDAO as JobOfferDAO;

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

    public function Delete($idObject) //actualizo json sin company, pero me queda una lista de companydeleted sin json
    {
        $companiesDeleted = array();
        $this->RetrieveData();
        
        foreach($this->companyList as $company){
            if($idObject == $company->getIdCompany()){
                $company->setIsActive = false;
                array_push($companiesDeleted, $company);
            }
        }
        $this->SaveData();        
    }

    public function Update($object) 
    {
        $companyList = array();
        $this->RetrieveData();
        
        foreach($this->companyList as $company){
            if($company->getIdCompany() == $object->getIdCompany()){
                $company = $object;
            }                      
            array_push($companyList, $company);                                            
        }
        $this->SaveData();
    }
    
    private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->companyList as $company)
            {
                $valuesArray["name"] = $company->getName();
                $valuesArray["cuit"] = $company->getCuit();
                $valuesArray["phoneNumber"] = $company->getPhoneNumber();
                $valuesArray["email"] = $company->getEmail();

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
                $company->setName($valuesArray["name"]);
                $company->setCuit($valuesArray["cuit"]);
                $company->setPhoneNumber($valuesArray["phoneNumber"]);
                $company->setEmail($valuesArray["email"]);

                $offerDAO = new JobOfferDAO();

                $company->setJobOffers($offerDAO->getOffersByID($company->getIdCompany()));

                array_push($this->companyList, $company);
            }
        }
    }

    public function idExist($idToValidate){
        $companies = $this->GetAll();
        foreach($companies as $company){
            if($idToValidate == $company->getIdCompany()){
                return true;
            }
        }
        return false;
    }

    public function nameCompanyExist($name){
        $companies = $this->GetAll();
        foreach($companies as $company){
            if($name == $company->getName()){
                return true;
            }
        }
        return false;
    }
}

?>