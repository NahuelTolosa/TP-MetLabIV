<?php namespace DAO\DAOdB;

use Models\ResetPassword as ResetPassword;
use DAO\DAOdB\Connection as Connection;
use PDOException as PDOException;

class ResetPasswordDAO implements IDAOPW{
    private $tableName = "RESETPASSWORDS";
    private $connection;

    public function Add(ResetPassword $emailToReset){
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
        $response = null;
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
                array_push($userResetPassword, $resetPassword);
                $response = $userResetPassword;
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }
    
    
  /*  public function Update(ResetPassword $emailToReset){
        $response = null;
        try{
            $query = "UPDATE ".$this->tableName." SET idResetPw= :idResetPw, email= :email,password= :password
            ,repeatPassword= :repeatPassword WHERE token='".$emailToReset->getToken()."';";;
            $this->connection = Connection::GetInstance();
            $value['idResetPw'] = $emailToReset->getIdResetPw();
            $value['email'] = $emailToReset->getEmail();
            $value['password'] = $emailToReset->getPassword();
            $value['repeatPassword'] = $emailToReset->getRepeatPassword();
            $value['token'] = $emailToReset->getToken();          

            $response = $this->connection->ExecuteNonQuery($query,$value); 
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }
*/
   /* 
   
    public function GetAll(){ 
        $resetPasswordList = array();
        $response = null;
        try{
            $query = "SELECT * INTO ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $response = $this->connection->ExecuteNonQuery($query);

            foreach($response as $value){
                $resetPassword = new ResetPassword();
                $resetPassword->getIdResetPw($value['idResetPw']);
                $resetPassword->getEmail($value['email']);
                $resetPassword->getPassword($value['password']);
                $resetPassword->getRepeatPassword($value['repeatPassword']);
                $resetPassword->getToken($value['token']);
            
                array_push($resetPasswordList, $resetPassword);
        }
        $response = $resetPasswordList;
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }*/
}
