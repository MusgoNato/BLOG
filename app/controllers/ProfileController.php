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
                $imagePathinLocal = $this->getPathUserImage();
                $conn = Banco::getConection();
                $sql = $conn->prepare("UPDATE users SET name = :name, image_path = :image_path WHERE id = :id");
                $sql->bindParam(':name', $params->nome);
                $sql->bindParam(':id', $user->id);
                $sql->bindParam(':image_path', $imagePathinLocal);
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

    public function getPathUserImage()
    {
        $PathUploadImages = __DIR__ . "/../../public/imgs/users/";
        
        // Cria a pasta caso ela nao exista
        if(!is_dir($PathUploadImages))
        {
            mkdir($PathUploadImages, 0777, true);
        }

        if(!empty($_FILES['image']['name']))
        {
            $fileInformation = $_FILES['image'];
            $fileName = uniqid() . "_" . basename($fileInformation['name']);
            $filePath = "/imgs/users/" . $fileName;

            if(move_uploaded_file($fileInformation['tmp_name'], $PathUploadImages . $fileName))
            {
                return $filePath;
            }
        }
    }

    public function ShowUser($params, $idUser)
    {
        session_start();
        $user = $this->getSingleProfile($idUser);
        if($user)
        {
            return Controller::view("singleuserprofile", ["user" => $user]);
        }
        
        die("nao existe usuario");
    }

    public function getSingleProfile($idUser)
    {
        $conn = Banco::getConection();
        $sql = $conn->prepare("SELECT * FROM users WHERE id = '{$idUser}'");
        $sql->execute();

        return $sql->fetchObject();
    }
}