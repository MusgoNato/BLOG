<?php

namespace app\controllers;

class HomeController
{
    public function index($params)
    {
        return Controller::view("home");
    }
}

?>