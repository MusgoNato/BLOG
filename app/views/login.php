<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link para o Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <!-- Card para o Formulário -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Hugo Blog</h1>
                        
                        <!-- Formulário de Login -->
                        <form action="/" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Insira seu email" required>
                            </div>

                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="senha" id="senha" class="form-control" placeholder="Insira sua senha" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>

                        <div class="mt-3 text-center">
                            <a href="/newCadastre" class="text-decoration-none">Novo Cadastro</a>
                        </div>

                        <?php if(isset($ERROR_MSG_LOGIN)): ?>
                            <div class="alert alert-danger mt-3 text-center" role="alert">
                                <?php echo $ERROR_MSG_LOGIN; ?>
                            </div>
                        <?php endif; ?>
                        <?php if(isset($SUCESS_EMAIL_VALIDATE)): ?>
                            <div class="alert alert-danger mt-3 text-center" role="alert">
                                <?php echo $SUCESS_EMAIL_VALIDATE; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para o Bootstrap JS (para interatividade, como modais, dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
