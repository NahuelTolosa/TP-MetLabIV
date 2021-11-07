<?php namespace Helpers;

use DAO\DAOdB\ResetPasswordDAO as ResetPasswordDAO;
use PDOException as PDOException;
use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\PHPMailer\Exception as Exception;

require 'PhpMailer/Exception.php';
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';

class ResetPasswordHelper{
    
    /**
     * function that configures and send email
     */
    public static function EmailTo(string $email){
        $token = bin2hex(random_bytes(32)); //create token with 32 random hexadecimal bytes 

        try{
            $rows = ResetPasswordHelper::AddResetPasswordToDb($email, $token); //if we have changes on rows, send email
           
            if(!$rows) return false;

            $mail = new PHPMailer(true);
            $mail->CharSet =  "UTF-8";
            $mail->IsSMTP();
                // enable SMTP authentication
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
                // sets GMAIL as the SMTP server
            $mail->Host = "smtp.gmail.com";
                // set the SMTP port for the GMAIL server
            $mail->Port = "587"; 

            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->From = MAIL_USERNAME;
            $mail->FromName = 'Universidad Tecnológica Nacional';

            $mail->AddAddress($email);
                
            $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/".VIEWS_PATH . "resetPassword-show?token=$token";

            $mail->IsHTML(true); //format email to HTML
            $mail->Subject = 'Solicitud de cambio de contraseña';
            $mail->Body = "<h2>Solicitaste un cambio de contraseña para tu usuario</h2>
                                <h4>Para cambiar tu contraseña accede a este link: </h4> $url
                                <h4>Si usted no solicito un cambio de contraseña, solamente ingnore el mensaje</h4>";

            return ($mail->send()) ? true : false;
        }catch (Exception $e) {
            throw $e;
        }
    }
    

    /**
     * parameters: token generated on EmailTo and email 
     * validate email and add into the database
     */
    public static function AddResetPasswordToDb($emailResetPassword, $token){
        $response = null;
        try{
            $objectValidate = ResetPasswordHelper::GetByEmailToDb($emailResetPassword);
            if(!$objectValidate) return false;            //email doesn't exists
            else{
                $resetPasswordDb = new ResetPasswordDAO();
                $response = $resetPasswordDb->Add($objectValidate);  //add new object
            }
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

     public static function GetByEmailToDb($email){
        $resetPasswordDb = new ResetPasswordDAO();
        return $resetPasswordDb->GetByEmail($email);
    }

}