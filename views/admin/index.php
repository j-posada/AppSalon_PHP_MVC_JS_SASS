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
<div id="citas-admin">
	<ul class="citas">
		<?php
foreach ($citas as $cita) {
    if ($idCita !== $cita->id) {
        ?>
		<li>
			<p>ID: <span><?php echo $cita->id ?></sapan></p>
			<p>Hora: <span><?php echo $cita->hora ?></sapan></p>
			<p>Cliente: <span><?php echo $cita->cliente ?></sapan></p>
			<p>e-mail: <span><?php echo $cita->email ?></sapan></p>
			<p>Teléfono: <span><?php echo $cita->telefono ?></sapan></p>
			<h3> Servicios	</h3>
		</li>
		<?php $idCita = $cita->id;
    }; ?>
	<p class="servicio"><?php echo $cita->servicio . " " . $cita->precio ?></p>
	<?php } ?>
	</ul>


</div>

<?php
$script = "
	<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
	";
?>

</div>