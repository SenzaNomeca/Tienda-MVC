<h1>Carrito de la compra</h1>
<?php
if(isset($carrito) && count($carrito) > 0):?>
<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
    </tr>

            <?php foreach ($carrito as $indice => $elemento):
            $producto = $elemento['producto']; ?>

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
                    <?= $elemento['unidades'] ?>
                    <div class="updown_unidades">
                        <a class="button" href="<?=base_url?>cart/up&index=<?=$indice?>">+</a>
                        <a class="button" href="<?=base_url?>cart/down&index=<?=$indice?>">-</a>
                    </div>
                </td>
                <td>
                    <a href="<?=base_url?>cart/remove&index=<?=$indice?>" class="button button-carrito button-red">Eliminar producto</a>
                </td>
            </tr>
        <?php endforeach ?>
</table>
<?php $stats = Utils::stastCarrito() ?>
<br>
<center>
    <strong>total: <?= $stats['total']?>$</strong>
    <a href="<?=base_url?>Order/hacer" class="button button_pedido">Hacer pedido</a>
    <a href="<?=base_url?>cart/delete_all" class="button button_pedido button-red">Vaciar carrito</a>
</center>
<?php else: ?>
<center><br><strong><h3>El carrito esta vacio</h3></strong></center>
<?php endif; ?>
