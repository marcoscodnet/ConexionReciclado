<?php
session_start();
include_once('../bootstrap.php');
include_once('../clases/FileImage.php');
include_once('../clases/Validador.php');
include_once('../clases/Archivo.php');
include_once('../includes/defined.php');
include_once('../clases/class.phpmailer.php');

if (isset($_POST['productoId']) && $_POST['productoId'] != 0) {
	$producto = Doctrine::getTable('producto')->find($_POST['productoId']);
	if ($producto && $producto->publicacion->owner->codigo != $_SESSION['codigoUsuario'] && Usuario::admin()->codigo !=  $_SESSION['codigoUsuario']) {
		session_destroy();
		header('location: '.RUTA);
		exit();
	} else {
		$modificar = true;
		//$producto->imagenes->delete();
	}
} else {
    $producto = new Producto();
	$modificar = false;
}

include_once('../comprobadores/publicar.comprobador.php');

$subcategoria = Doctrine::getTable('subcategoria')->find($_POST['subcategoria']);
$contenedor = Doctrine::getTable('contenedor')->find($_POST['contenedor']);
$cantidad = new Cantidad ();
$cantidad->valor = $_POST['cantidadValor'];
$cantidad->medida = Doctrine::getTable('medida')->find($_POST['cantidadMedida']);

//precio
if (isset($_POST['tipo_precio'])) {
    if ($_POST['tipo_precio'] == 1) {
        $sugerencia = new Sugerencia ();
        $sugerencia->precio = 0;
        $sugerencia->medida = NULL;
        $producto->sugerencia = $sugerencia;
    } else {
        $producto->sugerencia = NULL;
    }
} else {
    $sugerencia = new Sugerencia ();
    $sugerencia->precio = $_POST['sugerenciaPrecio'];
    $sugerencia->medida = ($_POST['sugerenciaMedida'] != 0)?Doctrine::getTable('medida')->find($_POST['sugerenciaMedida']):NULL;
    $producto->sugerencia = $sugerencia;
}
//fin precio

//$periodicidad = Doctrine::getTable('periodicidad')->find($_POST['periodicidad']);
$fuente = Doctrine::getTable('fuente')->find($_POST['fuente']);
$frecuencia = Doctrine::getTable('frecuencia')->find($_POST['frecuencia']);
$direccion = new Direccion ();
//$direccion->calle = $_POST['calle'];
//$direccion->numero = $_POST['numero'];
//$direccion->codigoPostal = 0;
$direccion->localidad = Doctrine::getTable('localidad')->find($_POST['localidad']);
//$finalizacion = (isset($_POST['renovar']))?'':$_POST['finalizacion']; 

//$producto = ($_POST['productoId'] != 0)?Doctrine::getTable('producto')->find($_POST['productoId']):new Producto ();
$producto->subcategoria = $subcategoria;
$producto->contenedor = $contenedor;
$producto->cantidad = $cantidad;
//$producto->periodicidad = $periodicidad;
$producto->fuente = $fuente;
$producto->frecuencia = $frecuencia;
$producto->titulo = $_POST['titulo'];
$producto->descripcion = $_POST['descripcion'];
$producto->direccion = $direccion;
$producto->condiciones = $_POST['condiciones'];
$producto->requerimentos = $_POST['requerimentos'];

//$producto->periodo = (isset($_POST['periodo']))?$_POST['periodo']:'';
//$producto->procedencia = $_POST['dondeProviene'];
$producto->enContactoCon = Doctrine::getTable('encontactocon')->find($_POST['enContactoCon']);
$producto->detalle = (isset($_POST['detalle']))?$_POST['detalle']:'';
$producto->publicar_mail = ($_POST['publicar_mail'])?1:0;
$producto->save();

$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']);
if (!$usuario) {
	session_destroy();
	header('location: '.RUTA);
	exit();
}

Doctrine_Manager::connection()->flush();

if ($modificar) {
	//$producto->publicacion->finalizacion = $finalizacion;
	$producto->publicacion->estado = Estado::pendiente();
	$producto->publicacion->save();
} else {
	$usuario->publicar($producto, '');
}

/*IMAGENES*/
$imgCode = ($modificar)?$producto->id:$_SESSION['codigoUsuario'];
//$imgCode = $_SESSION['codigoUsuario'];
$i=0;
//$_Log = fopen("debug.log", "a+") or die("Operation Failed!");
foreach (glob(RUTA_IMAGENES.'producto'.$imgCode.'*') as $img) {
    $imageName = str_replace(RUTA_IMAGENES, '', $img);
	//echo $imageName."<br>";
    $ext = explode('.', $imageName);
   $imageModel = Doctrine::getTable('imagen')->findOneByRuta($imageName);
   if($imageModel){
		$i++;
	   $imageModel->ruta = 'producto'.$producto->id.'.'.$i.'.'.end($ext);
		//$producto->imagenes[] = $imagen;
		//print_r($imageModel);
		$imageModel->orden = $i;
		$imageModel->producto = $producto;
		//var_dump($imageModel);
		/*ob_start();
		var_dump($ima);
		fputs($_Log, ob_get_clean());
		ob_end_clean();*/
		
	   $imageModel->save();

	   rename(RUTA_IMAGENES.'gr/'.$imageName, RUTA_IMAGENES.'gr/'.'producto'.$producto->id.'.'.$i.'.'.end($ext));
		rename(RUTA_IMAGENES.'ch/'.$imageName, RUTA_IMAGENES.'ch/'.'producto'.$producto->id.'.'.$i.'.'.end($ext));
		rename(RUTA_IMAGENES.$imageName, RUTA_IMAGENES.'producto'.$producto->id.'.'.$i.'.'.end($ext));
   }
}
//fclose($_Log);

