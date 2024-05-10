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
		$mail->Host = 'sandbox.smtp.mailtrap.io';
		$mail->SMTPAuth = true;
		$mail->Port = 2525;
		$mail->Username = '433de03e0e1a22';
		$mail->Password = 'b0249f95cf0647';

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
		$contenido .=  "<p><a href='http://localhost:3000/confirmar-cuenta?token=". $this->token ."'>Confirmar</a> </p>";
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
		$mail->Host = 'sandbox.smtp.mailtrap.io';
		$mail->SMTPAuth = true;
		$mail->Port = 2525;
		$mail->Username = '433de03e0e1a22';
		$mail->Password = 'b0249f95cf0647';

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
		$contenido .=  "<p><a href='http://localhost:3000/recuperar?token=". $this->token ."'>Restablecer password</a> </p>";
		$contenido .=  "<p>Si tu no solicitaste nada, puedes ignorar este mensaje</p>";
		$contenido .= "</html>";

		$mail->Body    = $contenido;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
	}
}
