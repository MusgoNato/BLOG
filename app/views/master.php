<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sistema</title>
</head>
<body class="d-flex flex-column min-vh-100"> 

    <h1>Bem Vindo <?= $_SESSION['usuario']['nome'] ?></h1>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Meu Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/myposts">Meus Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/userprofile">Meu Perfil</a>
                    </li>
                </ul>
                <span class="navbar-text me-3 text-white">Olá, <?= $_SESSION['usuario']['nome'] ?>!</span>
                <a href="/logout" class="btn btn-outline-danger">Sair</a>
            </div>
        </div>
    </nav>

    <?= $this->section("AllPosts") ?>

    <!-- Obrigatorio -->
    <?= $this->section("content") ?>

     <!-- Rodapé fixo no final da página -->
     <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-1">&copy; <?= date("Y") ?> Meu Blog. Todos os direitos reservados.</p>
            <p class="small">Desenvolvido por <a href="#" class="text-white fw-bold">Hugo inc</a></p>
            <div>
                <a href="#" class="text-white me-3">Política de Privacidade</a>
                <a href="#" class="text-white">Termos de Uso</a>
            </div>
        </div>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>