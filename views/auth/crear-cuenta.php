<h1 class="nombre-pagina">Crear Nueva Cuenta</h1>
<p class="descripcion-pagina">Introduce tus datos, para crear una cuenta</p>

<form class="formulario" method="POST" action="/crear-cuenta">
	<div class="campo">
		<label for="nombre">Nombre</label>
		<input type="text" id="nombre" name="nombre" placeholder="Tu nombre" />
	</div>
	<div class="campo">
		<label for="apellido">Apellido</label>
		<input type="text" id="apellido" name="apellido" placeholder="Tu apellido" />
	</div>
	<div class="campo">
		<label for="telefono">Teléfono</label>
		<input type="tel" id="telefono" name="telefono" placeholder="Tu teléfono" />
	</div>
	<div class="campo">
		<label for="email">e-mail</label>
		<input type="email" id="email" name="email" placeholder="Tu email" />
	</div>
	<div class="campo">
		<label for="password">Password</label>
		<input type="password" id="password" name="password" placeholder="Tu password" />
	</div>
	<input type="submit" class="boton" value="Crear cuenta">
</form>

<div class="acciones">
	<a href="/">Volver a la home para iniciar sesión</a>
	<a href="/olvide">Has olvidado tu contraseña?</a>
</div>