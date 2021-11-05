<?php namespace DAO\DAOdB;

use Models\Postulation;
use DAO\DAOdB\Connection as Connection;
use PDOException as PDOException;

class PostulationDAO{
    private $tableName = "postulations"; //revisar
    private $connection;

    public function Add($idPostulation, $idUser)
    {
       // die(var_dump($user));
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (idPostulation, idUser)
                      VALUES(:idPostulation,:idUser);";

            $value['idPostulation'] = $idPostulation;
            $value['idUser'] = $idUser;

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
        $postulationsList = array();
        $response = null;
        try{
            $query = "SELECT * FROM ".$this->tableName;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query); //probar con Exec($query)

            foreach($result as $value){
                $postulation = new Postulation();
                $postulation->getIdPostulation($value['idPostulations']);
                $postulation->getIdUser($value['idUser']);
                $postulation->getIdJobOffer($value['idJobOffer']);

                array_push($postulationsList, $postulation);
            }
        $response = $postulationsList;
        }catch (PDOException $e){
            $response = $e->getMessage();
            // validar si el usuario ya esta postulado reportar mensaje pertinente
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

    public function GetByUserID($idUser)
    {
        
        $parameters = array();
        $response = null;
        $postulation = null;
        
        $query = "SELECT * FROM " . $this->tableName . " WHERE idUser='" . $idUser . "';";
        
        //$parameters['userName'] = $email;
        
        try {
            
            $this->connection = Connection::GetInstance();
            
            $response = $this->connection->Exec($query, $parameters);
            
            
            $postulation = new Postulation();
            if(!empty($response)){

                $postulation->setIdPostulation($response[0]['idPostulations']);
                $postulation->setIdUser($response[0]['idUser']);
                $postulation->setIdJobOffer($response[0]['idJobOffer']);
            }
            //  die(var_dump($user));
     
            return $postulation;
        } catch (PDOException $e) {
            die(var_dump($e->getMessage()));
            return $e->getMessage();
        }
    
    }
}