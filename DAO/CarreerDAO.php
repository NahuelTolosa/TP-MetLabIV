<?php namespace DAO;

use Models\Carreer as Carreer;


class CarreerDAO{


    private $careerList = array();


    public function Add(Carreer $carreer)
    {
        $this->RetrieveData();
            
        array_push($this->careerList, $carreer);

        $this->SaveData();
    }


    public function GetAll()
    {
        $this->RetrieveData();

        return $this->careerList;
    }


    private function SaveData()
    {
        
    }


    private function RetrieveData()
    {
        $this->careerList = array();

        $apiCareer = curl_init();

        curl_setopt($apiCareer, CURLOPT_URL, API_URL_CAREER);
        curl_setopt($apiCareer, CURLOPT_HTTPHEADER, array(API_KEY));
        curl_setopt($apiCareer, CURLOPT_RETURNTRANSFER, true);
        
        $arrayToDecode =json_decode(curl_exec($apiCareer), true);

            foreach($arrayToDecode as $valuesArray)
            {
                $career = new Carreer();
                $career->setCareerId($valuesArray["careerId"]);
                $career->setDescription($valuesArray["description"]);
                $career->setActive($valuesArray["active"]);
                

                array_push($this->careerList, $career);
            }
        
    }

    public function getCareerByID($careerId){

        $this->RetrieveData();

        foreach($this->careerList as $career){
            if($career->getCareerId()==$careerId){
                return $career->getDescription();
            }
        }
    }
}