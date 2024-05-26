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
	<div class="contenedor_citas">

	<?php foreach ($citas as $cita) {

    if ($idCita != null && $idCita !== $cita->id) {
        echo '</div>';
    }

    if ($idCita !== $cita->id) {
        ?>

		<div class="cita">
		<li class='datos_cita'>
			<div class='hora'><?php echo  substr($cita->hora,0,5) ?></div>
			<div>ID: <span><?php echo $cita->id ?></span></div>
			<div>Cliente: <span><?php echo $cita->cliente ?></span></div>
			<div>e-mail: <span><?php echo '<a href="mailto: '. $cita->email . '">' .  $cita->email . "</a>" ?></span></div>
			<div>Teléfono: <span><?php echo '<a href="tel: '. $cita->telefono . '">' .  $cita->telefono . "</a>" ?></span></div>
			<h3> Servicios	</h3>
		</li>
		<?php $idCita = $cita->id;
    }
    ;?>
	<div class="servicio"><?php echo $cita->servicio . " " . $cita->precio ?></div>
	<?php
}?>

</div></div>

<?php
$script = "
	<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
	";
?>

</div>