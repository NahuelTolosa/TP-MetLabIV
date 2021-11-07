<?php namespace DAO\DAOJson;

use Models\Career as Career;


class CarreerDAO{


    private $careerList = array();
    private static $caDAO = null;

    public static function GetInstance(){
        return ((self::$caDAO == null) ? self::$caDAO = new CarreerDAO() : self::$caDAO);
    }

    public function Add(Career $carreer)
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
                $career = new Career();
                $career->setCareerId($valuesArray["careerId"]);
                $career->setDescription($valuesArray["description"]);
                $career->setActive($valuesArray["active"]);
                

                array_push($this->careerList, $career);
            }
        
    }

    public function getCareerByID($careerId){

        $apiCareer = curl_init();

        curl_setopt($apiCareer, CURLOPT_URL, API_URL_CAREER);
        curl_setopt($apiCareer, CURLOPT_HTTPHEADER, array(API_KEY));
        curl_setopt($apiCareer, CURLOPT_RETURNTRANSFER, true);
        
        $arrayToDecode =json_decode(curl_exec($apiCareer), true);

            foreach($arrayToDecode as $valuesArray)
            {
                if($careerId == $valuesArray["careerId"]);
                    return $valuesArray["description"];
                
            }
    }
    
}