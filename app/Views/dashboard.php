<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Bem-vindo, <?= esc($usuario['nome']) ?>!</h2>
    <p>Email: <?= esc($usuario['email']) ?></p>
    <a href="/logout">Sair</a>
</body>
</html>
