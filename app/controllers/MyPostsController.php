<?php

namespace app\controllers;

use app\database\Banco;

class MyPostsController
{
    public function index()
    {
        session_start();

        if(!isset($_SESSION['usuario']))
        {
            header("Location: /");
        }

        $posts = $this->getAllMyPosts();

        return Controller::view("myposts", ["posts" => $posts]);
    }

    public function newPost()
    {
        session_start();

        if(!isset($_SESSION['usuario']))
        {
            header("Location: /");
        }

        return Controller::view("createpost");
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

    public function UpdatePost($params)
    {
        session_start();

        switch($params->decision)
        {
            case 'save':
                $conn = Banco::getConection();
                $sql = $conn->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
                $sql->bindParam(':title', $params->titulo);
                $sql->bindParam(':content', $params->conteudo);
                $sql->bindParam(':id', $params->idpost);              
                $sql->execute();

                header("Location: /myposts");
                break;
            case 'delete':
                $conn = Banco::getConection();
                $sql = $conn->prepare("DELETE FROM posts WHERE id = :idpost");
                $sql->bindParam(':idpost', $params->idpost);
                $sql->execute();

                header("Location: /myposts");
            case 'edit':
                $post = PostsController::getPostById($params->idpost);
                return Controller::view("editpost", ["post" => $post]);
        }
        
    }
}
