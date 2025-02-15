<?php


namespace app\controllers;
use app\database\Banco;

class CadastreController
{   
    /**
     * Summary of index
     * Carrega a view correspondente caso exista sessao do usuario ativa ou não
     */
    public function index()
    {
        session_start();
        
        if(isset($_SESSION['usuario']))
        {
            header("Location: /");
        }
        return Controller::view("cadastre");
    }

    /**
     * Summary of CreateUser
     * Cria cadastro do usuario
     * @param object $params
     */
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