<?php
if (!$producto->publicacion->mostrar($usuario)) {
	echo ($producto404);
	exit();
}

if (isset($_SESSION['codigoUsuario']) && $producto->publicacion->inSeguidores($usuario)) {
	$btnSeguir = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnDejarDeSeguir" id="seguir<!--{productoId}-->">OLVIDAR</a></div>';
} else {
	$btnSeguir = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnSeguir" id="seguir<!--{productoId}-->">SEGUIR</a></div>';
}

if ($producto->publicacion->estado->id != Estado::pendiente()->id) {
	$btnCompartir = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnCompartir" id="compartir<!--{productoId}-->">COMPARTIR</a></div>';
	$btnCompartirNoLogin = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnCompartir noLogin" id="compartir<!--{productoId}-->">COMPARTIR</a></div>';
} else {
	$btnCompartir = '';
}

if ($comprada || $finalizada) {
	$tpl = ($comprada)?Archivo::leer('tpl/pieArticuloPendiente.html'):Archivo::leer('tpl/pieConexion.html');
	$btnComprar = '';
	$btnSeguir = '';
	$btnCompartir = '';
	$html = str_replace('<!--{botonesMensaje}-->', $tpl, $html);
	$html = str_replace('<!--{conexionComprador}-->', ($producto->publicacion->transaccion->comprador->toString()), $html);
$html = str_replace('<!--{conexionVendedor}-->', ($producto->publicacion->transaccion->vendedor->toString()), $html);
$html = str_replace('<!--{conexionFecha}-->', $producto->publicacion->transaccion->fecha, $html);
} else {
	$btnComprar = '<div class="botonesArticulo" style="float: left !important;"><span href="javascript:void(0);" id="comprar" class="btn celeste">Contactar</span></div>';
	$btnComprarNoLogin = '<div class="botonesArticulo" style="float: left !important;"><span class="login cboxElement btn celeste" href="tpl/formularios/login.php" id="comprar">Contactar</span></div>';
}

?>