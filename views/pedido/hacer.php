<?php if(isset($_SESSION['identity'])): ?>
<h1>Hacer pedido</h1>
    <a href="<?=base_url?>cart/index" class="button button_pedido">Ver carrito</a>
    <br>
    <h3>Domicilio</h3>
    <form action="<?=base_url.'order/add'?>" method="POST">
        <label for="region">Region</label>
        <input type="text" name="region">

        <label for="municipio">Municipio</label>
        <input type="text" name="municipio" required>

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" required>

        <input type="submit" value="Confirmar pedido" required>
    </form>

<?php else: ?>
<h1>Necesita estar identificado</h1>
<p>Ingresa su usuario para realizar tu pedido</p>
<?php endif ?>
