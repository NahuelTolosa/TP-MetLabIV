<?php
namespace Helpers;

class SessionHelper{

    /**
     * return session status
     */
    public static function IsSession($key = ""){
        return (isset($_SESSION[$key])) ? true : false;
    }

    /**
     * check key and return session value or false
     */
    public static function GetValue($key){
        return (!is_null($_SESSION['loggedUser'])) ? true : false;
    }

    public static function DestroySession(){
        session_destroy();
    }

    /**
     * set session with value and key 
     */
    public static function SetSession($key, $value){
        
        $_SESSION[$key] = $value;
    }

    /**
     * set session with user value
     */
    public static function SetSessionUser($key,$value){
        SessionHelper::SetSession($key, $value);
        return (SessionHelper::IsSession($key)) ? true : false;
    }
}

?>