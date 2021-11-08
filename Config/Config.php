<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/TP-MetlabIV/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("API_URL_STUDENT", 'https://utn-students-api.herokuapp.com/api/Student');
define("API_URL_CAREER", 'https://utn-students-api.herokuapp.com/api/Career');
define("API_URL_JOBPOSITION", 'https://utn-students-api.herokuapp.com/api/JobPosition');
define("API_KEY", 'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08');

define("ADMIN", "admin@utn.com");

define("DB_HOST" , "localhost");
define("DB_NAME" , "dbutn");
define("DB_USER" , "root");
define("DB_PASS" , "");

define("MAIL_USERNAME", "utnmdpjoboffer@gmail.com");
define("MAIL_PASSWORD", "utnmdp123");
?>