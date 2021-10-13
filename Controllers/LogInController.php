<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;

    class LogInController
    {
        public function ValidateLogIn($email = "")
        {
            $validation = $this->serchStudent($email);

            if(!is_null($validation)){
                
                $_SESSION["studentId"]=  $validation->getStudentId();
                $_SESSION["careerId"]= $validation->getCareerId();
                $_SESSION["firstName"]= $validation->getFirstName();
                $_SESSION["lastName"]= $validation->getLastName();
                $_SESSION["dni"]= $validation->getDni();
                $_SESSION["fileNumber"]= $validation->getFileNumber();
                $_SESSION["gender"]= $validation->getGender();
                $_SESSION["birthDate"]= $validation->getBirthDate();
                $_SESSION["email"]= $validation->getEmail();
                $_SESSION["phoneNumber"]= $validation->getPhoneNumber();
                $_SESSION["active"]=  $validation->getActive();

                require_once(VIEWS_PATH."student-menu.php");
            }
            else{
                $message="No hay estudiantes registrados con ese Email";
                require_once(VIEWS_PATH."logIn.php");
            }

            
        }

        private function serchStudent($email = "")
        {
            $studentDAO = new StudentDAO();
            $array = $studentDAO->GetAll();
            


            foreach($array as $localStudent){
                if($localStudent->getEmail() == $email){
                    return $localStudent;
                }
            }
            return null;
        }
    }
    
?>