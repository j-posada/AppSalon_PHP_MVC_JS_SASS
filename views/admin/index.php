<?php include_once __DIR__ . '/../templates/barra.php'?>

<h1 class="nombre-pagina">Panel Admin</h1>
<p class="descripcion-pagina">Bla</p>
<?php include_once __DIR__ . "/../templates/alertas.php"?>

<h2>Buscar citas</h2>
<div class="busqueda">
	<form action="" class="formulario">
		<div class="campo">
			<label for="fecha">Fecha</label>
			<input
			type="date"
			id"fecha"
			name="fecha"
			/>
		</div>
	</form>
</div>
<div id="citas-admin"></div>

<?php
$script = "
	<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
	<script src='build/js/app.js'></script>
	";
?>

</div>