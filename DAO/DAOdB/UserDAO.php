<?php namespace DAO\DAOdB;

use Models\User as User;
use DAO\DAOdB\Connection as Connection;
use PDOException as PDOException;

class UserDAO{
    private $tableName = "users";
    private $connection;
    private static $userDAO = null;

    public static function GetInstance(){
        return ((self::$userDAO == null) ? self::$userDAO = new UserDAO() : self::$userDAO);
    }

    public function Add($user)
    {
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (id,userName,userPassword)
                      VALUES(:id,:userName,:userPassword);";

            $value['id'] = $user->getId();
            $value['userName'] = $user->getUserName();
            $value['userPassword'] = $user->getUserPassword();

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
            $query = "UPDATE ".$this->tableName." SET active = 0 WHERE id = :id;"; 
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
            return $user;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    
}

?>