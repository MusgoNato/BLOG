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

        $HashPass = password_hash($params->senha, PASSWORD_DEFAULT);


        $conn = Banco::getConection();
        $sql = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $sql->bindParam(':name', $params->nome);
        $sql->bindParam(':email', $params->email);
        $sql->bindParam(':password', $HashPass);

        $sql->execute();

        return Controller::view("home", ["ERROR_MSG_LOGIN" => ""]);
    }   
}

?>