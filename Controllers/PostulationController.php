<?php
namespace Controllers;

use Models\Postulation;

class PostulationController
{
    private $postulationDAO;

    public function __construct()
    {
        //$this->postulationDAO = new PostulationDAO(); 
    }

    public function ApplyOffer($idPostulation, $idUser)
    {
        $this->postulationDAO->Add($idPostulation, $idUser);

    }
}


?>