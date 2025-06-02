<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <?php if (session()->getFlashdata('erro')): ?>
        <p style="color:red"><?= session()->getFlashdata('erro') ?></p>
    <?php endif; ?>
    <form method="post" action="/login">
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br>
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem conta? <a href="/register">Cadastre-se</a></p>
</body>
</html>
