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
    public function ShowProfile()
    {   
        $user = $this->getUSerProfile();    

        return Controller::view("userprofile", ["user" => $user]);
    
    }

    /**
     * Summary of EditProfile
     * Tomada de decisao, ou salva a edicao do usuario feita ou é excluido o cadastro do usuario
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

        if(!isset($_SESSION['usuario']['id']))
        {
            header("Location: /");  
        }
        $userid = (int)$_SESSION['usuario']['id'];

        $conn = Banco::getConection();
        $sql = $conn->prepare("SELECT * FROM users WHERE id = '{$userid}'");
        $sql->execute();

        return $sql->fetchObject();
    }

    public function UpdateUser($params)
    {
        $user = $this->getUSerProfile();

        switch($params->decision)
        {
            case 'save':
                $conn = Banco::getConection();
                $sql = $conn->prepare("UPDATE users SET name = :name WHERE id = :id");
                $sql->bindParam(':name', $params->nome);
                $sql->bindParam(':id', $user->id);
                $sql->execute();
                break;
            case 'delete':
                $conn = Banco::getConection();
                $sql = $conn->prepare("DELETE FROM users WHERE id = :id");
                $sql->bindParam(':id', $user->id);
                $sql->execute();

                // Como o usuario foi deletado, limpo o vetor global contendo suas informações
                session_unset();
                break;
        }   
        
        if(isset($_SESSION['usuario']['nome']))
        {
            // Atualizo a sessao
           $_SESSION['usuario']['nome'] = $params->nome;
        }
        
        header("Location: /");
    }
}