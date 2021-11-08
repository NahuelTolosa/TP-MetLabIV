<?php
namespace Controllers;

use Models\Postulation;
use DAO\DAOdB\PostulationDAO;
use DAO\DAOJson\StudentDAO;
use DAO\DAOdB\UserDAO as UserDAO;
use DAO\DAOJson\CarreerDAO;
use DAO\DAOdB\JobOfferDAO;
use DAO\DAOJson\CompanyDAO;
use DAO\DAOJson\JobPositionDAO;


class PostulationController
{
    private $postulationDAO;

    public function __construct()
    {
        $this->postulationDAO = new PostulationDAO(); 
    }

    public function ApplyOffer($idJobOffer, $idUser)
    {
        
        $result = $this->postulationDAO->Add($idJobOffer, $idUser);

        $careerDAO= new CarreerDAO();
        $offerDAO = new JobOfferDAO();
        $companyDAO = new CompanyDAO();
        $studentDAO = new StudentDAO();

        $student=  $studentDAO->GetByEmail($_SESSION['loggedUser']->getUserName());

        $postulation = $this-> postulationDAO->GetByUserID($_SESSION['loggedUser']->getId());
        $offer = $offerDAO->GetById($postulation->getIdJobOffer());


        $message = $this->setMessage($result);
        
        $jobPositionDAO = new JobPositionDAO();
        
        $studentController = new StudentController();
        $studentController->ShowPersonalInfo();
        
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
        $jobPositionDAO = new JobPositionDAO();

        $student=  $studentDAO->GetByEmail($_SESSION['loggedUser']->getUserName());

        $postulation = $this->postulationDAO->GetByUserID($_SESSION['loggedUser']->getId());
        $offer = (is_null($postulation)) ? null :$offerDAO->GetById($postulation->getIdJobOffer());

        require_once(VIEWS_PATH."student-showPersonalInfo.php");
    }
    
}


?>