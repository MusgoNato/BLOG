<?php


namespace app\controllers;

use app\database\Banco;

class ProfileController
{
    public function ShowProfile($params)
    {
        session_start();
        
        $conn = Banco::getConection();
        $sql = $conn->prepare("SELECT * FROM users WHERE id = '{$params->id}'");
        $sql->execute();

        $user = $sql->fetchObject();

        return Controller::view("userprofile", ["user" => $user]);
    }
}


?>