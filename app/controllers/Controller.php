<?php

namespace app\controllers;

use League\Plates\Engine;
use Exception;

class Controller
{
    /**
     * Summary of view
     * Metodo para renderizar os templates do meu sistema
     * @param string $view
     * @param array $data
     * @throws \Exception
     * @return void
     */
    public static function view(string $view, array $data = [])
    {
        $viewsPath = dirname(__FILE__, 2) . "/views";
        
        // Se caso nao exista o arquivo, nao existe o template
        if(!file_exists($viewsPath.DIRECTORY_SEPARATOR.$view . ".php"))
        {
            throw new Exception("A view {$view} não existe!");
        }

        $templates = new Engine($viewsPath);    
        echo $templates->render($view, $data);

    }
}


?>