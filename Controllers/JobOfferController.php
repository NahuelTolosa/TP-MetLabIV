<?php

namespace Controllers;

use DAO\DAOdB\PostulationDAO as PostulationDAO;
use DAO\DAOdB\JobOfferDAO as JobOfferDAO;
use DAO\DAOdB\UserDAO;
use DAO\DAOdB\CompanyDAO as CompanyDAO;
use DAO\DAOJson\JobPositionDAO as JobPositionDAO;
use Helpers\ThanksMailHelper as ThanksMailHelper;
use Helpers\Utils;
use Models\JobOffer as JobOffer;

class JobOfferController
{
    private $jobOfferDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
    }

    /**************************************************************/
    public function ShowAddView($message = "")
    {
        $jobPositionDAO = new JobPositionDAO();
        $jobPositionDAO->GetAll();
        $companyDAO = new CompanyDAO();
        require_once(VIEWS_PATH . "jobOffer-add.php");
    }


    public function ShowListView($message = "", $filter = "null")
    {
        $jobPositionDAO = new jobPositionDAO();
        $jobOfferDAO = JobOfferDAO::GetInstance();
        $postulationDAO = new PostulationDAO();
        $hasApplied =  false;

        if (Utils::isStudentLogged()  && !empty($postulationDAO->GetOfferByID($_SESSION['loggedUser']->getId()))) {
            $hasApplied =  true;
        }
        if ($message == "") {
            $jobOffers = $this->jobOfferDAO->GetAll();
            $jobOfferList = $jobOffers;
        } else {
            $jobOfferList = $this->jobOfferDAO->GetFiltered($message);
        }

        require_once(VIEWS_PATH . "jobOffer-list.php");

    }

    public function ShowDeleteView($tittle, $offerID)
    {
        require_once(VIEWS_PATH . "jobOffer-delete.php");
    }

    public function ShowModify($offerID)
    {
        $jobOfferDAO = (isset($this->jobOfferDAO)) ? $this->jobOfferDAO : new JobOfferDAO();
        $jobOffer = ($this->jobOfferDAO)->GetByID($offerID);
        require_once(VIEWS_PATH . "jobOffer-modify.php");
    }

    public function ShowAllUserOfferView($tittle, $offerID)
    {
        $postulationDAO = PostulationDAO::GetInstance();
        $userList = $this->jobOfferDAO->GetEmailsByOfferID($offerID);
        require_once(VIEWS_PATH . "jobOffer-userPostulation.php");
    }

    public function ShowDropOfferUserView($userName, $offerID)
    {
        require_once(VIEWS_PATH . "jobOffer-dropUserPostulation.php");
    }

    /**************************************************************/


    public function Add($tittle, $company, $salary, $workDay, $reference, $description)
    {
        $companyController = new CompanyController();
        $company = (isset($_SESSION['company]'])) ? $_SESSION['company]'] : $companyController->getCompany($_POST['company']); // trae la compania de la db en caso de que este agregando la oferta un admin
        $message = "";

        if ($company != null) {
            $joboffer = new JobOffer();
            $joboffer->setTittle($tittle);
            $joboffer->setIdCompany($company->getIdCompany());
            $joboffer->setDescription($description);
            $joboffer->setSalary($salary);
            $joboffer->setWorkDay($workDay);
            $joboffer->setReference($reference);

            ($this->jobOfferDAO)->Add($joboffer);
            $message = "<h4 style='color: #072'>Oferta de trabajo dada de alta con éxito</h4>";
        } else {
            $message = "<p style='color: #f00'>La empresa ingresada no existe en el sistema</p>";
        }

        $this->ShowAddView($message);
    }

    public function DeleteOffer($offerID)
    {
        $row = $this->jobOfferDAO->Delete($offerID);
        $message = "";
        if ($row) {
            $usersPostulation = $this->jobOfferDAO->GetEmailsByOfferID($offerID);  //get all email postulations 
            $body = $this->MessageDeleteOffer();
            $response = ThanksMailHelper::SendEmail($body,"Fin de oferta laboral", $usersPostulation);
            if($response) $message = "<h4 style='color: #072'>Oferta laboral dada de baja con éxito</h4>
                                      <h4 style='color: #072'>Email enviado correctamente </h4>";
        }
        if(Utils::isCompanyLogged()){
            $jobOfferDAO = new JobOfferDAO();
            $_SESSION['company']->setJoboffers($jobOfferDAO->GetByCompanyID($_SESSION['loggedUser']->GetNumerID()));
            $companyController = new CompanyController();
            $companyController->ShowPersonalInfo();
        }else{
            $this->ShowListView($message);
        }
        
    }

    public function MessageDeleteOffer()
    {
        $body = "<h2>Muchas gracias por haberte postulado en la oferta de trabajo</h2>
                                <h4>Te comentamos que la oferta finalizó y estarán en proceso de evaluación 
                                aquellas personas que hayan aplicado.</h4> 
                                <h4>Muchas gracias por tenernos en cuenta.</h4>
                                <h4>Un cordial saludo,</h4>
                                <h3>Universidad Tecnológica Nacional.</h3>";
        return $body;
    }

    public function Update($offerID,  $tittle, $description, $salary, $workDay, $companyID, $reference = 0)
    {
        $jobOffer = new JobOffer();
        $jobOffer->setOfferID($offerID);
        $jobOffer->setTittle($tittle);
        $jobOffer->setIdCompany($companyID);
        $jobOffer->setDescription($description);
        $jobOffer->setSalary($salary);
        $jobOffer->setWorkDay($workDay);
        $jobOffer->setReference($reference);

        $this->jobOfferDAO->Update($jobOffer);

        $message = "<h4 style='color: #072'>Oferta Laboral modificada con éxito</h4>";

        $this->ShowListView($message);
    }

    public function DropOfferUser($userName)
    {
        $userDAO = new UserDAO();
        $user = $this->userDAO->GetByEmail($userName);
        $row = $this->postulationDAO->Delete($user->getId);
        $message = "";
        if ($row){
            $body = $this->MessageDropOfferUser();
            $response = ThanksMailHelper::SendEmail($body,"Baja en oferta laboral",$userName);
            if($response) $message = "<h4 style='color: #072'>Usuario dado de baja con éxito</h4>
                                    <h4 style='color: #072'>Email enviado correctamente </h4>";
        }
        $this->ShowListView($message);
    }

    public function MessageDropOfferUser(){
        $body = "<h2>Buenos dias,</h2>
                                <h4>Te comentamos que la oferta a la cual aplicó, no cumplia con los requisitos
                                necesarios, por lo tanto fue dado de baja.</h4> 
                                <h4>Disculpa las molestias y muchas gracias por tenernos en cuenta.</h4>
                                <h4>Un cordial saludo,</h4>
                                <h3>Universidad Tecnológica Nacional.</h3>";
        return $body;
    }

}
