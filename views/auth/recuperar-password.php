<h1 class="nombre-pagina">Restablece tu  password</h1>
<p class="descripcion-pagina">Introduce tu password</p>

<?php 
include_once __DIR__ . "/../templates/alertas.php"
?>

<?php if ($error) return ?>
<form class="formulario" method="POST">
	<div class="campo">
		<label for="password">Password</label>
		<input 
			type="password" 
			id="password" 
			name="password" 
			placeholder="Tu nuevo password"
		 />
	</div>

	<input type="submit" class="boton" value="Reestablecer">
</form>

<div class="acciones">
	<a href="/">Volver a la home para iniciar sesión</a>
	<a href="/crear-cuenta">Crea una nueva cuenta</a>
</div>