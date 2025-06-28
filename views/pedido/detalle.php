<h1>Datos del pedido</h1>

<?php if(isset($pedido)): ?>
    <?php if(isset($_SESSION['admin'])): ?>
    <h3>Cambiar estado del pedido</h3>
    <form action="<?=base_url?>order/estado" method="post">
        <input type="hidden" value="<?=$pedido->id?>" name="pedido_id">
        <select name="estado">
            <option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : ''?>>Pendiente</option>
            <option value="preparation" <?=$pedido->estado == "preparation" ? 'selected' : ''?>>En preparacion</option>
            <option value="ready" <?=$pedido->estado == "ready" ? 'selected' : ''?>>Preparado para enviar</option>
            <option value="sended" <?=$pedido->estado == "sended" ? 'selected' : ''?>>Enviado</option>
        </select>
        <input type="submit" value="Cambiar estado">
    </form>
    <br>
    <?php endif; ?>

<h3>Direccion de envio</h3>
Region: <?=$pedido->provincia?> <br>
Municipio: <?=$pedido->localidad?> <br>
Direccion: <?=$pedido->direccion?> <br>

<br>
<h3>Datos del pedido</h3>
Estado: <?=Utils::showStatus($pedido->estado)?> <br>
Numero de pedido: <?=$pedido->id?> <br>
Total a pagar: <?=$pedido->coste?><br>
Productos:
<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Estado</th>
    </tr>
    <?php
    if(isset($productos)):
        while($producto = $productos->fetch_object()): ?>
            <tr>
                <td>
                    <?php if($producto->imagen != null): ?>
                        <img class="img_carrito" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>">
                    <?php else : ?>
                        <img class="img_carrito" src="<?=base_url?>/assets/img/camiseta.png">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?=base_url?>product/ver&id=<?=$producto->id?>"><?= $producto->nombre ?></a>
                </td>
                <td>
                    <?= $producto->precio ?>
                </td>
                <td>
                    <?= $producto->unidades?>
                </td>
                <td>
                    <?=Utils::showStatus($pedido->estado)?>
                </td>
            </tr>
        <?php endwhile;?>

    <?php else: ?>
        <h1>No hay pedidos asociados</h1>
    <?php endif; ?>

</table>
<?php endif; ?>