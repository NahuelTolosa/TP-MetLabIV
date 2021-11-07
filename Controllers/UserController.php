<?php namespace Controllers;

use DAO\DAOdB\UserDAO as UserDAO;
use DAO\DAOdB\CompanyDAO as CompanyDAO;
use DAO\DAOJson\StudentDAO;
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
        if($password != $passwordValidate) $this->ShowSignInView("<h5 style='color: #f00;'>Las contraseñas ingresadas no coinciden.</h5>");
   
        $studentID = $this->doesStudentExistOnJSON($email);
        $companyID = $this->doesCompanyExistOnDB($email);

        if($studentID){
            ($this->userDAO)->Add(new User($studentID,$email,$password, "ST"));
            $this->ShowLogInView("<h5 style='color: #072'>Ususario creado exitosamente.</h5>");
        }else if($companyID){
            ($this->userDAO)->Add(new User($companyID,$email,$password, "CO"));
            $this->ShowLogInView("<h5 style='color: #072'>Ususario creado exitosamente.</h5>");
        }else $this->ShowSignInView("<h5 style='color: #f00; width:50%; margin: auto;'>El usuario con ese mail no existe o se encuentra inactivo en el sistema.</h5>");
    }
    
    public function doesStudentExistOnJSON($email)
    {
        $studentDAO = new StudentDAO();
        foreach (($studentDAO)->GetAll() as $student) {
            if($student->getEmail() == $email && $student->getActive()) return $student->getStudentId();
        }
        return null;
    }

    public function doesCompanyExistOnDB($email)
    {
        $companyDAO = new CompanyDAO();
        $companyList = $companyDAO->GetAll();
        foreach($companyList as $company)
        {
            if($company->getEmail() == $email) return $company->getIdCompany();
        }
        return false;
    }

}

?>