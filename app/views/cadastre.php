<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h1>Insira as informações</h1>
    <form action="/newCadastre" method="post">
        <input type="text" name="nome" placeholder="Insira seu nome" required>
        <input type="email" name="email" placeholder="Insira seu email" required>
        <input type="password" name="senha" placeholder="Insira sua senha" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>