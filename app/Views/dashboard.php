<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        nav a { margin-right: 12px; text-decoration: none; color: #0645ad; }
    </style>
</head>
<body>
    <h2>Bem-vindo, <?= esc($usuario['nome']) ?>!</h2>
    <p>Email: <?= esc($usuario['email']) ?></p>

    <!-- menu rápido -->
    <nav>
        <a href="<?= site_url('categorias') ?>">Categorias</a>
        <a href="<?= site_url('logout') ?>">Sair</a>
    </nav>
</body>
</html>
