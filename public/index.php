<?php

use app\controllers\CadastreController;
use app\database\Banco;

require_once '../vendor/autoload.php';
require_once '../routes/router.php';

// Fazer a conexao com o banco de dados primeiro
try
{
    $banco = Banco::getConection();
}catch(PDOException $e)
{
    die('Não foi possivel a conexao com o banco de dados');
}


try
{
    $uri = parse_url($_SERVER["REQUEST_URI"])["path"];
    $request = $_SERVER["REQUEST_METHOD"];

    if(!isset($routers[$request]))
    {
        die("Pagina nao encontrada");
    }

    // Verifico as uris que foram colocadas no router se existem, caso nao existam não há o caminho passado na uri e portanto incluo uma
    // mensagem de erro
    // if(!(array_key_exists($uri, $routers[$request])))
    // {
    //     die("Requisição nao encontrada dentro do routers");
    // }

    $routeFound = false;

    // Tratando as rotas com expressoes regulares, caso encontre as requisições correspondentes com as expressoes passadas, passo para a função o valor corespondente
    foreach($routers[$request] as $route => $callback)
    {
        if(preg_match("#^" . $route . "$#", $uri, $matches))
        {
            array_shift($matches);

            $routeFound = true;
            $callback(...$matches);
            break;
        }
    }

    if(!$routeFound)
    {
        die("Requisicao nao encontrada dentro do routers");
    }
    
    // O controller vai ser chamado de acordo com a uri passada, pois ela esta associada a uma função anonima, transformando-a em uma closure
    // aonde somente vai ser executada quando for chamada
    // $controller = $routers[$request][$uri];
    // $controller();

}catch(Exception $e)
{
    echo "Nao foi possivel conectar ao site : " . $e->getMessage(); 
}


?>