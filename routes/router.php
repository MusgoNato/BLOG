<?php

/**
 * Summary of load
 * Responsavel por verificar se o controlador e o metodo passado no vetor de rotas existe
 * @param string $controller
 * @param string $method
 * @return void
 */
function load(string $controller, string $method)
{
    try
    {
        // Caminho relativo das classes
        $controllerNamespace = "app\\controller\\{$controller}";

        if(!class_exists($controllerNamespace))
        {   
            throw new Exception("O controller {$controller} não existe");
        }

        $controllerInstance = new $controllerNamespace();

        if(!method_exists($controllerInstance, $method))
        {
            throw new Exception("O metodo {$method} não existe no controller {$controller}");
        }

        // Passo como metodo quaisquer GET ou POST que for feita no meu site. Chamando o objeto que foi criado
        $controllerInstance->$method((object)$_REQUEST);

    }catch(Exception $e)
    {
        echo $e->getMessage();
    }
}


$routers = 
[
    "GET" =>
    [
        "/" => fn() => load("HomeController", "home"),
    ]
];


?>