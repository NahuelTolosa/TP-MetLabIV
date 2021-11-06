<?php namespace Controllers;

use Helpers\ResetPasswordHelper as ResetPasswordHelper;
use DAO\DAOdB\ResetPasswordDAO as ResetPasswordDAO;
use DAO\DAOdB\UserDAO as UserDAO;

Class ResetPasswordController{
    private $resetPasswordDAO;
    private $userDAO;

    public function __construct()
    {
        $this->resetPasswordDAO = new ResetPasswordDAO();
        $this->userDAO = new UserDAO();
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
        $message = "";
        if ($token) {
            $validateToken = $this->resetPasswordDAO->GetByToken($token);

            if ($validateToken) {
                if ($newPassword == $repeatNewPassword) {
                    $userUpdate = $this->userDAO->GetByEmail($email);
                    if ($userUpdate) {
                        $userUpdate->setUserPassword($newPassword);
                        $this->userDAO->Update($userUpdate); //update user table

                        $this->resetPasswordDAO->Delete($token); //clean resetPassword table

                        $message = "Contraseña modificada con exito";
                    } else $message = "No se encontro el ID";
                } else $message = "Las contraseñas no coinciden, vuelva a intentarlo.";
            } else $message = "Error validando token";
        } else $message = "Error 404";

        require_once(VIEWS_PATH . "logIn");
    }

}
