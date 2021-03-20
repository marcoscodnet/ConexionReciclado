<?php
$pagina = $_POST['pagina']-1;
$cuantos = 4;
$desde = $pagina * $cuantos;
$total = $usuario->contar('misPublicaciones');

$publicaciones = $usuario->paginar('misPublicaciones', $cuantos, $desde);
foreach ($publicaciones as $publicacion) {
	if ($publicacion->estado->id != Estado::borrada()->id) {
		$html .= $template;
		$link = 'articulo.php?id='.$publicacion->producto->id;
		$producto = $publicacion->producto;
		$pendiente = ($publicacion->estado->id == Estado::pendiente()->id)?' (aun no aprobada)':'';
		$botones = '
			<div class="botonVerEditar"><a href="'.$link.'">VER +</a></div>
			<div><a href="vender.php?id='.$producto->id.'" class="btnEditar">EDITAR</a></div>
			<div><a href="javascript:void(0)" class="btnBorrar" id="publicacion'.$producto->id.'">BORRAR </a></div>
		';
		$html = str_replace('<!--{productoUrl}-->', $link, $html);
		$html = str_replace('<!--{productoTitulo}-->', htmlentities(Texto::cortar($producto->titulo, 90)).$pendiente, $html);
		$html = str_replace('<!--{productoImagenCh}-->', 'images/productos/ch/'.$producto->imagenes[0]->ruta, $html);
		$html = str_replace('<!--{productoDescripcion}-->', htmlentities(Texto::cortar($producto->descripcion, 150)), $html);
		$html = str_replace('<!--{botones}-->', $botones, $html);
	}
}

$html .= Paginador::crearNumeritos ($cuantos, $total, $_POST['accion'], $_POST['pagina']);
?>