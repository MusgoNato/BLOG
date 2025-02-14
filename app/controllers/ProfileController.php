<?php


namespace app\controllers;

use app\database\Banco;

class ProfileController
{
    /**
     * Summary of ShowProfile
     * Resposavel pela visualização do usuario
     * @param mixed $params
     */
    public function ShowProfile($params)
    {    
        $user = $this->getUSerProfile();

        return Controller::view("userprofile", ["user" => $user]);
    }

    /**
     * Summary of EditProfile
     * Responsavel pela edição do usuario
     * @return void
     */
    public function EditProfile()
    {
        $user = $this->getUSerProfile();
        return Controller::view("editprofile", ["user" => $user]);
    }

    public function getUSerProfile()
    {
        session_start();

        $userid = (int)$_SESSION['usuario']['id'];

        $conn = Banco::getConection();
        $sql = $conn->prepare("SELECT * FROM users WHERE id = '{$userid}'");
        $sql->execute();

        return $sql->fetchObject();
    }

    public function UpdateUser($params)
    {
        $user = $this->getUSerProfile();
        
        $conn = Banco::getConection();
        $sql = $conn->prepare("UPDATE users SET name = :name WHERE id = :id");
        $sql->bindParam(':name', $params->nome);
        $sql->bindParam(':id', $user->id);
        $sql->execute();

        // Atualizo a sessao
        $_SESSION['usuario']['nome'] = $params->nome;

        header("Location: /");
    }
}


?>