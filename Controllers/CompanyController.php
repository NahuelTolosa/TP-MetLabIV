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

        public function ShowListView()
        {
            // $studentList = $this->studentDAO->GetAll();

            // require_once(VIEWS_PATH."company-list.php");
        }

        public function Add($name, $cuit, $phoneNumber, $email)
        {
            $company = new Company();
            $company->setName($name);
            $company->setCuit($cuit);
            $company->setPhoneNumber($phoneNumber);
            $company->setEmail($email);

            // $this->companyDAO->Add($company);

            $this->ShowAddView();
        }
    }
?>