//$producto->save();
echo(3);

/*for ($i=1; $i<=4; $i++) {
	$nombreGif = 'producto'.$producto->id.'.'.$i.'.gif';
	$nombrePng = 'producto'.$producto->id.'.'.$i.'.png';
	$nombreJpg = 'producto'.$producto->id.'.'.$i.'.jpeg';
	
	if ($modificar) {
		$rutaGif = 'producto'.$producto->id.'.'.$i.'.gif';
		$rutaPng = 'producto'.$producto->id.'.'.$i.'.png';
		$rutaJpg = 'producto'.$producto->id.'.'.$i.'.jpeg';
	} else {	
		$rutaGif = 'producto'.$_SESSION['codigoUsuario'].'.'.$i.'.gif';
		$rutaPng = 'producto'.$_SESSION['codigoUsuario'].'.'.$i.'.png';
		$rutaJpg = 'producto'.$_SESSION['codigoUsuario'].'.'.$i.'.jpeg';
	}
	
	if (is_file(RUTA_IMAGENES.'gr/'.$rutaGif)) {
		$imagen = new Imagen ();
		$imagen->ruta = $nombreGif;
		$producto->imagenes[] = $imagen;
		$imagen->save();
		rename(RUTA_IMAGENES.'gr/'.$rutaGif, RUTA_IMAGENES.'gr/'.$nombreGif);
		rename(RUTA_IMAGENES.'ch/'.$rutaGif, RUTA_IMAGENES.'ch/'.$nombreGif);
		rename(RUTA_IMAGENES.$rutaGif, RUTA_IMAGENES.$nombreGif);
	}
	if (is_file(RUTA_IMAGENES.'gr/'.$rutaPng)) {
		$imagen = new Imagen ();
		$imagen->ruta = $nombrePng;
		$producto->imagenes[] = $imagen;
		$imagen->save();
		rename(RUTA_IMAGENES.'gr/'.$rutaPng, RUTA_IMAGENES.'gr/'.$nombrePng);
		rename(RUTA_IMAGENES.'ch/'.$rutaPng, RUTA_IMAGENES.'ch/'.$nombrePng);
		rename(RUTA_IMAGENES.$rutaPng, RUTA_IMAGENES.$nombrePng);
	}
	if (is_file(RUTA_IMAGENES.'gr/'.$rutaJpg)) {
		$imagen = new Imagen ();
		$imagen->ruta = $nombreJpg;
		$producto->imagenes[] = $imagen;
		$imagen->save();
		rename(RUTA_IMAGENES.'ch/'.$rutaJpg, RUTA_IMAGENES.'ch/'.$nombreJpg);
		rename(RUTA_IMAGENES.'gr/'.$rutaJpg, RUTA_IMAGENES.'gr/'.$nombreJpg);
		rename(RUTA_IMAGENES.$rutaJpg, RUTA_IMAGENES.$nombreJpg);
	}
	$producto->save();
}*/

$contenidoMail = 'La publicaci&oacute;n <a href="'.RUTA.'articulo.php?id='.$producto->id.'">'.$producto->titulo.'</a> ya se encuentra cargada y est&aacute; a la espera de ser aprobada por el administrador.';
	
//mail para el usuario
$mailTemplate = Archivo::leer(RUTA_LOCAL.'mail-template.html');
$mailTemplate = str_replace('<!--{mail}-->', $contenidoMail, $mailTemplate);
$mailTemplate = str_replace('<!--{asunto}-->', 'Publicaci&oacute;n cargada', $mailTemplate);
$mail = new PHPMailer();
$mail->PluginDir = RUTA_LOCAL."php/clases/include/";
$mail->Mailer = "smtp";
$mail->Host = "a2plcpnl0310.prod.iad2.secureserver.net";
$mail->SMTPAuth = true;
$mail->Username = "info@conexionreciclado.com.ar"; 
$mail->Password = "incore2050!";
$mail->Port = "465";
$mail->SMTPSecure = "ssl";
$mail->isSMTP();
$mail->From = "info@conexionreciclado.com.ar";
$mail->FromName = "Conexión Reciclado";
$mail->Timeout=30;
$mail->AddAddress($producto->publicacion->owner->email);
$mail->IsHTML(true);
$mail->Subject = "Publicación cargada - ".$producto->titulo;
$mail->Body = $mailTemplate;
$exito = $mail->Send();

$intento=1; 
while ((!$exito) && ($intento <= 3)) {
	sleep(3);
	$exito = $mail->Send();
	$intento++;	
}


header('location: '.RUTA.'articulo.php?id='.$producto->id);
?>