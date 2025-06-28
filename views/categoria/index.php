<h1>Gestionar categorias</h1>

<a href="<?=base_url?>category/create" class="button button-small">Crear categoria</a>

<?php
$error = Utils::getFlash("category");
if ($error == "complete"): ?>
    <strong class="alert_green">Categoria agregada correctamente</strong>
<?php elseif ($error == 'failed'): ?>
    <strong class="alert_red">Categoria invalida</strong>
<?php endif;?>


<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
    </tr>
    <?php while ($cat = $categorias->fetch_object()): ?>
    <tr>
        <td><?=$cat->id?></td>
        <td><?=$cat->nombre?></td>
    </tr>
    <?php endwhile; ?>
</table>
