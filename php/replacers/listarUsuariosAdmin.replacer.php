<?php
//print_r($_POST);
$pagina = $_POST['pagina'] - 1;
$cuantos = 100;
$desde = $pagina * $cuantos;
$buscarUsuario = $_POST['buscarUsuario'];
$filtroUsuario = ($buscarUsuario)?"u.nombre like '%".$buscarUsuario."%' OR u.apellido like '%".$buscarUsuario."%' OR u.email like '%".$buscarUsuario."%'":'1=1';
$total = Doctrine_Query::create()
        ->select('count(u.id)')
        ->from('Usuario u')
        ->where('u.id <> 1')
        ->andWhere('u.id <> 2')
        ->andWhere($filtroUsuario)
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;

$usuarios = Doctrine_Query::create()
        ->select('u.*')
        ->from('Usuario u')
        ->where('u.id <> 1')
        ->andWhere('u.id <> 2')
        ->andWhere($filtroUsuario)
        ->limit($cuantos) //cuantos trae
        ->offset($desde) //a partir de donde empieza a traer
        ->orderBy('u.nombre')
        ->execute()
        
;
$html = '<div class="cajaMensajesPerfil"><p style="color:#000;">Buscar:<input type="text" id="buscarUsuario" name="buscarUsuario" value="'.$buscarUsuario.'"/><input type="button" id="buscar" name="buscar" value="buscar" onClick="hacerPeticion(0)"/></p></div>';
foreach ($usuarios as $usuario) {
    if ($usuario->codigo == Usuario::admin()->codigo || $usuario->codigo == Usuario::syst()->codigo)
        continue;
    $a = rand(1, 200);
    $b = time();
    $c = rand(1, 200);
    $d = md5('passAdmin');
    $e = rand(1, 200);
    $html .= $template;
    $html = str_replace('<!--{a}-->', $a, $html);
    $html = str_replace('<!--{b}-->', $b, $html);
    $html = str_replace('<!--{c}-->', $c, $html);
    $html = str_replace('<!--{d}-->', $d, $html);
    $html = str_replace('<!--{e}-->', $e, $html);
    $html = str_replace('<!--{usuarioId}-->', $usuario->id, $html);
    $html = str_replace('<!--{usuarioToString}-->', utf8_encode($usuario->toString()), $html);
    $html = str_replace('<!--{mailToString}-->', ($usuario->email), $html);
    //$html = str_replace('<!--{usuarioReputacion}-->', $usuario->reputacion, $html);
    $html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
}

$html .= Paginador::crearNumeritos($cuantos, $total, 'listarMensajesAdmin', $_POST['pagina']);
?>