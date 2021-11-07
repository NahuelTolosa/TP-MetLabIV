<?php namespace DAO\DAOdB;

use Models\ResetPassword as ResetPassword;
use DAO\DAOdB\Connection as Connection;
use PDOException as PDOException;

class ResetPasswordDAO implements IDAOPW{
    private $tableName = "RESETPASSWORDS";
    private $connection;

    public function Add($emailToReset){
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (idResetPw,email,password,repeatPassword,token)
                      VALUES(:idResetPw,:email,:password,:repeatPassword,:token);";

            $value['idResetPw'] = $emailToReset->getIdResetPw();
            $value['email'] = $emailToReset->getEmail();
            $value['password'] = $emailToReset->getPassword();
            $value['repeatPassword'] = $emailToReset->getRepeatPassword();
            $value['token'] = $emailToReset->getToken();                //need save token for validate

            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query, $value);
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }


    public function Delete($token){
        $response = null;
        try{
            $query = "DELETE FROM ".$this->tableName." WHERE token='".$token."';";;
            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query);
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function GetByToken($token){
        $response = null;
        try{
            $query = "SELECT * INTO ".$this->tableName." WHERE token='".$token."';";;
            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query);
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function GetByEmail($email){
        $userResetPassword = array();
      //  $response = array();
        try{
            $query = "SELECT INTO ".$this->tableName." WHERE email='".$email."';";
            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query); 

                $resetPassword = new ResetPassword();
                $resetPassword->getIdResetPw($response['idResetPw']);
                $resetPassword->getEmail($response['email']);
                $resetPassword->getPassword($response['password']);
                $resetPassword->getRepeatPassword($response['repeatPassword']);
                $resetPassword->getToken($response['token']);
              return $resetPassword;
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
}
