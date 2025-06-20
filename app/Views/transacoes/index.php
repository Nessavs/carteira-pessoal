<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Transações</title>
    <link rel="stylesheet" href="<?= base_url('css/transacoes-index.css') ?>">
</head>
<body>
    <div class="container">
        <h2>Transações</h2>
        
        <div class="actions-top">
            <a href="<?= site_url('transacoes/criar') ?>" class="button-new">Nova Transação</a>
            <a href="<?= site_url('dashboard') ?>" class="button-dashboard">Dashboard</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($transacoes)): ?>
                    <tr>
                        <td colspan="7" class="no-data">Nenhuma transação encontrada.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($transacoes as $t): ?>
                        <tr>
                            <td><?= esc($t['id']) ?></td>
                            <td><?= esc($t['titulo']) ?></td>
                            <td><?= esc($t['categoria_nome'] ?? 'N/A') ?></td>
                            <td>
                                <span class="tipo-<?= esc($t['tipo']) ?>">
                                    <?= ucfirst(esc($t['tipo'])) ?>
                                </span>
                            </td>
                            <td class="valor-<?= esc($t['tipo']) ?>">
                                R$ <?= number_format($t['valor'], 2, ',', '.') ?>
                            </td>
                            <td>
                                <?= date('d/m/Y', strtotime($t['data'])) ?>
                            </td>
                            <td>
                                <a href="<?= site_url('transacoes/editar/' . $t['id']) ?>">Editar</a> |
                                <a href="<?= site_url('transacoes/excluir/' . $t['id']) ?>"
                                   onclick="return confirm('Excluir esta transação?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
