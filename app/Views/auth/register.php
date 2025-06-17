<!DOCTYPE html>
<html>
<head><title>Cadastro</title></head>
<body>
    <h2>Cadastro</h2>
    <form method="post" action="/register">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br>
        <button type="submit">Registrar</button>
    </form>
    <p>Já tem conta? <a href="/">Faça login</a></p> 
</body>
</html>
