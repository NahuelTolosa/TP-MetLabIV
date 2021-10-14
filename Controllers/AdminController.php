<?php
namespace Controllers;

use DAO\AdminDAO as AdminDAO;
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
        private $adminDAO; 

        public function __construct()
        {
            $this->adminDAO = new AdminDAO();
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
    }
?>