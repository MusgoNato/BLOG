<?php


namespace app\controllers;
use app\database\Banco;

class CadastreController
{   
    /**
     * Summary of index
     * Carrega a view correspondente caso exista sessao do usuario ativa ou não
     */
    public function index($params)
    {
        session_start();
        
        if(isset($_SESSION['usuario']))
        {
            header("Location: /");
        }
        return Controller::view("cadastre");
    }

    /**
     * Summary of CreateUser
     * Cria cadastro do usuario
     * @param object $params
     */
    public function CreateUser(object $params)
    {
        session_start();

        if(isset($_SESSION['usuario']))
        {
            header("Location: /");
        }

        // Colocar PHPmailer ao inves disso

        $to = "hugojosue03@gmail.com";
        $subject = "Email enviado do blog";
        $message = "Oi, este é um teste de envio de e-mail.";
        $headers = "From: seuemail@seudominio.com\r\n" .
                "Reply-To: seuemail@seudominio.com\r\n" .
                "X-Mailer: PHP/" . phpversion();

        $retornoemail = mail($to, $subject, $message, $headers);

        if ($retornoemail) {
            echo "Email enviado com sucesso!";
            die;
        } else {
            echo "Falha no envio do email.";
            die;
        }

        $conn = Banco::getConection();
        $sql = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $sql->bindParam(':name', $params->nome);
        $sql->bindParam(':email', $params->email);
        $sql->bindParam(':password', $params->senha);

        $sql->execute();

        return Controller::view("login", ["ERROR_MSG_LOGIN" => ""]);
    }   
}