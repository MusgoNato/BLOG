<?php

namespace app\controllers;

class AutenticationController
{
    /**
     * Summary of VerifyUser
     * Verifico o usuario, se estiver correto o que foi enviado entro dentro do sistema
     */
    public function VerifyUser()
    {
        return Controller::view("master");
    }
}

?>