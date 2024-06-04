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
</li>
<?php } ?>
</ul>