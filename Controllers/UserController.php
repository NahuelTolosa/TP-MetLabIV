<?php namespace Controllers;

use DAO\DAOdB\UserDAO as UserDAO;
use Controllers\StudentController as StudentController;
use Models\User as User;

class UserController{
    
    private $userDAO;
    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function ShowSignInView($message="")
    {
        require_once(VIEWS_PATH."signIn.php");
    }

    public function ShowLogInView($message="")
    {
        require_once(VIEWS_PATH."logIn.php");
    }

    public function NewUser($email,$password,$passwordValidate)
    {
        $studentController = new StudentController();

        $studentID = $studentController->getByEmail($email);

        if($studentID != null){
            if($password != $passwordValidate)
                $this->ShowSignInView("<h5 style='color: #f00;'>Las contraseñas ingresadas no coinciden.</h5>");
            else{
                // $this->userDAO = new UserDAO();
                // ($this->userDAO)->Add(new User($studentID,$email,$password));
                $this->ShowLogInView("<h5 style='color: #072'>Ususario creado exitosamente.</h5>");
            }
        }else
            $this->ShowSignInView("<h5 style='color: #f00;'>No existe un estudiante registrado con ese email en el sistema.</h5>");
        
    }


}

?>