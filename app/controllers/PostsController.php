<?php

namespace app\controllers;
use app\database\Banco;
use PDO;

class PostsController
{
    private $posts = [];


    public function showSinglePost($postID, $id)
    {
        session_start();

        if(!isset($_SESSION['usuario']))
        {
            header("Location: /");
        }

        $post = PostsController::getPostById($id);

        if($post === false)
        {
            return Controller::view("errorpage");
        }

        return Controller::view("single-post", ["post" => $post]);
    }

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->ConectDatabasePosts();
    }
    
    /**
     * Summary of ConectDatabasePosts
     * Conecta ao banco de dados pegando os posts mais recentes criados
     * @return void
     */
    private function ConectDatabasePosts()
    {
        $conn = Banco::getConection();
        $sql = $conn->prepare("SELECT posts.*, users.name as author_name FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
        $sql->execute();

        $this->posts = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Summary of getAllPosts
     * Retorna todos os Posts existentes
     * @return array
     */
    public function getAllPosts()
    {
        return $this->posts;
    }

    public static function getPostById($postId)
    {
        $conn = Banco::getConection();

        $sql = $conn->prepare("SELECT posts.*, users.name AS autor FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = :post_id");
        $sql->bindParam(':post_id', $postId);
        $sql->execute();

        return $sql->fetchObject();
    }


    
}