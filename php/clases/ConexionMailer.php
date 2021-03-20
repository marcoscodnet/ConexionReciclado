<?php

class ConexionMailer extends PHPMailer {
    public function __construct() {
        //parent::__construct();
        $this->PluginDir = RUTA_LOCAL."php/clases/include/";
	$this->Mailer = "smtp";
	$mail->Host = "a2plcpnl0310.prod.iad2.secureserver.net";
	$this->SMTPAuth = true;
	$mail->Port = "465";
	$mail->SMTPSecure = "ssl";
	$mail->isSMTP();
	$this->Username = "info@conexionreciclado.com.ar"; 
	$this->Password = "incore2050!";
	$this->From = "info@conexionreciclado.com.ar";
	$this->FromName = "Conexión Reciclado";
	$this->Timeout=30;
        $this->IsHTML(true);
    }
}

?>
