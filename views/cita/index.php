<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios a continuación</p>

<?php
include_once __DIR__ . "/../templates/alertas.php"
?>

<div id="app">
	<div id="paso-1" class="seccion">
		<h2>Servicios</h2>
		<p class="text-center">Elige tus servicios a continuación</p>
		<div id="servicios" class="listado-servicios"></div>
	</div>
	<div id="paso-2" class="seccion">
		<h2>Tus Datos y Cita</h2>
		<p class="text-center">Coloca tus datos y fecha de tu cita</p>
		<form action="" class="formulario">
			<div class="campo">
				<label for="nombre">Nombre</label>
				<input 
					type="text" 
					id="nombre" 
					name="nombre" 
					placeholder="Tu nombre" 
					value="<?php echo s($nombre) ?>"
					disabled
				/>

			</div>
			<div class="campo">
				<label for="fecha">Fecha</label>
				<input 
					type="date" 
					id="fecha" 
					name="fecha" 
				/>
			</div>
			<div class="campo">
				<label for="hora">Hora</label>
				<input 
					type="time" 
					id="hora" 
					name="hora" 
				/>
			</div>

		</form>
	</div>
	<div id="paso-3" class="seccion">
		<h2>Resumen</h2>
		<p class="text-center">Verifica la información antes de aceptar</p>
	</div>
</div>