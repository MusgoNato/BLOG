

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Token</title>
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
                        <h1 class="text-center mb-4">Verificação de Token</h1>
                            <!-- Formulário de Token -->
                            <form action="/newCadastre/Verification/validation" method="post">
                                <div class="mb-3">
                                    <input type="hidden" name="email" value="<?= htmlspecialchars($user->email) ?>">
                                    <label for="token" class="form-label">Token de Verificação</label>
                                    <input type="text" name="token" id="token" class="form-control" placeholder="Insira o token" required>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Verificar</button>
                                </div>
                            </form>

                        <?php if(isset($ERROR_MSG)): ?>
                            <div class="alert alert-danger mt-3 text-center" role="alert">
                                <?php echo $ERROR_MSG; ?>
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