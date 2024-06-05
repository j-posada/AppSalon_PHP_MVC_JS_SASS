<?php include_once __DIR__ . '/../templates/barra.php'?>
<h1 class="nombre-pagina">Panel Admin</h1>
<p class="descripcion-pagina">Actualizar servicios</p>
<?php
include_once __DIR__ . "/../templates/alertas.php"
?>
<form method="POST" class="formulario">
<?php
include_once __DIR__ . "/../servicios/formulario.php"
?>
<input type="submit" class="boton" value="Actualizar">
</form>