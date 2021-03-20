<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
include_once('php/includes/defined.php');

/*



	Quickly and easily backup your MySQL database and have the

	tgz emailed to you.



	You need PEAR installed with the Mail and Mail_Mime packages

	installed.  Read more about PEAR here: http://pear.php.net

	

	This will work in any *nix enviornment.  Make sure you have

	write access to your /tmp directory.





*/

	

	// location of your temp directory

	$tmpDir = "/tmp/";

	// username for MySQL

	$user = "usrdbconrec";

	// password for MySQl

	$password = "usrco3!Codnet";

	// database name to backup

	$dbName = "dbconrec";

	// the zip file emailed to you will have this prefixed

	$prefix = "po_db_";

	// email settings...

	$to = "backupdb@codnet.com.ar";



	$sqlFile = $tmpDir.$prefix.date('Y_m_d').".sql";

	$attachment = $tmpDir.$prefix.date('Y_m_d').".tgz";



	$creatBackup = "mysqldump -u ".$user." --password=".$password." ".$dbName." > ".$sqlFile;

	$createZip = "tar cvzf $attachment $sqlFile";

	exec($creatBackup);

	exec($createZip);



	//$headers = array('From'    => $from, 'Subject' => $subject);

	$textMessage = $attachment;

	$htmlMessage = "";

	

	// envio del email

	require("php/clases/class.phpmailer.php");

	/*$mail = new PHPMailer();

	$mail->Host = "localhost";

	$mail->From = "backup@pampaonline.com";

	$mail->FromName = "Pampa Online";

	$mail->Subject = "Backup de base de datos ".date("d/m/Y");

	$mail->Body = $textMessage;

	$mail->AltBody = $textMessage;

	$mail->AddAttachment($attachment);

	$mail->AddAddress($to,$nombre);	

	$mail->Send();*/

	

	

	$mail = new phpmailer();

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

	$mail->Subject = "Backup Conexión Reciclado";

	$mail->Body = $textMessage;

	$mail->AltBody = $textMessage;

	$mail->AddAttachment($attachment);

	$mail->AddAddress($to);	

	$mail->Send();

	

//	$mime = new Mail_Mime("\n");

//	$mime->setTxtBody($textMessage);

//	$mime->setHtmlBody($htmlMessage);

//	$mime->addAttachment($attachment, 'text/plain');

//	$body = $mime->get();

//	$hdrs = $mime->headers($headers);

//	$mail = &Mail::factory('mail');

//	$mail->send($to, $hdrs, $body);



	unlink($sqlFile);

	unlink($attachment);



?>