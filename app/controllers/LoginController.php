<?php

namespace app\controllers;
use app\database\Banco;
use PDO;

class LoginController
{
    public function index($params)
    {
        session_start();

        if(isset($_SESSION['usuario']))
        {
            $userSession = $_SESSION['usuario']['nome'];
            $posts = $this->getAllposts();
            return Controller::view("home", ["user" => $userSession, "posts" => $posts]);            
        }

        return Controller::view("login");
    }

    public function logout()
    {
        session_start();

        session_destroy();

        header("Location: /");
        exit();
    }


    // Modificar essa função para tornar ela uma unica instancia, assim em todo momento pego somente ela com todos os posts
    public function getAllposts()
    {
        $conn = Banco::getConection();
        $sql = $conn->prepare("SELECT * FROM posts ORDER BY created_at DESC");
        $sql->execute();
        
        $posts = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }
}

?>