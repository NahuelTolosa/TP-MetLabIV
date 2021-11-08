<?php namespace Controllers;

use DAO\DAOdB\CompanyDAO;
use DAO\DAOdB\JobOfferDAO;
use DAO\DAOJson\JobPositionDAO;
use DAO\DAOdB\UserDAO as UserDAO;
use DAO\DAOJson\CarreerDAO;
use DAO\DAOJson\StudentDAO;
use Models\User as User;
use Helpers\SessionHelper as SessionHelper;

class LogInController
    {
        private $userLog;

        public function __construct()
        {
            $this->userLog = new User();
        }
        
        public function ValidateLogIn($username, $password){
            $isSession = false;

            $user = $this->UserExists($username);        //return username, pass and userIdDb
            if(!is_null($user)){
                
                $response = $this->PasswordValidate($user, $password);
                
                if($response) $isSession = SessionHelper::SetSessionUser("loggedUser",$user);      //seteo user session
            }
            $this->RedirectLogIn($isSession, $user);  //response and session key
            return $isSession;
        }

        public function UserExists($username){
            $userDAO = new UserDAO();
            return $userDAO->GetByEmail($username); //getByUser return object or null
        }

        public function PasswordValidate($user, $password){
           return ($user->getUserPassword() == $password) ? true : false; 
        }

        public function RedirectLogIn($isSession, $sessionKey){
            if($isSession && SessionHelper::GetValue($sessionKey) == $sessionKey){
                $userCheck = $_SESSION['loggedUser'];

                if (substr($userCheck->getId(),0,2) == "AD"){
                    require_once(VIEWS_PATH."admin-menu.php");
                } 
                elseif(substr($userCheck->getId(),0,2) == "ST"){
                    $studentDAO=new StudentDAO();
                    $student= $studentDAO->GetByEmail($_SESSION['loggedUser']->getUserName());
                    $careerDAO= new CarreerDAO();
                    $studentC = new StudentController();
    
                    // aunque no se deba lo hicimos de esta forma para forzar la carga de daos necesarios para mostrar informacion del student
                    $studentC->ShowPersonalInfo();
                }
                elseif (substr($userCheck->getId(),0,2) == "CO"){

                    $companyDAO = new CompanyDAO();
                    $jobOfferDAO = new JobOfferDAO();
                    $companyController = new CompanyController();

                    $company = $companyDAO->GetByID($_SESSION['loggedUser']->GetNumerID());
                    $company->setJoboffers($jobOfferDAO->GetByCompanyID($_SESSION['loggedUser']->GetNumerID()));

                    SessionHelper::SetSessionUser("company",$company); //seteo los datos de la empresa en cuestion
                    
                    $companyController->ShowPersonalInfo();
                    
                }
                 
            }else{
                $message = "Email o contraseña incorrecta";
                require_once(VIEWS_PATH."logIn.php"); 
            }
        }

        public function LogOut()
        {
            SessionHelper::DestroySession();
            $message= "Chau mil besos, mil besitos, vuelva pronto, mil besosss";
            require_once(VIEWS_PATH."logIn.php");
        }
    }
    
?>