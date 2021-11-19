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
    public static function SendEmail($body, $subject, $usersEmail){
        
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
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            
        }catch (Exception $e) {
            throw $e;
        }
    }

}