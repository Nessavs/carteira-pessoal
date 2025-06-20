<?php
if (function_exists('view') && is_file(APPPATH . 'Views/layout/header.php')) {
    echo view('layout/header');
}

// Detecta se é edição
$editing = isset($categoria['id']);
$action  = $editing
    ? site_url('categorias/editar/' . $categoria['id'])
    : site_url('categorias/criar');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $editing ? 'Editar Categoria' : 'Nova Categoria' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/categorias-form.css') ?>">
</head>
<body>
    <div class="form-container">
        <h2><?= $editing ? 'Editar Categoria' : 'Nova Categoria' ?></h2>

        <?php if (isset($validation)) : ?>
            <div class="validation-errors">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= $action ?>">
            <?= csrf_field() ?>

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?= esc($categoria['nome'] ?? '') ?>" required>

            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo" required>
                <option value="">-- selecione --</option>
                <option value="receita" <?= ($categoria['tipo'] ?? '') === 'receita' ? 'selected' : '' ?>>
                    Receita
                </option>
                <option value="despesa" <?= ($categoria['tipo'] ?? '') === 'despesa' ? 'selected' : '' ?>>
                    Despesa
                </option>
            </select>

            <label for="valor">Valor (opcional)</label>
            <input type="number" id="valor" name="valor" step="0.01" min="0" value="<?= esc($categoria['valor'] ?? '') ?>">

            <div class="form-actions">
                <button type="submit">Salvar</button>
                <a href="<?= site_url('categorias') ?>" class="button-back">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
if (function_exists('view') && is_file(APPPATH . 'Views/layout/footer.php')) {
    echo view('layout/footer');
}
?>
