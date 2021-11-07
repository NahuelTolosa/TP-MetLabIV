<?php
    namespace Controllers;

    use DAO\DAOJson\StudentDAO as StudentDAO;
    use Models\Student as Student;
    use DAO\DAOJson\CarreerDAO;
    use DAO\DAOdB\PostulationDAO;
    use DAO\DAOdB\JobOfferDAO;
    use DAO\DAOJson\CompanyDAO;
use DAO\DAOJson\JobPositionDAO;
use Models\JobOffer;

class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->postulationDAO = new PostulationDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowListView()
        {
            $studentList = $this->studentDAO->GetAll();
            
            
            require_once(VIEWS_PATH."student-list.php");
        }
        
        public function Add($recordId, $firstName, $lastName)
        {
            $student = new Student();
            $student->setStudentId($recordId);
            $student->setfirstName($firstName);
            $student->setLastName($lastName);
            
            $this->studentDAO->Add($student);
            
            $this->ShowAddView();
        }
        
        public function ShowPersonalInfo(){
        
            $careerDAO= new CarreerDAO();
            $offerDAO = new JobOfferDAO();
            $companyDAO = new CompanyDAO();
            $jobPositionDAO = new JobPositionDAO();
            
            $student= $this -> studentDAO->GetByEmail($_SESSION['loggedUser']->getUserName());

            $postulation = $this->postulationDAO->GetByUserID($_SESSION['loggedUser']->getId());
            $offer = (is_null($postulation)) ? null : $offerDAO->GetById($postulation->getIdJobOffer());

            require_once(VIEWS_PATH."student-showPersonalInfo.php");
        }
    }
?>