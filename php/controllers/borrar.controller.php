<?php
include_once('../bootstrap.php');
if ($usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['g'])) {
	$producto = Doctrine::getTable('producto')->find($_POST['productoId']);
	if ($producto->publicacion->owner->id == $usuario->id) {
		$producto->publicacion->estado = Estado::borrada();
		$producto->imagenes->delete();
		$producto->publicacion->save();
		echo ('borrar.exito.php');
	} else {
		echo ('borrar.error.php');
	}
} else {
	echo ('borrar.error.php');
}
?>