<?php

namespace Controllers;

use Classes\Email;
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
					//Enviar email con token para validación
					$email = new Email($usuario->email, ucwords(($usuario->nombre . " " . $usuario->apellido )),$usuario->token);
					$email->enviarConfirmacion();

					//Crear usuario
					$resultado = $usuario->guardar();

					if ($resultado){
						header('Location: /mensaje');
					}
				}
			}
		}

		$router->render('auth/crear-cuenta', [
			'usuario' => $usuario,
			'alertas' => $alertas
		]);
	}
	public static function mensaje(Router $router)
	{
		$router->render('auth/mensaje', []);
	}

	public static function confirmar(Router $router)
	{
		$alertas = [];
		$token = s($_GET['token']);
		$usuario= Usuario::where('token', $token);
		debuguear($usuario);
		$router->render('auth/confirmar-cuenta', [
			'alertas' => $alertas
		]);
	}
}
