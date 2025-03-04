<?php

/**
 * Summary of load
 * Responsavel por verificar se o controlador e o metodo passado no vetor de rotas existe
 * @param string $controller
 * @param string $method
 * @return void
 */
function load(string $controller, string $method, ...$params)
{
    try
    {
        // Caminho relativo das classes
        $controllerNamespace = "app\\controllers\\{$controller}";

        if(!class_exists($controllerNamespace))
        {   
            throw new Exception("O controller {$controller} não existe");
        }

        $controllerInstance = new $controllerNamespace();

        if(!method_exists($controllerInstance, $method))
        {
            throw new Exception("O metodo {$method} não existe no controller {$controller}");
        }
        
        $requestData = (object)$_REQUEST;

        $controllerInstance->$method($requestData, ...$params);   

    }catch(Exception $e)
    {
        echo $e->getMessage();
    }
}


$routers = 
[
    "GET" =>
    [
        // Primeira rota ao iniciar o programa
        "/" => fn() => load("LoginController", "index"),
        "/newCadastre" => fn() => load("CadastreController", "index"),
        "/logout" => fn() => load("LoginController", "logout"),   
        "/userprofile" => fn() => load("ProfileController", "ShowProfile"),
        "/editprofile" => fn() => load("ProfileController", "EditProfile"),
        "/myposts" => fn() => load("MyPostsController", "index"),
        "/myposts/newpost" => fn() => load("MyPostsController", "newPost"),
        "/post/([0-9]+)" => fn($id) => load("PostsController", "showSinglePost", (int)$id), 
        "/profile/([0-9]+)" => fn($id) => load("ProfileController", "ShowUser", (int)$id),
    ],

    "POST" =>
    [
        "/" => fn() => load("AutenticationController", "VerifyUser"),
        "/newCadastre" => fn() => load("TokenController", "SendEmailforUser"),
        "/editprofile" => fn() => load("ProfileController", "UpdateUser"),
        "/myposts/newpost" => fn() => load("MyPostsController", "PublicNewPost"),
        "/myposts/editpost" => fn() => load("MyPostsController", "UpdatePost"),    
        "/newCadastre/Verification/validation" => fn() => load("TokenController", "validateEmailToken"),
        "/likepost" => fn() => load("PostsController", "likePost"),
    ]
];


?>