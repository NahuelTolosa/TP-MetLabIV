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
            $this->RedirectLogIn($isSession, 'loggedUser');  //response and session key
        }

        public function ValidateLogIn($username, $password){
            $isSession = false;
            $user = $this->UserExists($username);        //return username, pass and userIdDb
            
            if(!empty($user)){
                $response = $this->PasswordValidate($user, $password);
                if($response) $isSession = SessionHelper::SetSessionUser($user);      //seteo user session
            }
            return $isSession;
        }

        public function UserExists($username){
            $userDAO = new UserDAO();
            return $userDAO->GetByEmail2($username); //getByUser return object or null
        }

        public function PasswordValidate($user, $password){
           return ($user->getPassword() == $password) ? true : false; 
        }

        public function RedirectLogIn($isSession, $sessionKey){
            if($isSession && SessionHelper::GetValue($sessionKey) == $sessionKey){
                $userCheck = new User();
                if(substr($userCheck->getId(),0,2) == "ST") require_once(VIEWS_PATH."student-showPersonalInfo.php");
                else if (substr($userCheck->getId(),0,2) == "AD") require_once(VIEWS_PATH."admin-showPersonalInfo.php"); //ToDo
                else if (substr($userCheck->getId(),0,2) == "CM") require_once(VIEWS_PATH."company-showPersonalInfo.php");
            }else{
                $message = "Email o contraseña incorrecta";
                require_once(VIEWS_PATH."logIn"); 
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