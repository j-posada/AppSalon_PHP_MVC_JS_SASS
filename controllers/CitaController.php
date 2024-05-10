<?php

namespace Controllers;
use MVC\Router;

class CitaController
{
	public static function index(Router $router){
		$alertas = [];
		$router->render('cita/index', [
			'alertas' => $alertas
		]);
	}	
}