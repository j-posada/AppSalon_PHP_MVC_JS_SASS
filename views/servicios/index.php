<?php include_once __DIR__ . '/../templates/barra.php' ?>
<h1 class="nombre-pagina">Panel Admin</h1>
<p class="descripcion-pagina">Gestiona los servicios</p>
<?php
include_once __DIR__ . "/../templates/alertas.php"
?>
<ul class="servicios">
<?php 
foreach ($servicios as $servicio){ ?>
<li>
	<p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
	<p>Precio: <span><?php echo moneyFormat($servicio->precio, 'ESP') . ' €' ; ?></span></p>
	<div class="acciones">
		<a class="boton boton-actualizar" href="/servicios/actualizar?id=<?php echo $servicio->id;?>">actualizar</a>
		<form action="/servicios/eliminar" method="POST">
			<input type="hidden"
					name = "id"
					value = "<?php echo $servicio->id ?>"
			>
			<input type="submit"  class="boton boton-eliminar" value="    borrar    ">
		</form>

		</div>
</li>
<?php } ?>
</ul>