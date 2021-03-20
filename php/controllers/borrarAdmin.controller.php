<?php
include_once('../bootstrap.php');
include_once('../clases/Archivo.php');
include_once('../includes/defined.php');
include_once('../clases/class.phpmailer.php');
$exito = Archivo::leer(RUTA_LOCAL.'tpl/mensajes/borrarAdmin.exito.php');
$error = Archivo::leer(RUTA_LOCAL.'tpl/mensajes/borrar.error.php');

$producto = Doctrine::getTable('producto')->find($_POST['id']);
$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['hd']);

if ($producto && $usuario && $usuario->id == Usuario::admin()->id) {
	$producto->publicacion->estado = Estado::borrada();
	
	$asunto = 'El administrador dio de baja la publicación '.$producto->titulo;
	$contenido = $_POST['contenido'];

	$mensaje = new Mensaje ();
	$mensaje->fecha = date('Y-m-d');
	$mensaje->asunto = $asunto;
	$mensaje->contenido = $contenido;
	$mensaje->estado = Estado::noLeido();
	$mensaje->emisor = Usuario::syst();
	$mensaje->receptor = $producto->publicacion->owner;
	
	//mail para el usuario
	$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
	$mailTemplate = str_replace('<!--{mail}-->', htmlentities($contenido), $mailTemplate);
	$mailTemplate = str_replace('<!--{asunto}-->', $asunto, $mailTemplate);
	$mail = new PHPMailer();
	$mail->PluginDir = RUTA_LOCAL."php/clases/include/";
	$mail->Mailer = "smtp";
	$mail->Host = "a2plcpnl0310.prod.iad2.secureserver.net";
	$mail->SMTPAuth = true;
	$mail->Username = "info@conexionreciclado.com.ar"; 
	$mail->Password = "incore2050!";
	$mail->Port = "465";
	$mail->SMTPSecure = "ssl";
	$mail->isSMTP();
	$mail->From = "info@conexionreciclado.com.ar";
	$mail->FromName = "Conexión Reciclado";
	$mail->Timeout=30;
	$mail->AddAddress($producto->publicacion->owner->email);
	$mail->IsHTML(true);
	$mail->Subject = $asunto;
	$mail->Body = $mailTemplate;
	$ok = $mail->Send();
	
	$intento=1; 
	while ((!$ok) && ($intento <= 3)) {
	sleep(3);
		$ok = $mail->Send();
		$intento++;	
	}
	
	Doctrine_Manager::connection()->flush();
	echo ($exito);
} else {
	echo ($error);
}

?>