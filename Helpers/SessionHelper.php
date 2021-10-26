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
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
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
    public static function SetSessionUser($user){
        SessionHelper::SetSession('loggedUser', $user);
        return (SessionHelper::IsSession('loggedUser')) ? true : false;
    }
}

?>