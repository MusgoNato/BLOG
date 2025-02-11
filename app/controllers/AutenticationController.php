<?php

namespace app\controllers;

use app\database\Banco;
use PDO;

class AutenticationController
{
    /**
     * Summary of VerifyUser
     * Verifico o usuario, se estiver correto o que foi enviado entro dentro do sistema
     */
    public function VerifyUser($params)
    {
        session_start();
        
        $conn = Banco::getConection();
        $sql = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindParam(':email', $params->email);
        $sql->execute();

        $user = $sql->fetchObject();

        if(!empty($user))
        {
            $_SESSION['usuario'] = 
            [
                'id' => $user->id,
                'nome' => $user->name,
                'email' => $user->email,
            ];

            return Controller::view("master", ["user" => $user->name]);    
        }

        // Caso nao exista o usuario, define a mensagem para visualização na view master
        return Controller::view("login", ["ERROR_MSG_LOGIN" => "Usuario ou senha incorretos"]);    
    }
}

?>