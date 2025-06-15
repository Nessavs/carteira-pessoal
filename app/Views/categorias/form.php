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

<h2><?= $editing ? 'Editar categoria' : 'Nova categoria' ?></h2>

<?php if (isset($validation)) : ?>
    <div style="color:red;margin:10px 0">
        <?= $validation->listErrors(); ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= $action ?>">
    <?= csrf_field() ?>

    <label>Nome<br>
        <input type="text" name="nome"
               value="<?= esc($categoria['nome'] ?? '') ?>">
    </label><br><br>

    <label>Tipo<br>
        <select name="tipo" required>
            <option value="">-- selecione --</option>
            <option value="receita"
                <?= ($categoria['tipo'] ?? '') === 'receita' ? 'selected' : '' ?>>
                Receita
            </option>
            <option value="despesa"
                <?= ($categoria['tipo'] ?? '') === 'despesa' ? 'selected' : '' ?>>
                Despesa
            </option>
        </select>
    </label><br><br>

    <button type="submit">Salvar</button>
    <a href="<?= site_url('categorias') ?>" style="margin-left:8px">Voltar</a>
</form>

<?php
if (function_exists('view') && is_file(APPPATH . 'Views/layout/footer.php')) {
    echo view('layout/footer');
}
?>
