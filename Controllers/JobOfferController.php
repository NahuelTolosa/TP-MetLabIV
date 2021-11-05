<?php namespace Controllers;

use DAO\DAOdB\JobOfferDAO as JobOfferDAO;
use DAO\DAOJson\CompanyDAO;
use DAO\DAOJson\JobPositionDAO as JobPositionDAO;

use Models\JobOffer;

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

        public function ShowListView($message="")
        {
            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-list.php");
        }

        public function ShowDeleteView($tittle,$offerID){
            require_once(VIEWS_PATH."jobOffer-delete.php");
        }
        
        public function ShowModify($offerID)
        {   
            $jobOffer = ($this->jobOfferDAO)->GetByID($offerID);
            
            require_once(VIEWS_PATH."jobOffer-modify.php");
        }

        /**************************************************************/


        public function Add($tittle,$company,$salary,$workDay,$reference,$description)
        {
            $companyController = new CompanyController();

            $company = $companyController->getCompany($_POST['company']);// trae la compania de la bdd

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
            $this->jobOfferDAO->Delete($offerID);
            $message = "<h4 style='color: #072'>Oferta laboral dada de baja con éxito</h4>";
            $this->ShowListView($message);
        }

        public function Update($offerID,$tittle, $description, $salary, $workDay,$reference)
        {   
            $jobOffer = new JobOffer();
            $jobOffer->setOfferID($offerID);
            $jobOffer->setTittle($tittle);
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