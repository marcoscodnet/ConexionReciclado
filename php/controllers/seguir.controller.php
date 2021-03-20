<?php
include_once('../includes/defined.php');
include_once('../bootstrap.php');
if ( !($usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']))) {
	echo ('usuarioInvalido.error.php');
	exit();
}
if ( !($producto = Doctrine::getTable('producto')->find($_POST['productoId']))) {
	echo ('productoInvalido.error.php');
	exit();
}
if ($_POST['accion'] == 'btnDejarDeSeguir') {
	$q = Doctrine_Query::create()
		->delete('Favorito')
		->where('user_id = '.$usuario->id)
		->andWhere('favorito_id = '.$producto->publicacion->id);
	$q->execute();
	echo('dejar');
	exit();
}

//valida que el usuario no pueda seguir un producto que ya esta siguiendo
if ($usuario->inFavoritos($producto)) {
	echo ('seguirRepetido.error.php');
	exit();
} else if ($producto->publicacion->owner->id == $usuario->id){
	echo ('seguirProductoPropio.error.php');
	exit();
} else {
	$usuario->favoritos[] = $producto->publicacion;
	$usuario->save();
	exit();
}


?>