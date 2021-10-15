<?php namespace Models;

use Models\Person as Person;

class Admin extends Person{

    private $id;
    private $user;
    private $password;
    private $email;
    

    public function getPassword()
    {
        return $this->password;
    }
 
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}

?>