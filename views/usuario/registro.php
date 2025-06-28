<h1>Registrarse</h1>

<?php if(isset($_SESSION["register"]) && $_SESSION["register"] == "complete"): ?>
    <strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION["register"]) && $_SESSION["register"] == "failed"):?>
    <strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>


<form action="<?=base_url?>user/save" method="POST">
    <label for="nombre">Nombre</label>
    <?php if(isset($_SESSION["error_nombre"]) && $_SESSION["error_nombre"] == "nombre"): ?>
        <strong class="alert_red">Nombr(e) invalido(s)</strong>
    <?php endif; ?>
    <input type="text" name="nombre"  required>

    <label for="apellidos">Apellidos</label>
    <?php if(isset($_SESSION["error_apellidos"]) && $_SESSION["error_apellidos"] == "apellidos"): ?>
        <strong class="alert_red">Apellido(s) invalido(s)</strong>
    <?php endif; ?>
    <input type="text" name="apellidos" required>

    <label for="email">email</label>
    <input type="email" name="email" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" required>

    <input class="button_enviar" type="submit" value="Registrarse">
    <?php
    Utils::deleteSession("register");
    Utils::deleteSession("error_nombre");
    Utils::deleteSession("error_apellidos");
    ?>
</form>