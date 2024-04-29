<?php

namespace Controllers;

class LoginController {
	public static function login()  {
		echo "Desde Login";
	}

	public static function logout()  {
		echo "Saliendo de Login";
	}

	public static function olvide()  {
		echo "Regenerar password";
	}

	public static function recuperar()  {
		echo "Recuperar password";
	}
	public static function crear()  {
		echo "Crear cuenta";
	}
}