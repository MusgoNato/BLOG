<?php


namespace app\controllers;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class TokenController
{
    public function SendEmailforUser($params)
    {
        $email = new PHPMailer(true);

        try
        {
            // Configuração do servidor email
            $email->isSMTP();

            // Gero o token
            $tokenVerification = $this->randomTokenforEmail($params);

            $email->Host = 'smtp.gmail.com';
            $email->Port = 587;
            $email->SMTPSecure = 'tls';
            $email->SMTPAuth = true;
            $email->Username = 'pedrintestepedrin@gmail.com'; // email para envios
            $email->Password = 'rvve zdod uldb peio'; // senha de acesso a app concedida pelo email

            // Corpo
            $email->setFrom($params->email, 'Hugo Blog');
            $email->addAddress($params->email, 'Seja bem vindo ao Hugo Blog');
            $email->addCC($params->email, 'Esse é o diferentedddd');
            $email->addBCC($params->email, 'Esse é o diferente');
            $email->Subject = 'Envio de email';
            $email->CharSet = 'UTF-8';
            $email->msgHTML("<p>{$tokenVerification}</p>");
            $email->AltBody = 'OIEEEEEEEEE';

        }catch(Exception $e)
        {
            die($e->getMessage());
        }

        $retornoEmail = $email->send();

        if(!$retornoEmail)
        {
            die('Nao deu certo o envio');
        }

        return Controller::view("emailtoken", ["user" => $params]);

    }

    protected function randomTokenforEmail($params)
    {
        $token = md5($params->email);
        return $token;
    }

    public function validateEmailToken($params)
    {
        if(!(md5($params->email) == $params->token))
        {
           return Controller::view("emailtoken", ["ERROR_MSG" => "TOKEN INVALIDO"]);
        }

        // Se o token for valido, volto a tela de login 
        return Controller::view("login", ["SUCESS_EMAIL_VALIDATE" => "TOKEN VALIDADO COM SUCESSO. Por favor insira suas credenciais"]);
    }


    // Depoi de ele validar tudo, o proximo passo e a criação de seu cadastro no banco de dados (Arranjar um jeito de enviar o token ao inves da
    // senha do usuario)

}
