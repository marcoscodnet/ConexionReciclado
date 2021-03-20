<?php
$pagina = $_POST['pagina']-1;
$cuantos = 4;
$desde = $pagina * $cuantos;
$total = Doctrine::getTable('transaccion')->findByid_estado(1)->count();

$q = Doctrine_Query::create()
	->select('t.*')
	->from('Transaccion t')
	->innerJoin('t.estado e')
	->where('e.contenido = "aceptada"')
	->limit($cuantos) //cuantos trae
	->offset($desde); //a partir de donde empieza a traer
$transacciones = $q->execute();

foreach ($transacciones as $transaccion) {
	$html .= $template;
	$producto = $transaccion->publicacion->producto;
	$link = 'conexion.php?id='.$producto->id;
	$botones = '
		<div class="botonVerEditar"><a href="'.$link.'">VER +</a></div>
	';
	$html = str_replace('<!--{productoUrl}-->', $link, $html);
	$html = str_replace('<!--{productoTitulo}-->', htmlentities(Texto::cortar($producto->titulo, 90)), $html);
	$html = str_replace('<!--{productoImagenCh}-->', 'images/productos/ch/'.$producto->imagenes[0]->ruta, $html);
	$html = str_replace('<!--{productoDescripcion}-->', htmlentities(Texto::cortar($producto->descripcion, 150)), $html);
	$html = str_replace('<!--{botones}-->', $botones, $html);
}

$html .= Paginador::crearNumeritos ($cuantos, $total, 'listarPublicacionesAdmin', $_POST['pagina']);
?>