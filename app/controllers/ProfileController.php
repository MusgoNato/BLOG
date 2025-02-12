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

        $Userid = $_SESSION['usuario']['id'];

        $conn = Banco::getConection();
        $sql = $conn->prepare("SELECT * FROM users WHERE id = '{$Userid}'");
        $sql->execute();

        return $sql->fetchObject();
    }

    public function UpdateUser($params)
    {
        session_start();

        $user = (object)$_SESSION['usuario'];

        $params->email = isset($params->email) ? $params->email : $_SESSION['usuario']['email'];

        $conn = Banco::getConection();
        $sql = $conn->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $sql->bindParam(':name', $params->nome);
        $sql->bindParam(':email', $params->email);
        $sql->bindParam(':id', $user->id);
    }
}


?>