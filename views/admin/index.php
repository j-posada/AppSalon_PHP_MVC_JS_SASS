<?php include_once __DIR__ . '/../templates/barra.php'?>

<h1 class="nombre-pagina">Panel Admin</h1>
<p class="descripcion-pagina">Buscar citas</p>

<div class="busqueda">
	<form action="" class="formulario">
		<div class="campo">
			<label for="fecha">Fecha</label>
			<input
			type="date"
			id="fecha"
			name="fecha"
			value = <?php echo $fecha; ?>
			/>
		</div>
	</form>
</div>
<?php
if (count($citas) === 0) {
    echo "<h3> No hay citas disponibles para esta fecha </h3>";
}
?>
<div id="citas-admin">
	<div class="contenedor_citas">

	<?php
$idCita = null;
$precio = 0;

foreach ($citas as $cita) {

    if ($idCita != null && $idCita !== $cita->id) {
        echo '<div class="totalprecio"> Total: <span>' . moneyFormat($precio, 'ESP') . ' €</span></div>';
        echo '</div>';
        $precio = 0;
    }

    if ($idCita !== $cita->id) {
        ?>

		<div class="cita">
		<li class='datos_cita'>
			<div class='hora'><?php echo substr($cita->hora, 0, 5) ?></div>
			<div>
				<form action="/api/eliminar" method="POST">
					<input type="hidden" name="id" value="<?php echo $cita->id; ?>">
					<input type="submit" class="boton boton-eliminar" value="eliminar">
				</form>
			</div>

			<div>ID: <span><?php echo $cita->id ?></span></div>
			<div>Cliente: <span><?php echo $cita->cliente ?></span></div>
			<div>e-mail: <span><?php echo '<a href="mailto: ' . $cita->email . '">' . $cita->email . "</a>" ?></span></div>
			<div>Teléfono: <span><?php echo '<a href="tel: ' . $cita->telefono . '">' . $cita->telefono . "</a>" ?></span></div>
			<h3> Servicios	</h3>
		</li>
		<?php $idCita = $cita->id;
    }
    ;?>
	<div class="servicio"><?php
echo $cita->servicio . " " . $cita->precio;
    $precio += $cita->precio;

    ?>
		</div>
	<?php
}
echo '<div class="totalprecio"> Total: <span>' . moneyFormat($precio, 'ESP') . ' €</span></div>';
?>


</div></div>

<?php
$script = "
	<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
	<script src='build/js/buscador.js'></script>";
?>

</div>