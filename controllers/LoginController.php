<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController
{
	public static function login(Router $router)
	{
		$router->render('auth/login');
	}

	public static function logout()
	{
		echo "Saliendo de Login";
	}

	public static function olvide(Router $router)
	{
		$router->render('auth/olvide-password', []);
	}

	public static function recuperar()
	{
		echo "Recuperar password";
	}

	public static function crear(Router $router)
	{
		$usuario = new Usuario;

		$alertas = [];
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//	debuguear($_POST);
			$usuario->sincronizar($_POST);
			$alertas = $usuario->validarNuevaCuenta();

			if (empty($alertas)) {
				$resultado = $usuario->exiteUsuario();
				if ($resultado->num_rows) {
					$alertas = Usuario::getAlertas();
				} else {
					//Usua o no Existe 
					$usuario->hashPassword();
					//Generar token
					$usuario->generarToken();
					debuguear($usuario);
					//updatear alertas
					$alertas = Usuario::getAlertas();
				}
			}
		}

		$router->render('auth/crear-cuenta', [
			'usuario' => $usuario,
			'alertas' => $alertas
		]);
	}
}
