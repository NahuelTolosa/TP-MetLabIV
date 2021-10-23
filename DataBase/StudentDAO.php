<?php
namespace DataBase;

use Models\Student as Student;
use DataBase\Connection as Connection;
use PDOException as PDOException;

class StudentDAO implements IDAO{
    private $tableName = "STUDENTS";
    private $connection;

    public function Add($student){
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (studentId,careerId,firstName,lastName,dni,fileNumber,gender,birthDate,email,phoneNumber,active)
                      VALUES(:studentId,:careerId,:firstName,:lastName,:dni,:fileNumber,:gender,:birthDate,:email,:phoneNumber,:active);";

            $value['studentId'] = $student->getStudentId();
            $value['careerId'] = $student->getCareerId();
            $value['firstName'] = $student->getFirstName();
            $value['lastName'] = $student->getLastName();
            $value['dni'] = $student->getDni();
            $value['fileNumber'] = $student->getFileNumber();
            $value['gender'] = $student->getGender();
            $value['birthDate'] = $student->getBirthDate();
            $value['email'] = $student->getEmail();
            $value['phoneNumber'] = $student->getPhoneNumber();
            $value['active'] = $student->getActive();

            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query, $value);
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function GetAll(){
        $studentList = array();
        $response = null;
         try{
            $query = "SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            foreach($result as $value){
                $student = new Student();
                $student->getStudentId($value['studentId']);
                $student->getCareerId($value['careerId']);
                $student->getFirstName($value['firstName']);
                $student->getLastName($value['lastName']);
                $student->getDni($value['dni']);
                $student->getFileNumber($value['fileNumber']);
                $student->getGender($value['gender']);
                $student->getBirthDate($value['birthDate']);
                $student->getEmail($value['email']);
                $student->getPhoneNumber($value['phoneNumber']);
                $student->getActive($value['active']);

                array_push($studentList, $student);
            }
        $response = $studentList;
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function Delete($studentID){
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET active = 0 WHERE studentId = :studenId;"; //estaria bueno hacer un join con una tabla de deleted
            $this->connection = Connection::GetInstance();
            $value['studentId'] = $studentID;
            $response = $this->connection->ExecuteNonQuery($query,$value); //devuelvo filas afectadas
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function Update($student){
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET firstName= :firstName, lastName= :lastName WHERE studentId = :studentId;";
            //ToDo
            
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }
}
?>