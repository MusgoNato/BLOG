<?php $this->layout("master") ?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card mx-auto shadow-sm" style="max-width: 600px;">
            <div class="card-header text-center">
                <h3>Perfil de <?= htmlspecialchars($user->name) ?></h3>
            </div>
            <div class="card-body text-center">
                <img src="<?= $user->image_path ?? '/imgs/default-avatar.jpg' ?>" class="rounded-circle mb-3" width="150" height="150">
                <p><strong>Email:</strong> <?= htmlspecialchars($user->email) ?></p>
                <p><strong>Data de Cadastro:</strong> <?= date("d/m/Y", strtotime($user->created_at)) ?></p>
                <p><strong>Posts Criados: </strong><?= $total_posts ?></p>
            </div>
            <div class="card-footer text-center">
                <a href="/<?= htmlspecialchars($user->id) ?>" class="btn btn-primary">Enviar Mensagem</a>
                <a href="/" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
</body>
</html>
