<?php namespace DAO;

use Models\JobOffer as JobOffer;

class JobOfferDAO implements IDAO{

    private $offersList = array();


    public function Add($offer)
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

    public function Delete($object) //ToDO
    {
        
    }

    public function Update($object) //ToDo
    {
        
    }
    
    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->offersList as $offer)
        {
            $valuesArray["idCompany"] = $offer->getIdCompany();
            $valuesArray["tittle"] = $offer->getTittle();
            $valuesArray["date"] = $offer->getDate();
            $valuesArray["description"] = $offer->getDescription();
            $valuesArray["salary"] = $offer->getSalary();
            $valuesArray["time"] = $offer->getTime();
            $valuesArray["postulations"] = $offer->getPostulations();
            $valuesArray["active"] = $offer->getActive();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/jobOffers.json', $jsonContent);
    }


    private function RetrieveData()
    {
        $this->offersList = array();

        if(file_exists('Data/jobOffers.json'))
        {
            $jsonContent = file_get_contents('Data/jobOffers.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $offer = new JobOffer();
                $offer->setIdCompany($valuesArray["idCompany"]);
                $offer->setTittle($valuesArray["tittle"]);
                $offer->setDate($valuesArray["date"]);
                $offer->setDescription($valuesArray["description"]);
                $offer->setSalary($valuesArray["salary"]);
                $offer->setTime($valuesArray["time"]);
                $offer->setPostulations($valuesArray["postulations"]);
                $offer->setActive($valuesArray["active"]);

                array_push($this->offersList,$offer);
            }
        }
    }

    public function getPostulations()
    {
        
    }
}

?>