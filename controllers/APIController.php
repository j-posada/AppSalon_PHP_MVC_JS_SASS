<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController
{
	public static function index()
	{
		$servicios = Servicio::all();
		echo json_encode($servicios);
	}

	public static function guardar()
	{
		//almacena la cita y devuelve el idCita
		$cita = new Cita($_POST);
		$resultado = $cita->guardar();

		$id = $resultado['id'];
		// Alamacena la cita y los servicios asociados a la cita
		// explode transforma un string en un array delimitado por el primer parametro similar al split de js
		$idServicios = explode (",", $_POST['servicios']);

		foreach ($idServicios as $idServicio){
			$args = [
				'citaId' => $id,
				'servicioId' => $idServicio
			];
			$citaServicio = new CitaServicio($args);
			$citaServicio-> guardar();
		};



		echo json_encode(['resultado' => $resultado]);
	}
}
