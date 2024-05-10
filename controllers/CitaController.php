<?php

namespace Controllers;
use MVC\Router;

class CitaController
{
	public static function index(Router $router){
		session_start();
		$alertas = [];
		$router->render('cita/index', [
			'nombre' => $_SESSION['nombre'],
			'alertas' => $alertas
		]);
	}	
}