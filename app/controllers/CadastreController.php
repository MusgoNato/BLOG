<?php


namespace app\controllers;
use app\database\Banco;

class CadastreController
{
    public function index()
    {
        session_start();
        
        if(isset($_SESSION['usuario']))
        {
            header("Location: /");
        }
        return Controller::view("cadastre");
    }

    public function CreateUser(object $params)
    {
        session_start();

        if(isset($_SESSION['usuario']))
        {
            header("Location: /");
        }

        $conn = Banco::getConection();
        $sql = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $sql->bindParam(':name', $params->nome);
        $sql->bindParam(':email', $params->email);
        $sql->bindParam(':password', $params->senha);

        $sql->execute();

        return Controller::view("login", ["ERROR_MSG_LOGIN" => ""]);
    }   
}

?>