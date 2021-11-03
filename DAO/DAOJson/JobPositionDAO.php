<?php

    namespace DAO\DAOJson;  

    use Models\JobPosition as JobPosition;

    class JobPositionDAO implements IDAO
    {

        private $jobPositions=array();


        public function Add($student)
        {
           // viene de la API: no se puede agregar
        }

        public function GetAll()
        {
            $this->RetrieveData();
            
            return $this->jobPositions;
        }

        public function Delete($object) 
        {
            // viene de la API: no se puede borrar
        }
    
        public function Update($object) 
        {
            // viene de la API: no se puede actualizar
        }
        
        private function SaveData()
        {
            // viene de la API: no se puede guardar
        }

        private function RetrieveData()
        {
            
            $apiJobPosition = curl_init();

            curl_setopt($apiJobPosition, CURLOPT_URL, API_URL_JOBPOSITION);
            curl_setopt($apiJobPosition, CURLOPT_HTTPHEADER, array(API_KEY));
            curl_setopt($apiJobPosition, CURLOPT_RETURNTRANSFER, true);
            
            $arrayToDecode =json_decode(curl_exec($apiJobPosition), true);
            
            foreach($arrayToDecode as $valuesArray)
            {
                $jobPosition = new JobPosition();
                $jobPosition->setjobPositionId($valuesArray["jobPositionId"]);
                $jobPosition->setcareerId($valuesArray["careerId"]);
                $jobPosition->setdescription($valuesArray["description"]);
                
                array_push($this->jobPositions, $jobPosition);
            }
            
        }
    }
    

?>