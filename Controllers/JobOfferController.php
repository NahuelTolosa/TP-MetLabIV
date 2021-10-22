<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
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
            require_once(VIEWS_PATH."jobOffer-add.php");
        }

        public function ShowListView($message="")
        {
            $jobOfferList = $this->jobOfferDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-list.php");
        }
        /**************************************************************/


        public function Add($tittle,$company,$description,$salary)
        {
            $companyController = new CompanyController();

            $company = $companyController->getCompany($_POST['company']);

            $message="";

            if($company != null){

                $joboffer = new JobOffer();
                $joboffer->setTittle($tittle);
                $joboffer->setIdCompany($company->getIdCompany());
                $joboffer->setDescription($description);
                $joboffer->setSalary($salary);
                $joboffer->setTime('a');

                ($this->jobOfferDAO)->Add($joboffer);
                $message = "<h4 style='color: #072'>Oferta de trabajo dada de alta con éxito</h4>";
            }else{
                
                $message = "<p style='color: #f00'>La empresa ingresada no existe en el sistema</p>";

            }
            
            $this->ShowAddView($message);
        }

    }
    
?>