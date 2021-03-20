<?php
session_start();
$pagina = $_POST['pagina']-1;
$estado = $_POST['estado'];
$cuantos = 20;
$desde = $pagina * $cuantos;
//$total = Publicacion::contarPendientes();
$total = Publicacion::contarFiltrarEstado($estado);
$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_SESSION['codigoUsuario']);

//$publicaciones = Publicacion::listarPendientes($cuantos, $desde);
$publicaciones = Publicacion::filtrarEstado($cuantos, $desde, $estado);
$html = '<div class="cajaMensajesPerfil"><p style="color:#000;">Estados:'.Estado::toSelectPublicaciones($estado).'</p></div>';

foreach ($publicaciones as $publicacion) {
		$html .= $template;
	$link = 'articulo.php?id='.$publicacion->producto->id;
	$producto = $publicacion->producto;
	
	if ($publicacion->inSeguidores($usuario)) {
		$btnSeguir = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnDejarDeSeguir" id="seguir'.$producto->id.'">OLVIDAR</a></div>';
	} else {
		$btnSeguir = '<div class="botonesArticulo" style="float: left !important;"><a href="javascript:void(0);" class="btnSeguir" id="seguir'.$producto->id.'">SEGUIR</a></div>';
	}
	
	$botones = '
		<div class="botonVerEditar"><a href="'.$link.'">VER +</a></div>
		<div><a href="javascript:void(0)" class="botonAprobar" id="aprobar'.$producto->id.'">APROBAR </a></div>
		<div><a href="javascript:void(0)" class="btnBorrarAdmin" id="publicacion'.$producto->id.'">BORRAR </a></div>
	'.$btnSeguir
	;
	$titulo = 'ID='.$publicacion->producto->id.'<br />'.htmlentities(Texto::cortar($producto->titulo, 90));
	$html = str_replace('<!--{productoUrl}-->', $link, $html);
	$html = str_replace('<!--{productoTitulo}-->', $titulo, $html);
	$html = str_replace('<!--{productoImagenCh}-->', 'images/productos/ch/'.$producto->imagenes[0]->ruta, $html);
	$html = str_replace('<!--{productoDescripcion}-->', htmlentities(Texto::cortar($producto->descripcion, 150)), $html);
	$html = str_replace('<!--{botones}-->', $botones, $html);
}

$html .= Paginador::crearNumeritos ($cuantos, $total, 'listarPublicacionesAdmin', $_POST['pagina']);
?>