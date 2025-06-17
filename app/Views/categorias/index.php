<?php
if (function_exists('view') && is_file(APPPATH . 'Views/layout/header.php')) {
    echo view('layout/header');
}
?>

<h2>Categorias</h2>
<a href="<?= site_url('categorias/criar') ?>">Nova categoria</a>

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Valor</th>          <!-- nova coluna -->
        <th>Ações</th>
    </tr>

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
</table>

<?php
if (function_exists('view') && is_file(APPPATH . 'Views/layout/footer.php')) {
    echo view('layout/footer');
}
?>
