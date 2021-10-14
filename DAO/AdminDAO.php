<?php
namespace DAO;

use DAO\IDAO;
use Models\Admin as Admin;

class AdminDAO implements IDAO{

    private $adminList = array();

    public function Add($admin){
        $this->RetrieveData();
        $admin->setId($this->GetLastID()); //seteo id
        array_push($this->adminList, $admin);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->adminList;
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

        foreach($this->adminList as $admin)
        {
            $valuesArray["id"] = $admin->getId();
            $valuesArray["fistName"] = $admin->getName();
            $valuesArray["lastName"] = $admin->getlastName();
            $valuesArray["username"] = $admin->getUser();
            $valuesArray["password"] = $admin->getPassword();
            $valuesArray["email"] = $admin->getEmail();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents('Data/admins.json', $jsonContent);
    }


    private function RetrieveData()
    {
        $this->adminList = array();

        if(file_exists('Data/admins.json'))
        {
            $jsonContent = file_get_contents('Data/admins.json');

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray){
            $admin = new Admin();
            $admin->setId($valuesArray["id"]);
            $admin->setFirstName($valuesArray["firstName"]);
            $admin->setLastName($valuesArray["lastName"]);
            $admin->setUser($valuesArray["username"]);
            $admin->setPassword($valuesArray["password"]);
            $admin->setEmail($valuesArray["email"]);

            array_push($this->adminList, $admin);
            }
        }
    }

    private function GetLastID(){
        $adminRepository = new Admin();
        $length = count($adminRepository->GetAll());
        return ++$length; 
    }

}
?>