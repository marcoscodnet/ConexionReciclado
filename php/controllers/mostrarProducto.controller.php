<?php
$html = Archivo::leer('tpl/producto.php');
$producto404 = Archivo::leer(RUTA_LOCAL.'tpl/producto404.php');
if (!$producto = Doctrine::getTable('producto')->find($_GET['id'])) {
	echo ($producto404);
	exit();
}
$comprada = ($producto->publicacion->estado->id == Estado::comprada()->id);
$finalizada = ($producto->publicacion->estado->id == Estado::finalizada()->id);

if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido') {
	$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_SESSION['codigoUsuario']);
} else {
	$usuario = false;
}

include_once(RUTA_LOCAL.'php/comprobadores/mostrarProducto.comprobador.php');

$botonBorrarAdmin = '<div class="botonesArticulo" style="float: left !important; margin-top:5px"><a href="tpl/mensajes/borrar.confirm.php" class="btnBorrarAdmin">BORRAR</a></div>';
$botonAprobarAdmin = '<div class="botonesArticulo botonAprobar" style="float: left !important;"><a href="javascript:void(0)" class="btnAceptarAdmin">APROBAR</a></div>';

$duracion = '<span>Duraci&oacute;n del contrato:</span> ';
$periodo = ($producto->periodo)?$duracion.($producto->periodoToString()):'';
$codigo = (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido')?$_SESSION['codigoUsuario']:'';

if ($producto->enContactoCon->id != 1) {
	$enContactoCon = '
		<p><span>Ha estado en contacto con: '.$producto->enContactoCon->contenido.'</span></p>
		<p>'.nl2br(($producto->detalle)).'</p>
	';
} else {
	$enContactoCon = '';
}

if ($producto->requerimentos) {
	$requerimentos = '
		<p><span>Requerimientos especiales para su transporte:</span></p>
		<p>'.nl2br(($producto->requerimentos)).'</p>
	';
} else {
	$requerimentos = '';
}

if ($producto->condiciones) {
	$condiciones = '
		<p><span>Condiciones especiales para su reutilizaci&oacute;n:</span></p>
		<p>'.nl2br(($producto->condiciones)).'</p>
	';
} else {
	$condiciones = '';
}

if ($producto->procedencia) {
	$procedencia = '
		<p><span>&iquest;De d&oacute;nde proviene? &iquest;Para qu&eacute; fue utilizado?</span></p>
		<p>'.nl2br(($producto->procedencia)).'</p>
	';
} else {
	$procedencia = '';
}
	
if (isset($_SESSION['log']) && $_SESSION['log'] == 'usuarioValido') {
	if ($producto->publicacion->owner->codigo == $_SESSION['codigoUsuario'] && !$comprada) { //si es el dueño
		$html = str_replace('<!--{botonesAcciones}-->', $btnCompartir, $html);
		$html = str_replace('<!--{botonesMensaje}-->', Archivo::leer('tpl/pieArticuloOwner.html'), $html);
	} else if (!$producto->isVencido()) {
		if (Usuario::admin()->codigo == $_SESSION['codigoUsuario']) { //si es el admin
			if ($producto->publicacion->estado->id == Estado::aceptada()->id) {
				$html = str_replace('<!--{botonesAcciones}-->', $botonBorrarAdmin, $html);
			}
                        $html = str_replace('<!--{usuarioToString}-->', '<p style="color: #464646; font-size: 18px">Usuario: '.($producto->publicacion->owner->toString()).'</p>', $html);
                        $html = str_replace('<!--{botonesMensaje}-->', Archivo::leer('tpl/pieArticuloOwner.html').'<!--{botonesMensaje}-->', $html);
			$html = str_replace('<!--{botonesAcciones}-->', $botonAprobarAdmin.$botonBorrarAdmin, $html);
		} else { //si es un usuario logueado
			$producto->publicacion->visitas = $producto->publicacion->visitas + 1;
			$producto->publicacion->save();
			$html = str_replace('<!--{botonesAcciones}-->', $btnComprar.$btnCompartir.$btnSeguir, $html);
		}
		if (!$comprada) {
			$html = str_replace('<!--{botonesMensaje}-->', Archivo::leer('tpl/pieArticuloLogin.html'), $html);
			$html = str_replace('<!--{mensajeAsunto}-->', 'Consulta por el art&iacute;culo '.$producto->titulo, $html);
			$html = str_replace('<!--{codigoUsuario}-->', $_SESSION['codigoUsuario'], $html);
		} 
	} else {
		echo ($producto404);
		exit();
	}
} else if (!$producto->isVencido()) { //si es un usuario no logueado
	$html = str_replace('<!--{botonesAcciones}-->', $btnCompartirNoLogin.$btnComprarNoLogin, $html);
	$html = str_replace('<!--{botonesMensaje}-->', Archivo::leer('tpl/pieArticuloNoLogin.html'), $html);
	$producto->publicacion->visitas = $producto->publicacion->visitas + 1;
	$producto->publicacion->save();
} else {
	echo ($producto404);
	exit();
}

/* Lineas comunes a todas las posibilidades */
$html = str_replace('<!--{productoTitulo}-->', ($producto->titulo), $html);
$html = str_replace('<!--{productoCategoria}-->', ($producto->subcategoria->categoria->contenido), $html);
$html = str_replace('<!--{productoSubcategoria}-->', ($producto->subcategoria->contenido), $html);
$html = str_replace('<!--{productoContenedor}-->', ($producto->contenedor->contenido), $html);
$html = str_replace('<!--{productoFuente}-->', ($producto->fuente->contenido), $html);
$html = str_replace('<!--{productoImagen}-->', 'images/productos/'.$producto->imagenes[0]->ruta, $html);
$html = str_replace('<!--{productoImagenGr}-->', $producto->imagenesToHTML('gr'), $html);
$html = str_replace('<!--{productoImagenCh}-->', $producto->imagenesToHTML(), $html);
$html = str_replace('<!--{productoUrl}-->', 'producto.php?id='.$producto->id, $html);
$html = str_replace('<!--{productoCantidad}-->', ($producto->cantidad->toString()), $html);
$html = str_replace('<!--{productoFrecuencia}-->', ($producto->frecuencia->contenido), $html);
$html = str_replace('<!--{publicacionTiempoRestante}-->', ($producto->publicacion->tiempoRestante), $html);
$html = str_replace('<!--{productoDireccion}-->', ($producto->direccion->toString()), $html);
$html = str_replace('<!--{precioPorUnidad}-->', ($producto->precioPorUnidad()), $html);
$html = str_replace('<!--{precioPorTotal}-->', ($producto->precioPorTotal()), $html);
$html = str_replace('<!--{productoDescripcion}-->', nl2br(($producto->descripcion)), $html);
$html = str_replace('<!--{productoCondiciones}-->', $condiciones, $html);
$html = str_replace('<!--{productoRequerimentos}-->', $requerimentos, $html);
$html = str_replace('<!--{productoProcedencia}-->', $procedencia, $html);
$html = str_replace('<!--{enContactoCon}-->', $enContactoCon, $html);
//$html = str_replace('<!--{usuarioPuntos}-->', html_entity_decode($producto->publicacion->owner->reputacion), $html);
$html = str_replace('<!--{productoPeriodo}-->', $periodo, $html);
$html = str_replace('<!--{publicacionVisitas}-->', ($producto->publicacion->visitas), $html);
if (Usuario::admin()->codigo == $_SESSION['codigoUsuario']) { //si es el admin
	$html = str_replace('<!--{publicacionMail}-->', '<span>Mail: </span>'.($producto->publicacion->owner->email), $html);
}
elseif($producto->publicar_mail==1){
	$html = str_replace('<!--{publicacionMail}-->', '<span>Mail: </span>'.($producto->publicacion->owner->email), $html);
}
$html = str_replace('<!--{productoId}-->', $_GET['id'], $html);
$html = str_replace('<!--{codigoUsuario}-->', $codigo, $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
echo ($html);                        
                            



?>