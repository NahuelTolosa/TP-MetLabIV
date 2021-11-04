<?php namespace Controllers;

use DAO\DAOdB\UserDAO as UserDAO;
use Models\User as User;
use Helpers\SessionHelper as SessionHelper;

class LogInController
    {
        private $userLog;

        public function __construct()
        {
            $this->userLog = new User();
        }

        public function UserLogged($username, $password){
            $isSession = $this->ValidateLogIn($username, $password);
            die(var_dump($isSession));
            
        }
        
        public function ValidateLogIn($username, $password){
            $isSession = false;
            $user = $this->UserExists($username);        //return username, pass and userIdDb
            if(!empty($user)){
                
                $response = $this->PasswordValidate($user, $password);
                
                if($response) $isSession = SessionHelper::SetSessionUser($user);      //seteo user session
                $this->RedirectLogIn($isSession, $user);  //response and session key
            }
            return $isSession;
        }

        public function UserExists($username){
            $userDAO = new UserDAO();
            return $userDAO->GetByEmail2($username); //getByUser return object or null
        }

        public function PasswordValidate($user, $password){
           return ($user->getUserPassword() == $password) ? true : false; 
        }

        public function RedirectLogIn($isSession, $sessionKey){
            // die(var_dump($_SESSION));
            if($isSession && SessionHelper::GetValue($sessionKey) == $sessionKey){
                $userCheck = $_SESSION['loggedUser'];
                if(substr($userCheck->getId(),0,2) == "ST"){
                    require_once(VIEWS_PATH."student-showPersonalInfo.php");
                }
                else if (substr($userCheck->getId(),0,2) == "AD") require_once(VIEWS_PATH."admin-showPersonalInfo.php"); //ToDo
                else if (substr($userCheck->getId(),0,2) == "CM") require_once(VIEWS_PATH."company-showPersonalInfo.php");
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