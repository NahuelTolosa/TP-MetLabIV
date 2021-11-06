<?php namespace Helpers;

use Exception as Exception;
use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
require_once 'vendor/autoload.php'; //libraries for use phpmailer

class ThanksMailHelper{
    /**
     * function that configures and send email
     */
    public static function SendEmail($usersEmail){
        try{
            if(empty($usersEmail)) return false;
                
            require_once('phpmail/PHPMailerAutoload.php');
            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtp.gmail.com";
            $mail->Port = "465"; //or 587

            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->From = MAIL_USERNAME;
            $mail->FromName = 'Universidad Tecnológica Nacional';
                    
            if (is_array($usersEmail)) {           //check if we have multiples users
                foreach ($usersEmail as $user) {
                    $mail->addAddress($user);
                }
            }else $mail->addAddress($usersEmail);
               
            $mail->IsHTML(true);                    //format email to HTML
            $mail->Subject = 'Fin de oferta laboral';
            $mail->Body = "<h2>Muchas gracias por haberte postulado en la oferta de trabajo</h2>
                                <h4>Te comentamos que la oferta finalizó y estarán en proceso de evaluación 
                                aquellas personas que hayan aplicado.</h4> 
                                <h4>Muchas gracias por tenernos en cuenta.</h4>
                                <h4>Un grato saludo,</h4>
                                <h4>Universidad Tecnológica Nacional.</h4>";

            return ($mail->send()) ? true : false;
        }catch (Exception $e) {
            throw $e;
        }
    }

}