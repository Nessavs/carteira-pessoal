<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
    <link rel="stylesheet" href="<?= base_url('css/categorias-index.css') ?>">
</head>
<body>
    <div class="container">
        <h2>Categorias</h2>
        
        <div class="actions-top">
            <a href="<?= site_url('categorias/criar') ?>" class="button-new">Nova categoria</a>
            <a href="<?= site_url('dashboard') ?>" class="button-dashboard">Dashboard</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $c): ?>
                    <tr>
                        <td><?= esc($c['id']) ?></td>
                        <td><?= esc($c['nome']) ?></td>
                        <td><?= esc($c['tipo']) ?></td>
                        <td>
                            <?= $c['valor'] !== null
                                    ? 'R$ ' . number_format($c['valor'], 2, ',', '.')
                                    : '-' ?>
                        </td>
                        <td>
                            <a href="<?= site_url('categorias/editar/' . $c['id']) ?>">Editar</a> |
                            <a href="<?= site_url('categorias/excluir/' . $c['id']) ?>"
                               onclick="return confirm('Excluir esta categoria?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
