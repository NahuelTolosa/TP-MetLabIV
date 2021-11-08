<?php
    namespace Controllers;

    use DAO\DAOdB\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
    use DAO\DAOdB\JobOfferDAO;
    use DAO\DAOJson\JobPositionDAO;

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

        public function ShowDeleteView($companyName,$companyID)
        {
            require_once(VIEWS_PATH."company-delete.php");
        }
        
        public function ShowModify($companyID)
        {   
            $company = $this->companyDAO->GetByID($companyID);
            
            require_once(VIEWS_PATH."company-modify.php");
        }

        public function ShowPersonalInfo(){
            $jobPositionDAO = new JobPositionDAO();
            require_once(VIEWS_PATH."company-showPersonalInfo.php");

        }
        
        public function Add($name, $cuit, $phoneNumber, $email)
        {
            if($this->doesCompanyExist($name,$cuit)){
                $message = "<h4 style='color: crimson'>Compañia ya registrada en el sistema</h4>";
            }
            else {
                $company = new Company();
                $company->setName($name);
                $company->setCuit($cuit);
                $company->setPhoneNumber($phoneNumber);
                $company->setEmail($email);
            
                ($this->companyDAO)->Add($company);
                $message = "<h4 style='color: #072'>Compañía dada de alta con éxito</h4>";
            }
            $this->ShowListView($message);
        }

        public function DeleteCompany($companyID)
        {
            $this->companyDAO->Delete($companyID);
            $message = "<h4 style='color: #072'>Compañía dada de baja con éxito</h4>";
            $this->ShowListView($message);
        }
    
        public function doesCompanyExist($name,$cuit)
        {
            foreach($this->companyDAO->GetAll() as $localCompany)
            {
                if($localCompany->getName()==$name && 
                    $localCompany->getCuit()==$cuit)
                {
                    return true;
                }
            }
            return false;
        }

        public function getCompany($id)
        {
            foreach($this->companyDAO->GetAll() as $localCompany)
            {
                if($localCompany->getIdCompany()==$id)
                {
                    return $localCompany;
                }
            }
            return null;
        }

        public function getCompanyById($id)
        {
            foreach($this->companyDAO->GetAll() as $localCompany)
            {
                if($localCompany->getIdCompany()==$id)
                {
                    return $localCompany;
                }
            }
            return null;
        }
        
        public function Update($idCompany, $name, $cuit, $phoneNumber, $email)
        {   
            $company = new Company();
            $company->setIdCompany($idCompany);
            $company->setName($name);
            $company->setCuit($cuit);
            $company->setPhoneNumber($phoneNumber);
            $company->setEmail($email);

            
            $this->companyDAO->Update($company);

            $message = "<h4 style='color: #072'>Compañía modificada con éxito</h4>";
            
            $this->ShowListView($message);
        }
    }
?>