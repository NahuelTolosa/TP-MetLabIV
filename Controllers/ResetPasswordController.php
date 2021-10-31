<?php namespace Controllers;

use Helpers\ResetPasswordHelper as ResetPasswordHelper;
use DAO\DAOdB\ResetPasswordDAO as ResetPasswordDAO;
use Models\ResetPassword;
use Models\User as User;
use PDOException as PDOException;

Class ResetPasswordController{
    private $resetPasswordDAO;

    public function __construct()
    {
        $this->resetPasswordDAO = new ResetPasswordDAO();
    }

    /**
     * forgotten password
     */
    public function ResetPassword(string $email){
        $response = ResetPasswordHelper::EmailTo($email);
        if(!$response) $message = "El email ingresado es inexistente";
        else $message = "Checkea tu mail e ingresa al link para cambiar la contraseña";
        require_once(VIEWS_PATH."logIn");
    }

    /**
     * update password
     */
    public function UpdatePassword($email, $newPassword, $repeatNewPassword, $token)
    {
        if ($token) {
            $validateToken = $this->resetPasswordDAO->GetByToken($token);

            if ($validateToken) {
                if ($newPassword == $repeatNewPassword) {
                    $resetPasswordUser = new User();
                    $resetPasswordUser->setEmail($email);
                    $resetPasswordUser->setPassword($newPassword);

                    $this->resetPasswordDAO->Delete($token); //clean table
                    
                    $message = "Contraseña modificada con exito";
                } else $message = "Las contraseñas no coinciden, vuelva a intentarlo.";
            } else $message = "Error validando token";
        } else $message = "Error 404";

        require_once(VIEWS_PATH . "jobOffer-list");
    }
}
