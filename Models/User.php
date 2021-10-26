<?php namespace Models;

class User{

    private $userName;
    private $password;
    private $id;

    function __construct()
	{
		$params = func_get_args();
		$num_params = func_num_args();
		$function_constructor ='__construct'.$num_params;
		if (method_exists($this,$function_constructor)) {
			call_user_func_array(array($this,$function_constructor),$params);
		}
	}
  
	function __construct0()
	{

	}

    function __construct3($id,$email,$password)
	{
		$this->id = $this->generateID($id);
        $this->userName = $email;
        $this->password = $password;
	}

    private function generateID($id)
    {
        return "ST".$id.chr(rand(ord('A'),ord('Z')));
    }

    /**
     * Get the value of userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     */
    public function setUserName($userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}

?>