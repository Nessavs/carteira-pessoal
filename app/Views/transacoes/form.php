<?php
$editing = isset($transacao['id']);
$action  = $editing
    ? site_url('transacoes/editar/' . $transacao['id'])
    : site_url('transacoes/criar');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $editing ? 'Editar Transação' : 'Nova Transação' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/transacoes-form.css') ?>">
</head>
<body>
    <div class="form-container">
        <h2><?= $editing ? 'Editar Transação' : 'Nova Transação' ?></h2>

        <?php if (isset($validation)) : ?>
            <div class="validation-errors">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= $action ?>">
            <?= csrf_field() ?>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="<?= esc($transacao['titulo'] ?? '') ?>" required>

            <label for="descricao">Descrição (opcional)</label>
            <textarea id="descricao" name="descricao"><?= esc($transacao['descricao'] ?? '') ?></textarea>

            <label for="valor">Valor</label>
            <input type="number" id="valor" name="valor" step="0.01" min="0" value="<?= esc($transacao['valor'] ?? '') ?>" required>

            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo" required>
                <option value="">-- selecione --</option>
                <option value="receita" <?= ($transacao['tipo'] ?? '') === 'receita' ? 'selected' : '' ?>>
                    Receita
                </option>
                <option value="despesa" <?= ($transacao['tipo'] ?? '') === 'despesa' ? 'selected' : '' ?>>
                    Despesa
                </option>
            </select>

            <label for="data">Data</label>
            <input type="date" id="data" name="data" value="<?= esc($transacao['data'] ?? date('Y-m-d')) ?>" required>

            <label for="categoria_id">Categoria</label>
            <select id="categoria_id" name="categoria_id" required>
                <option value="">-- selecione --</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id'] ?>" 
                        <?= ($transacao['categoria_id'] ?? '') == $categoria['id'] ? 'selected' : '' ?>>
                        <?= esc($categoria['nome']) ?> (<?= esc($categoria['tipo']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="form-actions">
                <button type="submit">Salvar</button>
                <a href="<?= site_url('transacoes') ?>" class="button-back">Voltar</a>
                <a href="<?= site_url('dashboard') ?>" class="button-dashboard">Dashboard</a>
            </div>
        </form>
    </div>
</body>
</html>
