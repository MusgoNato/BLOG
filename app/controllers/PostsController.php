<?php

namespace app\controllers;
use app\database\Banco;
use Error;
use PDO;
use PDOException;

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
        $sql = $conn->prepare("SELECT posts.*, 
               users.name AS author_name, 
               (SELECT COUNT(*) FROM likes WHERE post_id = posts.id AND type = 'like') AS likes,
               (SELECT COUNT(*) FROM likes WHERE post_id = posts.id AND type = 'dislike') AS dislikes
                FROM posts
                JOIN users ON posts.user_id = users.id
                ORDER BY posts.created_at DESC");
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


    public function likePost($params)
    {
        session_start();
        header('Content-Type: application/json');

        // Recebimento de mensagens do front quando algum evento acontecer no sistema
        $data = json_decode(file_get_contents("php://input"), true);

        if(!empty($data)) 
        {
            $userId = $_SESSION['usuario']['id'];
            $postId = (int) $data['post_id'];
            $type = $data['type']; // "like" ou "dislike"

            try 
            {
                $conn = Banco::getConection();
    
                // Verifica se já existe um like/dislike
                $sqlCheck = $conn->prepare("SELECT * FROM likes WHERE post_id = :postid AND user_id = :userid");
                $sqlCheck->execute([':postid' => $postId, ':userid' => $userId]);
                $existingLike = $sqlCheck->fetch(PDO::FETCH_ASSOC);

                if($existingLike) 
                {
                    if($existingLike['type'] !== $type) 
                    {
                        
                        // Atualiza o tipo de like
                        $sqlUpdate = $conn->prepare("UPDATE likes SET type = :type WHERE post_id = :postid AND user_id = :userid");
                        $sqlUpdate->execute([':postid' => $postId, ':type' => $type, ':userid' => $userId]);
                        error_log("update");
                    }else 
                    {
                        // Remove o like/dislike se clicar novamente
                        $sqlDelete = $conn->prepare("DELETE FROM likes WHERE post_id = :postid AND user_id = :userid");
                        $sqlDelete->execute([':postid' => $postId, ':userid' => $userId]);
                        error_log("delete");
                    }
                }else 
                {
                    // Adiciona um novo like/dislike
                    $sqlInsert = $conn->prepare("INSERT INTO likes (post_id, type, user_id) VALUES (:postid, :type, :userid)");
                    $sqlInsert->execute([':postid' => $postId, ':type' => $type, ':userid' => $userId]);
                    error_log("Adicionou");
                }
                
                if($type == 'like')
                {
                    // Inserindo as informações para atualizações das notificações no banco de dados
                    $sqlOwner = $conn->prepare("SELECT user_id FROM posts WHERE id = :postid");
                    $sqlOwner->execute([':postid' => $postId]);
                    $postOwner = $sqlOwner->fetch(PDO::FETCH_ASSOC);
                    
                    if($postOwner && $postOwner['user_id'] != $userId)
                    {
                        $sqlnotify = $conn->prepare("INSERT INTO notifications (user_id, message, type, related_id, created_at) VALUES (:owner_id, :message, 'like', :postid, NOW())");
                        $username = $_SESSION['usuario']['nome'] ?? 'Alguém';
                        

                        $sqlnotify->execute([':owner_id' => $postOwner['user_id'],
                        ':message' => "$username curitu seu post",
                        ':postid' => $postId
                    ]);
                    }
                }

                 // Retorna a contagem atualizada
                 $sqlCount = $conn->prepare("SELECT 
                 SUM(CASE WHEN type = 'like' THEN 1 ELSE 0 END) AS likes, 
                 SUM(CASE WHEN type = 'dislike' THEN 1 ELSE 0 END) AS dislikes
                 FROM likes WHERE post_id = :postid");
                $sqlCount->execute([':postid' => $postId]);
                $counts = $sqlCount->fetch(PDO::FETCH_ASSOC);
                
                // Retorno para a requisição feita pelo Ajax
                echo json_encode([
                    "success" => true,
                    "likes" => $counts['likes'] ?? 0,
                    "dislikes" => $counts['dislikes'] ?? 0
                ]);


            }catch(PDOException $e) 
            {
                echo json_encode(["success" => false, "error" => $e->getMessage()]);
            }
        }
}

    
}