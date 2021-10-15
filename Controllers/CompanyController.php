<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."company-add.php");
        }

        public function ShowListView($message="")
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company-list.php");
        }

        public function ShowDeleteView($companyName,$companyID){
            require_once(VIEWS_PATH."company-delete.php");
        }

        public function Add($name, $cuit, $phoneNumber, $email)
        {
            $company = new Company();
            $company->setName($name);
            $company->setCuit($cuit);
            $company->setPhoneNumber($phoneNumber);
            $company->setEmail($email);

             $this->companyDAO->Add($company);

            $message = "<h4 style='color: #072'>Compañía dada de alta con éxito</h4>";

            $this->ShowListView($message);
        }

        public function DeleteCompany($companyID){
            $this->companyDAO->Delete($companyID);
            $message = "<h4 style='color: #072'>Compañía dada de baja con éxito</h4>";
            $this->ShowListView($message);
        }
    }
?>