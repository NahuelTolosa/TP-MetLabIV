<?php namespace DAO;

use Models\Company as Company;
use DAO\JobOfferDAO as JobOfferDAO;

class CompanyDAO{


    private $companyList = array();


    public function Add(Company $company)
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

    
}

?>