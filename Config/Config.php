<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/TP-MetlabIV/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("API_URL_STUDENT", 'https://utn-students-api.herokuapp.com/api/Student');
define("API_URL_CAREER", 'https://utn-students-api.herokuapp.com/api/Career');
define("API_KEY", 'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08');

define("ADMIN", "admin@utn.com");
?>