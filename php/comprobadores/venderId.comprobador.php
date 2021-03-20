<?php
if (isset($_GET['id'])) {
	$producto = Doctrine::getTable('producto')->find($_GET['id']);
	if ($producto && $producto->publicacion->owner->codigo != $_SESSION['codigoUsuario'] && Usuario::admin()->codigo !=  $_SESSION['codigoUsuario']) {
		session_destroy();
		header('location: '.RUTA);
		exit();
	}
}
?>
