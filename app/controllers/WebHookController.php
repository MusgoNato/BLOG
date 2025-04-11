<?php

namespace app\controllers;


class WebHookController
{
    // Setar a rota correspondente e fazer a webhook
    public function NotificationsMethod()
    {
        header('Content-Type: application/json');
        $responseJson = file_get_contents('php://');
        error_log($responseJson);
    }
}



?>