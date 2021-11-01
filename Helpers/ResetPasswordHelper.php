<?php namespace Helpers;

use DAO\DAOdB\ResetPasswordDAO as ResetPasswordDAO;
use PDOException as PDOException;
use Models\ResetPassword as ResetPassword;
use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
require_once 'vendor/autoload.php'; //libraries for use phpmailer

class ResetPasswordHelper{
    
    /**
     * function that configures and send email
     */
    public static function EmailTo(string $email){
        $token = bin2hex(random_bytes(32)); //create token with 32 random hexadecimal bytes 

        try{
            $rows = ResetPasswordHelper::AddResetPasswordToDb($email, $token); //if we have changes on rows, send email
           
            if($rows){
                require_once('phpmail/PHPMailerAutoload.php');
                $mail = new PHPMailer(true);
                $mail->CharSet =  "utf-8";
                $mail->IsSMTP();
                // enable SMTP authentication
                $mail->SMTPAuth = true;
                // GMAIL username
                $mail->Username = "your_email_id@gmail.com";
                // GMAIL password
                $mail->Password = "your_gmail_password";
                $mail->SMTPSecure = "ssl";
                // sets GMAIL as the SMTP server
                $mail->Host = "smtp.gmail.com";
                // set the SMTP port for the GMAIL server
                $mail->Port = "465"; //or 587

                $mail->From = 'your_gmail_id@gmail.com'; //company email
                $mail->FromName = 'your_name';
                $mail->AddAddress('utn-noreply.mail.com', 'Information');
                
                $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/Views/resetPassword-show?token=$token";

                $mail->IsHTML(true); //format email to HTML
                $mail->Subject = 'Solicitud de cambio de contraseña';
                $mail->Body = "<h2>Solicitaste un cambio de contraseña para tu usuario</h2>
                                <h4>Para cambiar tu contraseña accede a este link: </h4> $url
                                <h4>Si usted no solicito un cambio de contraseña, solamente ingnore el mensaje</h4>";

                $response = $mail->send();
                
            }else return false;
        }catch (Exception $e) {
            $response = $e->getMessage();
        }finally {
            return $response;
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
                $response = $resetPasswordDb->Add($objectValidate)  //add new object
            }
        }catch (PDOException $e){
            $response = $e->getMessage();
        }finally{
            return $response;
        }
    }

     public static function GetByEmailToDb($email){
        $resetPasswordDb = new ResetPasswordDAO();
        $userResetPassword= resetPasswordDb->GetByEmail($email);
        return $userResetPassword;
    }

    
    /*public static function EmailExistDb(string $email){
        $resetPasswordDb = new ResetPasswordDAO();
        $resetPasswordList = resetPasswordDb->GetAll();             //not usefull get all, need getbyid on DAO
        foreach($resetPasswordList as $user){
            if($user->getEmail == $email) return $user;
            else return false;
        }
    }*/
   
}