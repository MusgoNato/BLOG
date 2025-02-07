<?php

namespace app\controllers;

class HomeController
{
    public function home($params)
    {
        return Controller::view("master");
    }
}

?>