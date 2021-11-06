<?php namespace Controllers;

use DAO\DAOdB\JobOfferDAO as JobOfferDAO;
use DAO\DAOJson\CompanyDAO as CompanyDAO;
use DAO\DAOJson\JobPositionDAO as JobPositionDAO;
use Helpers\ThanksMailHelper as ThanksMailHelper;
use Models\JobOffer as JobOffer;

class JobOfferController
    {
        private $jobOfferDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
        }
    

        /**************************************************************/
        public function ShowAddView($message="")
        {
            $jobPositionDAO= new JobPositionDAO();
            $jobPositionDAO->GetAll();
            $companyDAO = new CompanyDAO();
            


            require_once(VIEWS_PATH."jobOffer-add.php");
        }

        public function ShowListView($message="", $filter="null")
        {
            $jobOfferDAO = (isset ($this->jobOfferDAO)) ? $this->jobOfferDAO : new JobOfferDAO();
            $jobPositionDAO = new JobPositionDAO();

            if($filter == "null"){
                
                $jobOfferList = $this->jobOfferDAO->GetAll();
                
            }
            else{
                $jobOfferList = $this->jobOfferDAO->GetFiltered($filter);
            }

            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function ShowDeleteView($tittle,$offerID){
            require_once(VIEWS_PATH."jobOffer-delete.php");
        }
        
        public function ShowModify($offerID)
        {   
            $jobOfferDAO = (isset ($this->jobOfferDAO))? $this->jobOfferDAO : new JobOfferDAO();
            $jobOffer = ($this->jobOfferDAO)->GetByID($offerID);
            // die(var_dump($jobOffer));
            require_once(VIEWS_PATH."jobOffer-modify.php");
        }

        /**************************************************************/


        public function Add($tittle,$company,$salary,$workDay,$reference,$description)
        {
            $companyController = new CompanyController();
            $company = $companyController->getCompany($_POST['company']);// trae la compania de la api
            $message="";

            if($company != null){
                $joboffer = new JobOffer();
                $joboffer->setTittle($tittle);
                $joboffer->setIdCompany($company->getIdCompany());
                $joboffer->setDescription($description);
                $joboffer->setSalary($salary);
                $joboffer->setWorkDay($workDay);
                $joboffer->setReference($reference);

                ($this->jobOfferDAO)->Add($joboffer);
                $message = "<h4 style='color: #072'>Oferta de trabajo dada de alta con éxito</h4>";
            }else{
                $message = "<p style='color: #f00'>La empresa ingresada no existe en el sistema</p>";
            }
            $this->ShowAddView($message);
        }

        public function DeleteOffer($offerID)
        {
            $row = $this->jobOfferDAO->Delete($offerID);
            $message= "";
            if($row){
                $usersPostulation = $this->jobOfferDAO->GetEmailsByOfferID($offerID);  //get all email postulations 
                $response = ThanksMailHelper::SendEmail($usersPostulation);

                die(var_dump($response));

                $message = "<h4 style='color: #072'>Oferta laboral dada de baja con éxito</h4>";
            }
            $this->ShowListView($message);
        }

        public function Update($offerID,  $tittle, $description, $salary, $workDay,$companyID,$reference=0)
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
    }
    
?>