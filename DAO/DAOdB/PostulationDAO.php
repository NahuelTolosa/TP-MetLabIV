<?php namespace DAO\DAOdB;

use Models\Postulation;
use DAO\DAOdB\Connection as Connection;
use PDOException as PDOException;

class PostulationDAO{
    private $tableName = "postulations"; //revisar
    private $connection;

    public function Add($idJobOffer, $idUser)
    {
       // die(var_dump($user));
        $response = null;
        try{
            $query = "INSERT INTO ".$this->tableName." (idUser, idJobOffer)
                      VALUES(:idUser, :idJobOffer);";

            $value['idUser'] = $idUser;
            $value['idJobOffer'] = $idJobOffer;

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
    
    public function Delete($idUser)
    {
        $response = null;
        try{
            $query = "DELETE FROM ".$this->tableName." WHERE idUser = :idUser;";
            $this->connection = Connection::GetInstance();
            $value['idUser'] = $idUser;
            $response = $this->connection->Exec($query,$value);
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
        try {
            
            $this->connection = Connection::GetInstance();
            
            $response = $this->connection->Exec($query, $parameters);

            $postulation = new Postulation();
            if(!empty($response)){

                $postulation->setIdPostulation($response[0]['idPostulations']);
                $postulation->setIdUser($response[0]['idUser']);
                $postulation->setIdJobOffer($response[0]['idJobOffer']);
            }
            return $postulation;
        } catch (PDOException $e) {
            
            return $e->getMessage();
        }
    
    }
}