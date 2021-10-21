<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;

    class JobOfferController
    {
        private $jobOfferDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
        }
    

        /**************************************************************/
        public function ShowAddView()
        {
            require_once(VIEWS_PATH."jobOffer-add.php");
        }

        public function ShowListView($message="")
        {
            $jobOfferList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."jobOffer-list.php");
        }
        /**************************************************************/


        public function ValidateCompany()
        {
            if(true/*Si la empresa existe*/){
                $this->Add();
            }else{
                /*Mostrar mensaje de que no existe*/
                require_once(VIEWS_PATH."jobOffer-add.php");
            }
            
        }

        public function Add()
        {
            /*Agregar la oferta laboral*/
        }
    }
    
?>