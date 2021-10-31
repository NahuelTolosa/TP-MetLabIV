<?php
namespace DAO\DAOdB;

use Models\ResetPassword;

interface IDAOPW{
    function Add(ResetPassword $emaemailToReset);
}