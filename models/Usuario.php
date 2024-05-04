<?php
namespace Model;

class Usuario extends ActiveRecord {
	//Base de datos
	protected static $tabla = 'usuarios';
	protected static $columnasDB = ['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];
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
		$this->admin = $args['admin'] ?? null;
		$this->confirmado = $args['confirmado'] ?? null;
		$this->token = $args['token'] ?? '';
	}

	// Validación de campos 
	public function validarNuevaCuenta () {
		if (!$this->nombre){
			self::$alertas['error'][] = 'El nombre no puede estar vacio';
		}
		if (!$this->apellido){
			self::$alertas['error'][] = 'El apellido no puede estar vacio';
		}
		if (!$this->email){
			self::$alertas['error'][] = 'El email no puede estar vacio';
		}
		if (!$this->password){
			self::$alertas['error'][] = 'El password no puede estar vacio';
		}
		if (strlen($this->password) < 6 ){
			self::$alertas['error'][] = 'El password deber tener mínimo 6 caracteres';
		}


		return self::$alertas;
	}
}