<h1>Crear nueva categoria</h1>

<form action="<?=base_url?>category/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required>

    <input class="button_enviar" type="submit" value="Guardar">
</form>
