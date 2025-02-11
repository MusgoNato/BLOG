<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Hugo Blog</h1>
    <form action="/" method="post">
        <input type="email" name="email" placeholder="Insira seu email" required>
        <input type="password" name="senha" placeholder="Insira sua senha" required>
        <button type="submit">Entrar</button>
    </form>
    <a href="/newCadastre">Novo Cadastro</a>

    <?php if(isset($ERROR_MSG_LOGIN)): ?>
        <?php echo $ERROR_MSG_LOGIN; ?>
    <?php else:?>
        <?php echo ""; ?>
    <?php endif; ?>
</body>
</html>