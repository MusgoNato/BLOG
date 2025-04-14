<?php

namespace app\controllers;

use app\database\Banco;
use PDO;
use PDOException;

class NotificationController
{
    /**
     * Summary of ControlNotification
     * Controla as notificações para retornar ao front end
     * @return void
     */
    public function ControlNotification()
{
    header('Content-Type: application/json');
    session_start();

    if (!isset($_SESSION['usuario']['id'])) {
        echo json_encode(["error" => "Usuário não autenticado"]);
        return;
    }

    $conn = Banco::getConection();
    
    try {
        $sql = $conn->prepare("
            SELECT 
                n.id, n.message, n.type, n.related_id, n.created_at,
                u.id as sender_id, u.name as sender_name,
                p.id as post_id, p.title as post_title
            FROM 
                notifications n
            JOIN 
                users u ON n.user_id = u.id
            JOIN 
                posts p ON n.related_id = p.id
            WHERE 
                p.user_id = :user_id AND n.type = 'like'
            ORDER BY 
                n.created_at DESC
            LIMIT 5
        ");
        
        $sql->bindParam(':user_id', $_SESSION['usuario']['id'], PDO::PARAM_INT);
        $sql->execute();
        
        $notifications = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $formattedNotifications = [];
        foreach ($notifications as $notification) {
            $formattedNotifications[] = [
                'id' => $notification['id'],
                'message' => $notification['message'],
                'time' => $notification['created_at'],
                'post_id' => $notification['post_id'],
                'sender_id' => $notification['sender_id'],
                'sender_name' => $notification['sender_name']
            ];
        }
        
        echo json_encode([
            'sucess' => true,
            'count' => count($notifications),
            'notifications' => $formattedNotifications
        ]);
        
    } catch (PDOException $e) {
        error_log("Erro SQL: " . $e->getMessage());
        echo json_encode(["error" => "Erro ao buscar notificações"]);
    }
}
}