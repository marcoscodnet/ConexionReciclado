<?php
if (isset($_GET['id'])) { //si se esta editando
	$producto = Doctrine::getTable('producto')->find($_GET['id']);
	
	$renovar = ($producto->publicacion->finalizacion == '01-01-2050')?'checked="checked"':'';
	
	$html = str_replace('<!--{productoTitulo}-->', $producto->titulo, $html);
	$html = str_replace('<!--{productoImagen}-->', 'images/productos/'.$producto->imagenes[0]->ruta.'?i='.time(), $html);
	$html = str_replace('<!--{productoImagenGr}-->', $producto->imagenesToHTML('gr'), $html);
	$html = str_replace('<!--{productoImagenCh}-->', $producto->imagenesToHTML(), $html);
	$html = str_replace('<!--{productoUrl}-->', 'articulo.php?id='.$producto->id, $html);
	$html = str_replace('<!--{productoCantidad}-->', htmlentities($producto->cantidad->valor), $html);
	$html = str_replace('<!--{publicacionTiempoRestante}-->', htmlentities($producto->publicacion->tiempoRestante), $html);
	$html = str_replace('<!--{productoDireccion}-->', htmlentities($producto->direccion->toString()), $html);
	$html = str_replace('<!--{productoSugerencia}-->', htmlentities($producto->sugerencia->precio), $html);
	$html = str_replace('<!--{productoDescripcion}-->', htmlentities($producto->descripcion), $html);
	$html = str_replace('<!--{productoPeriodo}-->', htmlentities($producto->periodo), $html);
	$html = str_replace('<!--{productoCondiciones}-->', htmlentities($producto->condiciones), $html);
	$html = str_replace('<!--{productoRequerimientos}-->', htmlentities($producto->requerimentos), $html);
	$html = str_replace('<!--{productoProcedencia}-->', htmlentities($producto->procedencia), $html);
	$html = str_replace('<!--{productoDetalle}-->', htmlentities($producto->detalle), $html);
	$html = str_replace('<!--{direccionCalle}-->', htmlentities($producto->direccion->calle), $html);
	$html = str_replace('<!--{direccionNumero}-->', htmlentities($producto->direccion->numero), $html);
	$html = str_replace('<!--{renovar}-->', $renovar, $html);
	$html = str_replace('<!--{clase}-->', 'class="btnEditar"', $html);
	
	/*selects*/
	$html = str_replace('<!--{categoriaToSelect}-->', $categoria->toSelect($producto), $html);
	$html = str_replace('<!--{subcategoriasToSelect}-->', $categoria->subcategoriasToSelect($producto), $html);
	$html = str_replace('<!--{medidaToSelect}-->', Medida::toSelect($producto), $html);
	$html = str_replace('<!--{fuenteToSelect}-->', Fuente::toSelect($producto), $html);
	$html = str_replace('<!--{frecuenciaToSelect}-->', Frecuencia::toSelect($producto), $html);
	$html = str_replace('<!--{contenedorToSelect}-->', Contenedor::toSelect($producto), $html);
	$html = str_replace('<!--{provinciaToSelect}-->', $provincia->toSelect($producto), $html);
	$html = str_replace('<!--{localidadesToSelect}-->', $provincia->localidadesToSelect($producto), $html);
	$html = str_replace('<!--{enContactoConToSelect}-->', EnContactoCon::toSelect($producto), $html);
	$checkedPublicarMail = ($producto->publicar_mail==1)?' checked ':'';
	$html = str_replace('<!--{publicarMail}-->', $checkedPublicarMail, $html);
	$html = str_replace('<!--{productoId}-->', $producto->id, $html);
	
} else { //si se esta cargando
	$html = str_replace('<!--{clase}-->', 'id="altaProducto"', $html);
	/*selects*/
	$prod = Doctrine::getTable('producto')->find(5);
	$html = str_replace('<!--{categoriaToSelect}-->', $categoria->toSelect(), $html);
	$html = str_replace('<!--{subcategoriasToSelect}-->', $categoria->subcategoriasToSelect(), $html);
	$html = str_replace('<!--{medidaToSelect}-->', Medida::toSelect(), $html);
	$html = str_replace('<!--{fuenteToSelect}-->', Fuente::toSelect(), $html);
	$html = str_replace('<!--{frecuenciaToSelect}-->', Frecuencia::toSelect(), $html);
	$html = str_replace('<!--{contenedorToSelect}-->', Contenedor::toSelect(), $html);
	$html = str_replace('<!--{provinciaToSelect}-->', $provincia->toSelect(), $html);
	$html = str_replace('<!--{localidadesToSelect}-->', $provincia->localidadesToSelect(), $html);
	$html = str_replace('<!--{enContactoConToSelect}-->', EnContactoCon::toSelect(), $html);
	$html = str_replace('<!--{productoId}-->', '0', $html);
}
$html = str_replace('<!--{codigoUsuario}-->', $_SESSION['codigoUsuario'], $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
?>