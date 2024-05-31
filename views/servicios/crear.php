<?php include_once __DIR__ . '/../templates/barra.php'?>
<h1 class="nombre-pagina">Panel Admin</h1>
<p class="descripcion-pagina">Crear servicios</p>
<?php
include_once __DIR__ . "/../templates/alertas.php"
?>

<form action="/servicios/crear" method="POST" class="formulario">
<?php
include_once __DIR__ . "/../servicios/formulario.php"
?>
<input type="submit" class="boton" value="Guardar">
</form>