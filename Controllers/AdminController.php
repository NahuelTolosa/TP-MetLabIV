<?php
namespace Controllers;

use Models\Company;
use Models\Student as Student;

    /*
        A. Administrar la información de las empresas. Puede ingresar nuevas
           empresas a la aplicación, modificarlas o eliminar una empresa.

        B. Cargar nuevas propuestas laborales en la plataforma.

        C. Ver el alumno propuesto para una oferta laboral.

        D. Crear nuevos usuarios dentro de la aplicación.
    */

    class AdminController
    {
        private $companyController;

        public function __construct()
        {
            $companyController = new CompanyController();
        }

        public function ShowAddOfferView()
        {
            // require_once(VIEWS_PATH."jobOffer-add.php");
        }

        public function ShowAddCompanyView()
        {
            require_once(VIEWS_PATH."company-add.php");
        }

        public function ShowAddStudentView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }


        public function AddStudent()
        {
            $student = new Student();
            $student->setStudentId($_POST["studentId"]);
            $student->setCareerId($_POST["careerId"]);
            $student->setFirstName($_POST["firstName"]);
            $student->setLastName($_POST["lastName"]);
            $student->setDni($_POST["dni"]);
            $student->setFileNumber($_POST["fileNumber"]);
            $student->setGender($_POST["gender"]);
            $student->setBirthDate($_POST["birthDate"]);
            $student->setEmail($_POST["email"]);
            $student->setPhoneNumber($_POST["phoneNumber"]);
            $student->setActive($_POST["active"]);

            $this->studentDAO->Add($student);

            //$this->ShowAddView();
        }

        public function ShowPersonalInfo(){
            require_once(VIEWS_PATH."student-showPersonalInfo.php");
        }

        public function AddCompany(){
            $name = $_POST["name"];
            $cuit = $_POST["cuit"];
            $phone = $_POST["phoneNumber"];
            $email = $_POST["email"];

            $this->companyController->Add($name, $cuit, $phone, $email);
        }

        public function DeleteCompany(){
            $companiesDeleted = array();
            $companyId = $_POST["companyId"];
            $this->companyController->Delete($companyId);
        }
    }
?>