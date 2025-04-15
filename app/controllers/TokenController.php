<?php


namespace app\controllers;
use app\database\Banco;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class TokenController
{
    public function SendEmailforUser($params)
    {
        if($this->VerfyUserEmailInBD($params))
        {
            $email = new PHPMailer(true);

            try
            {
                // Configuração do servidor email
                $email->isSMTP();
    
                // Gero o token
                $tokenVerification = $this->randomTokenforEmail($params);
                
                // email password = nliSYvplusK

                $email->Host = 'smtp.gmail.com';
                $email->Port = 587;
                $email->SMTPSecure = 'tls';
                $email->SMTPAuth = true;
                $email->Username = 'blogapp64@gmail.com'; // email para envios
                $email->Password = 'evyc zwjg idby kenw'; // senha de acesso a app concedida pelo email
    
                // Corpo
                $email->setFrom($params->email, 'Hugo Blog');
                $email->addAddress($params->email, 'Seja bem vindo ao Hugo Blog');
                $email->addCC($params->email, 'Hugo Blog');
                $email->addBCC($params->email, 'Hugo Blog');
                $email->Subject = 'Envio de email';
                $email->CharSet = 'UTF-8';
                $email->msgHTML("<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Token de Autenticação</title><style>body{font-family: Arial, sans-serif;background-color: #f4f4f4;margin: 0;padding: 0;display: flex;justify-content: center;align-items: center;height: 100vh;}.container {background-color: #ffffff;padding: 20px;border-radius: 8px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);max-width: 400px;width: 100%;text-align: center;        }        h1 {color: #333333;font-size: 24px;margin-bottom: 20px;}.token {background-color: #f0f0f0;padding: 15px;border-radius: 4px;font-size: 18px;font-weight: bold;    color: #007bff;margin-bottom: 20px;word-break: break-all;}p {color: #666666;font-size: 16px;line-height: 1.5;}.footer {    margin-top: 20px;    font-size: 14px;    color: #999999;}    </style></head><body>    <div class='container'><h1>Seu Token de Autenticação</h1><div class='token'>{$tokenVerification}</div><p>Por favor, use este token para validar sua conta. Ele é válido por um período limitado.</p><p>Se você não solicitou este token, ignore este email.</p><div class='footer'>    <p>Atenciosamente,<br>Equipe Hugo Blog</p>        </div>    </div></body></html>");
    
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
        else
        {
            Controller::view("cadastre", ["ERROR_MSG_EMAIL" => "Email já cadastrado. Por favor insira outro email."]);
            header("Location: /newCadastre");
        }       
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

        // Faço a criação do usuario dentro do banco de dados apos validar seu email
        CadastreController::CreateUser($params);

        header("Location: /");
    }   

    public function VerfyUserEmailInBD($params)
    {
        $conn = Banco::getConection();
        $sql = $conn->prepare("SELECT 1 FROM users WHERE email = :email LIMIT 1");
        $sql->bindParam(':email', $params->email);
        $sql->execute();
   
        if($sql->fetch())
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

}
