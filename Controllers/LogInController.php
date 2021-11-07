<?php namespace Controllers;

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
                
                if($response) $isSession = SessionHelper::SetSessionUser($user);      //seteo user session
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

                if(substr($userCheck->getId(),0,2) == "ST"){
                    $studentDAO=new StudentDAO();
                    $student= $studentDAO->GetByEmail($_SESSION['loggedUser']->getUserName());
                    $careerDAO= new CarreerDAO();
                    $studentC = new StudentController();
    
                    // aunque no se deba lo hicimos de esta forma para forzar la carga de daos necesarios para mostrar informacion del student
                    $studentC->ShowPersonalInfo();
                }
                else if (substr($userCheck->getId(),0,2) == "AD") require_once(VIEWS_PATH."admin-menu.php"); //ToDo
                else if (substr($userCheck->getId(),0,2) == "CO") require_once(VIEWS_PATH."company-showPersonalInfo.php");
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