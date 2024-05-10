<?php

namespace Model;

class Usuario extends ActiveRecord
{
	//Base de datos
	protected static $tabla = 'usuarios';
	protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];
	public $id;
	public $nombre;
	public $apellido;
	public $email;
	public $password;
	public $telefono;
	public $admin;
	public $confirmado;
	public $token;

	public function __construct($args = [])
	{
		$this->id = $args['id'] ?? null;
		$this->nombre = $args['nombre'] ?? '';
		$this->apellido = $args['apellido'] ?? '';
		$this->email = $args['email'] ?? '';
		$this->password = $args['password'] ?? '';
		$this->telefono = $args['telefono'] ?? '';
		$this->admin = $args['admin'] ?? '0';
		$this->confirmado = $args['confirmado'] ?? '0';
		$this->token = $args['token'] ?? '';
	}

	// Validación de campos 
	// Usuario
	public function validarNuevaCuenta()
	{
		if (!$this->nombre) {
			self::$alertas['error'][] = 'El nombre no puede estar vacio';
		}
		if (!$this->apellido) {
			self::$alertas['error'][] = 'El apellido no puede estar vacio';
		}
		if (!$this->email) {
			self::$alertas['error'][] = 'El email no puede estar vacio';
		}
		if (!$this->password) {
			self::$alertas['error'][] = 'El password no puede estar vacio';
		}
		if (strlen($this->password) < 6) {
			self::$alertas['error'][] = 'El password deber tener mínimo 6 caracteres';
		}
		return self::$alertas;
	}
	// Login
	public function validarLogin()
	{
		if (!$this->email) {
			self::$alertas['error'][] = 'El email no puede estar vacio';
		}
		if (!$this->password) {
			self::$alertas['error'][] = 'El password no puede estar vacio';
		}
		return self::$alertas;
	}

	public function validarEmail()
	{
		if (!$this->email) {
			self::$alertas['error'][] = 'El email no puede estar vacio';
		}
		return self::$alertas;
	}

	public function validarPassword()
	{
		if (!$this->password) {
			self::$alertas['error'][] = 'El password no puede estar vacio';
		}
		if (strlen($this->password) < 6) {
			self::$alertas['error'][] = 'El password deber tener mínimo 6 caracteres';
		}
		return self::$alertas;
	}
	//Revisa si el usuario ya exite
	public function exiteUsuario()
	{
		$query = "SELECT * FROM " . self::$tabla . " WHERE email='" . $this->email . "' LIMIT 1";
		$resultado = self::$db->query($query);
		//Verificamos si exite el usuario
		if ($resultado->num_rows) {
			self::$alertas['error'][] = 'El usuario ya exite';
		} else {
			self::$alertas['exito'][] = 'Usuario creado correctamente';
			
		}
		return $resultado;
	}
	public function hashPassword()
	{
		$this->password = password_hash($this->password, PASSWORD_BCRYPT);
	}

	public function generarToken()
	{
		$this->token = uniqid();
	}

	public function comprobarPasswordAndConfimado($password)
	{
		$resultado = password_verify($password, $this->password);
		if (!$resultado || !$this->confirmado)
		{
			self::$alertas['error'][] = 'Password incorrecto o cuenta no validada';
		}
		else{
			self::$alertas['exito'][] = 'Iniciando login...';
			return (true);
		}
	}
}
