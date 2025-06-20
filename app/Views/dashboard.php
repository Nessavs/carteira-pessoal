<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
</head>
<body>
    <h2>Bem-vindo, <?= esc($usuario['nome']) ?>!</h2>

    <nav>
        <a href="<?= site_url('categorias') ?>">Categorias</a>
        <a href="<?= site_url('transacoes') ?>">Transações</a>
        <a href="<?= site_url('logout') ?>">Sair</a>
    </nav>
</body>
</html>
