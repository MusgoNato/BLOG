<?php


namespace app\controllers;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
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

        $this->SendEmailforUser();

        $conn = Banco::getConection();
        $sql = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $sql->bindParam(':name', $params->nome);
        $sql->bindParam(':email', $params->email);
        $sql->bindParam(':password', $params->senha);

        $sql->execute();

        return Controller::view("login", ["ERROR_MSG_LOGIN" => ""]);
    }   

    protected function SendEmailforUser()
    {
        $email = new PHPMailer(true);
        
        try
        {
            // Configuração do servidor email
            $email->isSMTP();
            $email->Host = 'smtp.gmail.com';
            $email->Port = 587;
            $email->SMTPSecure = 'tls';
            $email->SMTPAuth = true;
            $email->Username = 'pedrintestepedrin@gmail.com'; // email para envios
            $email->Password = 'rvve zdod uldb peio'; // senha de acesso a app concedida pelo email

            // Corpo
            $email->setFrom('pedrintestepedrin@gmail.com', 'Hugo josue lema das neves');
            $email->addReplyTo('pedrintestepedrin@gmail.com', 'hugo josue lema das neves');
            $email->addAddress('pedrintestepedrin@gmail.com', 'asd');
            $email->addCC('pedrintestepedrin@gmail.com', 'asddddd');
            $email->addBCC('pedrintestepedrin@gmail.com', 'dfggf');
            $email->Subject = 'Envio de email';
            $email->CharSet = 'UTF-8';
            $email->msgHTML('<p>Ola tudo bom?asdasdasd</p>');
            $email->AltBody = 'OIEEEEEEEEE';

        }catch(Exception $e)
        {
            die($e->getMessage());
        }

        if(!$email->send())
        {
            die('Erro no envio do email');
        }
    }
}