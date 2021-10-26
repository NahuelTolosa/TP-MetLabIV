<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;

    class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        public function doesUserExist($email)
        {

            foreach (($this->studentDAO)->GetAll() as $student) {
                if($student->getEmail() == $email)
                    return $student;
            }
            
            return null;
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
            require_once(VIEWS_PATH."student-showPersonalInfo.php");
        }
    }
?>