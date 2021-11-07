<?php namespace Models;

class Company{

    private $idCompany;
    private $name;
    private $cuit;
    private $phoneNumber;
    private $email;
    private $jobOffers = array();
    private $isActive;

    function __construct()
    {
        //No es la forma mas óptima, pero sirve para esta primera entrega.
        $this->idCompany = rand(100000,999999);
        $this->isActive = true;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getCuit()
    {
        return $this->cuit;
    }

    public function setCuit($cuit)
    {
        $this->cuit = $cuit;

        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    } 

    public function getJobOffers()
    {
        return $this->jobOffers;
    }

    public function setJobOffers($jobOffers): self
    {
        $this->jobOffers = $jobOffers;

        return $this;
    }

    public function getIdCompany()
    {
        return $this->idCompany;
    }

    public function setIdCompany($idCompany): self
    {
        $this->idCompany = $idCompany;

        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    
}

?>