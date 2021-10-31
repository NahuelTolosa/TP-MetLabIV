<?php

namespace Models;

final class ResetPassword{
    private $idResetPw;
    private $email;
    private $password;
    private $repeatPassword;
    private $token;

    public function getIdResetPw()
    {
        return $this->idResetPw;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRepeatPassword()
    {
        return $this->repeatPassword;
    }

    public function getToken()
    {
        return $this->token;
    }
}

