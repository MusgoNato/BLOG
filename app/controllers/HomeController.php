<?php

namespace app\controllers;

class HomeController
{
    public function index($params)
    {
        session_start();

        if(isset($_SESSION['usuario']))
        {
            $userSession = $_SESSION['usuario']['nome'];
            return Controller::view("master", ["user" => $userSession]);            
        }

        return Controller::view("home");
    }

    public function logout()
    {
        session_start();

        session_destroy();

        header("Location: /");
        exit();
    }
}

?>