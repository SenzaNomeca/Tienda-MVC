<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
    <h1>Tu pedido de ha confirmado</h1>
    <p>Tu pedido ha sido guardado con existo, una vez pagues el pedido, sera
        procesado y enviado.
    </p>

    <?php if(isset($pedido)): ?>
    <h3>Datos del pedido</h3>
        Numero de pedido: <?=$pedido->id?> <br>
        Total a pagar: <?=$pedido->coste?><br>
        Productos:
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
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
            </tr>
        <?php endwhile;?>

        <?php else: ?>
                <h1>No hay pedidos asociados</h1>
        <?php endif; ?>

    </table>


    <?php endif; ?>

<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'failed'):  ?>
    <h1>Tu pedido ha tenido un error</h1>
    <p>Reintentalo en unos minutos</p>
<?php else: ?>
    <h1>No hay pedidos asociados</h1>
<?php endif; ?>
