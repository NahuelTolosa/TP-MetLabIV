<?php
namespace Models;

class Postulation
{
    private $idPostulation;
    private $idUser;
    private $idJobOffer;

    public function __construct()
    {
        
    }

    

    /**
     * Get the value of idPostulation
     */ 
    public function getIdPostulation()
    {
        return $this->idPostulation;
    }

    /**
     * Set the value of idPostulation
     *
     * @return  self
     */ 
    public function setIdPostulation($idPostulation)
    {
        $this->idPostulation = $idPostulation;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of idJobOffer
     */ 
    public function getIdJobOffer()
    {
        return $this->idJobOffer;
    }

    /**
     * Set the value of idJobOffer
     *
     * @return  self
     */ 
    public function setIdJobOffer($idJobOffer)
    {
        $this->idJobOffer = $idJobOffer;

        return $this;
    }
}


?>