<!-- BARRA LATERAL -->
<aside id="lateral">
    <div id="carrito" class="block_aside">
        <h3>Mi carrito</h3>
        <ul>
            <?php $stats = Utils::stastCarrito() ?>
            <li><a href="<?=base_url?>cart/index">Ver el carrito</a></li>
            <li><a href="<?=base_url?>cart/index">Productos (<?= $stats['count']?>)</a></li>
            <li><a href="<?=base_url?>cart/index">Total: (<?= $stats['total']?>$)</a></li>
        </ul>
    </div>
    <div id="login" class="block_aside">
        <?php if(!isset($_SESSION["identity"])):?>
            <h3>Entrar a la web</h3>
            <form class="form_login" action="<?=base_url?>user/login" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password"/>
                <input class="button_enviar" type="submit" value="Enviar">
            </form>


            <?php
            $error = Utils::getFlash("login_error");
            if ($error == "password wrong"): ?>
                <strong class="alert_red">Clave errónea</strong>
            <?php elseif ($error == "identificacion fallida"): ?>
                <strong class="alert_red">Usuario inválido</strong>
            <?php endif; ?>

        <?php else: ?>
            <h3>Bienvenido <?= $_SESSION["identity"]->nombre . ' ' . $_SESSION["identity"]->apellidos ?></h3>
        <?php endif;?>

        <ul>
            <?php if(isset($_SESSION["admin"])):?>
                <li><a href="<?=base_url?>category/index">Gestionar categorias</a></li>
                <li><a href="<?=base_url?>product/gestion">Gestionar productos</a></li>
                <li><a href="<?=base_url?>order/gestion">Gestionar pedidos</a></li>
            <?php endif;?>

            <?php if(isset($_SESSION["identity"])): ?>
                <li><a href="<?=base_url?>order/misPedidos">Mis pedidos</a></li>
                <li><a class="close-session" href="<?=base_url?>user/logout">Cerrar sesión</a></li>
            <?php else:?>
                <li><a href="<?=base_url?>user/registro">Registrarse</a></li>
            <?php endif;?>
        </ul>
    </div>
</aside>
<!-- CONTENIDO CENTRAL -->
<div id="central">
