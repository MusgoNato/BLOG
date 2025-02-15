<?php

namespace app\controllers;

use app\database\Banco;

class MyPostsController
{
    public function index()
    {
        session_start();

        $posts = $this->getAllMyPosts();

        return Controller::view("myposts", ["posts" => $posts]);
    }

    public function newPost()
    {
        session_start();
        return Controller::view("editpost");
    }

    public function getAllMyPosts()
    {
        if(!isset($_SESSION['usuario']['id']))
        {
            header('/');
        }

        $userid = $_SESSION['usuario']['id'];

        $conn = Banco::getConection();
        $sql = $conn->prepare("SELECT * FROM posts WHERE user_id = :user_id");
        $sql->bindParam(':user_id', $userid);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function PublicNewPost($params)
    {
        session_start();

        if(!isset($_SESSION['usuario']['id']))
        {
            header("Location: /myposts/");
        }

        $userid = $_SESSION['usuario']['id'];
        
        $conn = Banco::getConection();
        $sql = $conn->prepare("INSERT INTO posts (title, content, user_id, created_at, updated_at) VALUES (:title, :content, :user_id, NOW(), NOW())");
        $sql->bindParam(':title', $params->titulo);
        $sql->bindParam(':content', $params->conteudo);
        $sql->bindParam(':user_id', $userid);

        $sql->execute();

        $posts = $this->getAllMyPosts();
        return Controller::view("myposts", ["posts" => $posts]);

    }
}
