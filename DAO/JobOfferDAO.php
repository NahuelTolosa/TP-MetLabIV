<?php namespace DAO;

use Models\JobOffer as JobOffer;

class JobOfferDAO{

    private $offersList = array();


    public function Add(JobOffer $offer)
    {
        $this->RetrieveData();
            
        array_push($this->offersList, $offer);

        $this->SaveData();
    }


    public function GetAll()
    {
        $this->RetrieveData();

        return $this->offersList;
    }


    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->offersList as $offer)
        {
            $valuesArray["idCompany"] = $offer->getIdCompany();
            $valuesArray["creationDate"] = $offer->getCreationDate();
            $valuesArray["description"] = $offer->getDescription();
            $valuesArray["salary"] = $offer->getSalary();
            $valuesArray["active"] = $offer->isActive();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/companies.json', $jsonContent);
    }


    private function RetrieveData()
    {
        $this->offersList = array();

        if(file_exists('Data/companies.json'))
        {
            $jsonContent = file_get_contents('Data/companies.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $offer = new JobOffer();
                $offer->setIdCompany($valuesArray["idCompany"]);
                $offer->setCreationDate($valuesArray["creationDate"]);
                $offer->setDescription($valuesArray["description"]);
                $offer->setSalary($valuesArray["salary"]);
                $offer->setActive($valuesArray["active"]);
            }
        }
    }

    public function getOffersByID($idCompany)
    {
        $this->RetrieveData();

        $response = array();

        foreach($this->offersList as $offer){

            if($offer['idCompany'] == $idCompany)
                array_push($response,$offer);

        }

        return $response;
    }

    public function getPostulations()
    {
        
    }
}

?>