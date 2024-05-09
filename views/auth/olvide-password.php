<h1 class="nombre-pagina">Olvide password</h1>
<p class="descripcion-pagina">Restablece tu password</p>

<?php 
include_once __DIR__ . "/../templates/alertas.php"
?>

<form class="formulario" method="POST" action="/olvide">
	<div class="campo">
		<label for="email">e-mail</label>
		<input type="email" id="email" name="email" placeholder="Tu email" />
	</div>
	<input type="submit" class="boton" value="Enviar instrucciones por email">
</form>

<div class="acciones">
	<a href="/">Volver a la home para iniciar sesión</a>
	<a href="/crear-cuenta">Crea una nueva cuenta</a>
</div>