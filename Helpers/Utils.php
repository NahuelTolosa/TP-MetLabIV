<?php namespace Helpers;

class Utils{

    public static function isAdminLogged(){

        return (substr($_SESSION['loggedUser']->getId(),0,2) == "AD") ? true : false;
    }

    public static function isCompanyLogged(){
        return (substr($_SESSION['loggedUser']->getId(),0,2) == "CO") ? true : false;
    }

    public static function isStudentLogged(){
        return (substr($_SESSION['loggedUser']->getId(),0,2) == "ST") ? true : false;
    }
}

?>