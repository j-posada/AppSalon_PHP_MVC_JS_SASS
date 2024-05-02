<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<form action="/" method="POST" class="formulario">
	<div class="campo">
		<label for="email">Email</label>
		<input
			type="email"
			id="email"
			placeholder="tu@email.com"
			name="email"
		/>
	</div>
	<div class="campo">
		<label for="password">Password</label>
		<input
			type="password"
			id="password"
			placeholder="tu password"
			name="password"
		/>
	</div>
	<input type="submit" class="boton" value="Iniciar Sesión">

	<div class="acciones">
		<a href="/crear-cuenta">Crea una nueva cuenta</a>
		<a href="/olvide">Has olvidado tu contraseña?</a>
	</div>
</form>