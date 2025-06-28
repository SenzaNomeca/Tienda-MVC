<?php if(isset($gestion)): ?>
    <h1>Gestionar pedidos</h1>
<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif ?>
<?php if(isset($pedidos)):?>
<table>
    <tr>
        <th>N. Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>

        <?php while($ped = $pedidos->fetch_object()):?>

            <tr>
                <td>
                    <a href="<?=base_url?>order/detalle&id=<?=$ped->id?>"><?=$ped->id?></a>
                </td>
                <td>
                    <?=$ped->coste?> COP
                </td>
                <td>
                    <?=$ped->fecha?>
                </td>
                <td>
                    <?=$ped->estado?>
                </td>
            </tr>
        <?php endwhile; ?>

    <?php else: ?>
    <h3>No tiene pedidos registrados</h3>
    <?php endif ?>
</table>
