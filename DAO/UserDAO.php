<?php namespace DAO;

use Models\User as User;
use DataBase\Connection as Connection;
use PDOException as PDOException;

class UserDAO{
    private $tableName = "USERS";
    private $connection;

    private $usersList;

    public function Add($user)
    {
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (id,userName,password)
                      VALUES(:id,:userName,:password);";

            $value['id'] = $user->getId();
            $value['userName'] = $user->getUserName();
            $value['password'] = $user->getPassword();

            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query, $value);
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function GetAll()
    {
        $userList = array();
        $response = null;
        try{
            $query = "SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            foreach($result as $value){
                $user = new User();
                $user->getId($value['id']);
                $user->getUserName($value['userName']);
                $user->getPassword($value['password']);

                array_push($studentList, $user);
            }
        $response = $userList;
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }
    
    public function Delete($id)
    {
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET active = 0 WHERE id = :id;"; //estaria bueno hacer un join con una tabla de deleted
            $this->connection = Connection::GetInstance();
            $value['id'] = $id;
            $response = $this->connection->ExecuteNonQuery($query,$value); //devuelvo filas afectadas
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function Update($user)
    {
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET userName= :userName, password= :password WHERE id = :id;";
            //ToDo
            
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }
    
}

?>