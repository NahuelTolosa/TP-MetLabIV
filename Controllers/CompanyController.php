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
            // require_once(VIEWS_PATH."company-add.php");
        }

        public function ShowListView($message="")
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company-list.php");
        }

        public function Add($name, $cuit, $phoneNumber, $email)
        {
            $company = new Company();
            $company->setName($name);
            $company->setCuit($cuit);
            $company->setPhoneNumber($phoneNumber);
            $company->setEmail($email);

            $this->companyDAO->Add($company);

            $this->ShowAddView();
        }

        public function Delete($companyId){
            if($companyDAO->idExist($companyId)){
                $companyDAO->Delete($companyId);
                $message = "Delete successful";
                $this->ShowListView($message);
            }else{
                $message = "ERROR 404";
                $this->ShowListView($message);
            }
        }

        public function Update($name, $cuit, $phoneNumber, $email){
           //ToDo
        }
    }
?>