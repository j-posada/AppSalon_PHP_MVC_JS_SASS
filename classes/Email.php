<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

	public $email;
	public $nombre;
	public $token;

	public function __construct($email, $nombre, $token)
	{
		$this->email = $email;
		$this->nombre = $nombre;
		$this->token = $token;
	}

	public function enviarConfirmacion()
	{
		$mail = new PHPMailer();

		//Server settings
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host = $_ENV['EMAIL_HOST'];
		$mail->SMTPAuth = true;
		$mail->Port = $_ENV['EMAIL_PORT'];
		$mail->Username = $_ENV['EMAIL_USER'];
		$mail->Password = $_ENV['EMAIL_PASS'];

		//Recipients
		$mail->setFrom('no-reply@appsalon.com', 'APP Salon');
		$mail->addAddress($this->email, $this->nombre);     //Add a recipient 
	//	$mail->addAddress('ellen@example.com');               //Name is optional
	//	$mail->addReplyTo('info@example.com', 'Information');
	//	$mail->addCC('cc@example.com');
	//	$mail->addBCC('bcc@example.com');
	    //Content
		$mail->isHTML(true);           
		$mail->CharSet ='UTF-8';                       //Set email format to HTML
		$mail->Subject = 'Confirma tu cuenta';

		$contenido = "<html>";
		$contenido .= "<p> <strong> Hola ". $this->nombre . "</strong><br>Has creado tu cuenta en appSalon, confirmala pulsando sobre el siguiente enlace:</p>";
		$contenido .=  "<p><a href='". $_ENV['APP_URL'] . "/confirmar-cuenta?token=". $this->token ."'>Confirmar</a> </p>";
		$contenido .=  "<p>Si tu no solicitaste nada, puedes ignorar este mensaje</p>";
		$contenido .= "</html>";

		$mail->Body    = $contenido;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
	}

	public function enviarInstrucciones()
	{
		$mail = new PHPMailer();

		//Server settings
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host = $_ENV['EMAIL_HOST'];
		$mail->SMTPAuth = true;
		$mail->Port = $_ENV['EMAIL_PORT'];
		$mail->Username = $_ENV['EMAIL_USER'];
		$mail->Password = $_ENV['EMAIL_PASS'];

		//Recipients
		$mail->setFrom('no-reply@appsalon.com', 'APP Salon');
		$mail->addAddress($this->email, $this->nombre);     //Add a recipient 
	//	$mail->addAddress('ellen@example.com');               //Name is optional
	//	$mail->addReplyTo('info@example.com', 'Information');
	//	$mail->addCC('cc@example.com');
	//	$mail->addBCC('bcc@example.com');
	    //Content
		$mail->isHTML(true);           
		$mail->CharSet ='UTF-8';                       //Set email format to HTML
		$mail->Subject = 'Olvidaste tu contraseña';

		$contenido = "<html>";
		$contenido .= "<p> <strong> Hola ". $this->nombre . "</strong><br>Sigue el siguiente enlace para modificar tu contraseña</p>";
		$contenido .=  "<p><a href='". $_ENV['APP_URL'] . "/recuperar?token=". $this->token ."'>Restablecer password</a> </p>";
		$contenido .=  "<p>Si tu no solicitaste nada, puedes ignorar este mensaje</p>";
		$contenido .= "</html>";

		$mail->Body    = $contenido;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
	}
}
