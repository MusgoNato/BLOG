<?php

namespace app\controllers;
use app\database\Banco;
use PDO;

class LoginController
{
    /**
     * Summary of index
     * Carrega a view correspondente do usuario logado ou não
     */
    public function index()
    {
        session_start();

        // Se existe variavel de sessao, usuario ja esta autenticado, pego seu nome juntamente com os posts criados no banco de dados
        if(isset($_SESSION['usuario']))
        {
            $userSession = $_SESSION['usuario']['nome'];
            $instancia = new PostsController();
            $posts = $instancia->getAllPosts();
            return Controller::view("home", ["user" => $userSession, "posts" => $posts]);            
        }

        return Controller::view("login");
    }

    /**
     * Summary of logout
     * Saida do Usuario da aplicação
     * @return never
     */
    public function logout()
    {
        session_start();

        session_destroy();

        header("Location: /");
        exit();
    }
}

?>