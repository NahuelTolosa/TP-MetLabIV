<?php
namespace Controllers;

use Models\Postulation;
use DAO\DAOdB\PostulationDAO;
use DAO\DAOJson\StudentDAO;
use DAO\DAOdB\UserDAO as UserDAO;
use DAO\DAOJson\CarreerDAO;
use DAO\DAOdB\JobOfferDAO;
use DAO\DAOJson\CompanyDAO;


class PostulationController
{
    private $postulationDAO;

    public function __construct()
    {
        $this->postulationDAO = new PostulationDAO(); 
    }

    public function ApplyOffer($idPostulation, $idUser)
    {
        
        $result = $this->postulationDAO->Add($idPostulation, $idUser);

        $careerDAO= new CarreerDAO();
        $offerDAO = new JobOfferDAO();
        $companyDAO = new CompanyDAO();
        $studentDAO = new StudentDAO();

        $student=  $studentDAO->GetByEmail($_SESSION['loggedUser']->getUserName());

        $postulation = $this-> postulationDAO->GetByUserID($_SESSION['loggedUser']->getId());
        $offer = $offerDAO->GetById($postulation->getIdJobOffer());


        $message = $this->setMessage($result);
        
        require_once(VIEWS_PATH."student-showPersonalInfo.php");
        
    }
    
    public function setMessage($result)
    {
        if($result){
            return "Aplicaste correctamente";
        }else{
            return "Error: ya tenes una aplicacion vigente";
        }
    }

    public function DropOffer($idUser){
        $this->postulationDAO->Delete($idUser);
        $dropMessage="<p>Usted fue dado de baja de la postulación.</p>";

        $careerDAO= new CarreerDAO();
        $offerDAO = new JobOfferDAO();
        $companyDAO = new CompanyDAO();
        $studentDAO = new StudentDAO();

        $student=  $studentDAO->GetByEmail($_SESSION['loggedUser']->getUserName());

        $postulation = $this->postulationDAO->GetByUserID($_SESSION['loggedUser']->getId());
        $offer = $offerDAO->GetById($postulation->getIdJobOffer());

        require_once(VIEWS_PATH."student-showPersonalInfo.php");
    }
}


?>