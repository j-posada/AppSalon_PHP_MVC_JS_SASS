<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
	public static function login(Router $router)
	{
		$alertas =[];
		$auth = new Usuario;		

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$auth = new Usuario($_POST);
			$alertas = $auth->validarLogin();

			if (empty($alertas)){
				$usuario = Usuario::where('email',$auth->email);

				if ($usuario){
					//Verificar Paswword y Token Confirmardo
					if ($usuario->comprobarPasswordAndConfimado($auth->password)){
						// Autenticar al usuario
						session_start();
						$_SESSION['id']=$usuario->id;
						$_SESSION['nombre']=$usuario->nombre. " " . $usuario->apellido;
						$_SESSION['email']=$usuario->email;
						$_SESSION['login']=true;


						if ($usuario->admin === "1"){
							//Admin
							$_SESSION['admin'] = $usuario->admin || null; // NO pongo valor directo para que siempre sea el valor de mi db
							header('Location: /admin');
						}
						else{
							//Cliente
							header('Location: /cita');
						}
					}
				}
				else{
					Usuario::setAlerta('error','Usuario NO encontrado');
				}
			}
		}
		$alertas = Usuario::getAlertas();
		$router->render('auth/login',[
			'alertas' => $alertas,
			'auth' => $auth
		]);
	}

	public static function logout()
	{
		echo "Saliendo de Login";
	}

	public static function olvide(Router $router)
	{
		$alertas =[];
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$auth = new Usuario($_POST);
			$alertas = $auth->validarEmail();
			if (empty($alertas)){
				$usuario = Usuario::where('email',$auth->email);
				if($usuario)
				{
					$usuario->generarToken();
					$usuario->guardar();

					// Pendiente enviar email.
					Usuario::setAlerta('exito','Revisa tu email');
				}
				else{
					Usuario::setAlerta('error','Usuario NO encontrado');
				}
				//debuguear($usuario);
				
			}
			//		debuguear($auth);
		}
		$alertas = Usuario::getAlertas();	
		$router->render('auth/olvide-password', [
			'alertas' => $alertas
		]);
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
					$email = new Email($usuario->email, ucwords(($usuario->nombre . " " . $usuario->apellido)), $usuario->token);
					$email->enviarConfirmacion();

					//Crear usuario
					$resultado = $usuario->guardar();

					if ($resultado) {
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
		$usuario = Usuario::where('token', $token);

		if (empty($usuario)) {
			// Mensaje de error
			Usuario::setAlerta('error', 'Token no válido');
		} else {
			$usuario->confirmado = 1;
			$usuario->token = null;
			$usuario->guardar();
			Usuario::setAlerta('exito', 'Token confirmado');
			// Modificar usuario confirmado
		}
		$alertas = Usuario::getAlertas();
		$router->render('auth/confirmar-cuenta', [
			'alertas' => $alertas
		]);
	}
}
