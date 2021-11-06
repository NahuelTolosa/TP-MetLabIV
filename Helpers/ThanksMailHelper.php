<?php namespace Helpers;
use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\PHPMailer\Exception as Exception;

require 'PhpMailer/Exception.php';
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';

class ThanksMailHelper{
    /**
     * function that configures and send email
     */
    public static function SendEmail($usersEmail){
        try{
            if(empty($usersEmail)) return false;
                
            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Host = "smtp.gmail.com";
            $mail->Port = "587"; //or 465

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

            //return ($mail->send()) ? true : false;
            if ($mail->send()){
                echo "esssssito";
            }else{
                echo "F";
            }
        }catch (Exception $e) {
            throw $e;
        }
    }

}