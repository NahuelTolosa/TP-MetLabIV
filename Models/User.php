<?php namespace Models;

class User{

    private $userName;
    private $userPassword;
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

    function __construct3($id,$email,$password, $type)
	{
		$this->id = $this->generateID($id, $type);
        $this->userName = $email;
        $this->userPassword = $password;
	}

    private function generateID($id, $type)
    {
        if($type == "ST") return "ST".$id.chr(rand(ord('A'),ord('Z')));
        if($type == "CO") return "CO".$id.chr(rand(ord('A'),ord('Z')));
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
    public function setUserName($userName)
    {
        $this->userName = $userName;

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

    /**
     * Get the value of userPassword
     */ 
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set the value of userPassword
     *
     * @return  self
     */ 
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }
}

?>