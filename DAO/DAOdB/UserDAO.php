<?php namespace DAO\DAOdB;

use Models\User as User;
use DAO\DAOdB\Connection as Connection;
use PDOException as PDOException;

class UserDAO{
    private $tableName = "users";
    private $connection;

    public function Add($user)
    {
       // die(var_dump($user));
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (id,userName,userPassword)
                      VALUES(:id,:userName,:userPassword);";

            $value['id'] = $user->getId();
            $value['userName'] = $user->getUserName();
            $value['userPassword'] = $user->getUserPassword();

            $this->connection = Connection::GetInstance();
            //die(var_dump($this->connection));
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
                $user->getUserPassword($value['userPassword']);

                array_push($userList, $user);
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
            $query = "UPDATE ".$this->tableName." SET userName= :userName, userPassword= :userPassword WHERE id = :id;";
            $this->connection = Connection::GetInstance();
            $value['id'] = $user->getId();
            $value['userName'] = $user->getUserName();
            $value['userPassword'] = $user->getPassword();

            $response = $this->connection->ExecuteNonQuery($query,$value); 
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function GetByEmail($email)
    {
        $userDAO = array();
        $response = null;
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE userName='" . $email . "';";
            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query);

            //die(var_dump($response));
            $user = new User();
            $user->getId($response['id']);
            $user->getUserName($response['userName']);
            $user->getUserPassword($response['userPassword']);

            array_push($userDAO, $response);
            $response = $userDAO;
        } catch (PDOException $e) {
            $response = $e->getMessage();
        } finally {
            return $response;
        }
    }
    public function GetByEmail2($email)
    {
        $parameters = array();
        $response = null;
        $user = null;
        
        $query = "SELECT * FROM " . $this->tableName . " WHERE userName='" . $email . "';";
        
        //$parameters['userName'] = $email;
        
        try {
            
            $this->connection = Connection::GetInstance();
            
            $response = $this->connection->Exec($query, $parameters);
            
            
            $user = new User();
            if(!empty($response)){

                $user->setId($response[0]['id']);
                $user->setUserName($response[0]['userName']);
                $user->setUserPassword($response[0]['userPassword']);
            }
            //  die(var_dump($user));
     
            return $user;
        } catch (PDOException $e) {
            die(var_dump($e->getMessage()));
            return $e->getMessage();
        }
    }

    
}

?>