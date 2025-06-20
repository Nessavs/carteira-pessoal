<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
</head>
<body>
    <div class="auth-container">
        <h2>Login</h2>
        
        <?php if (session()->getFlashdata('erro')): ?>
            <p class="error"><?= session()->getFlashdata('erro') ?></p>
        <?php endif; ?>
        
        <form method="post" action="/login">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <button type="submit">Entrar</button>
        </form>
        
        <p>Não tem conta? <a href="/register">Cadastre-se</a></p>
    </div>
</body>
</html>
