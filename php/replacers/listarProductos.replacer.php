<?php

foreach ($productos as $producto) {
    $html .= $template;
    //if ($producto->estadoPublicacion == 'comprada') { 12-01-2015
    if ($producto->publicacion->estado->contenido == 'comprada') {
        if ($producto->publicacion->transaccion->isVencida()) {
            $html = '';
            continue;
        } else {
            $estado = 'vendido';
        }
    } else {
        $estado = '';
    }

    $botonCompartir = '<div class="compartir botonesArticulo"><a href="javascript:void(0)" class="btnCompartir" id="compartir' . $producto->id . '">COMPARTIR</a></div>';

    $html = str_replace('<!--{productoTitulo}-->', utf8_encode($producto->titulo), $html);
    $html = str_replace('<!--{productoImagen}-->', 'images/productos/' . $producto->imagenes[0]->ruta, $html);
    $html = str_replace('<!--{productoImagenGr}-->', $producto->imagenesToHTML('gr'), $html);
    //$html = str_replace('<!--{productoImagenCh}-->', $producto->imagenesToHTML(), $html);
    $html = str_replace('<!--{productoUrl}-->', 'articulo.php?id=' . $producto->id, $html);
    $html = str_replace('<!--{productoCantidad}-->', utf8_encode($producto->cantidad->toString()), $html);
    //$html = str_replace('<!--{publicacionTiempoRestante}-->', utf8_encode($producto->publicacion->tiempoRestante), $html);
    $html = str_replace('<!--{productoDireccion}-->', utf8_encode($producto->direccion->toString()), $html);
    $html = str_replace('<!--{productoSugerencia}-->', utf8_encode($producto->precioPorTotal()), $html);
    $html = str_replace('<!--{productoDescripcion}-->', utf8_encode(Texto::cortar($producto->descripcion, 300)), $html);
    $html = str_replace('<!--{productoEstado}-->', $estado, $html);
    if (isset($_POST['fg']) && $_POST['fg'] != '') {
        $usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['fg']);
        if ($producto->publicacion->inSeguidores($usuario)) {
            $botonSeguir = '<div class="botonesArticulo" style="float:right !importan; width:70px"><a href="javascript:void(0);" class="btnDejarDeSeguir" id="seguir<!--{productoId}-->">OLVIDAR</a></div>';
        } else {
            $botonSeguir = '<div class="botonesArticulo" style="float:right !importan; width:70px"><a href="javascript:void(0);" class="btnSeguir" id="seguir<!--{productoId}-->">SEGUIR</a></div>';
        }
        /*if ($usuario->id == Usuario::admin()->id) {
            $html = str_replace('<!--{botonCompartir}-->', '', $html);
        } else */ if ($usuario->id == $producto->publicacion->owner->id) {
            $html = str_replace('<!--{botonCompartir}-->', $botonCompartir, $html);
        } else {
            $html = str_replace('<!--{botonCompartir}-->', $botonCompartir . $botonSeguir, $html);
        }
    }
    $html = str_replace('<!--{botonCompartir}-->', $botonCompartir, $html);
    $html = str_replace('<!--{productoId}-->', $producto->id, $html);
};
?>