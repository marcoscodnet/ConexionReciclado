<?php
session_start();
include_once('../php/bootstrap.php');
$usuario = Doctrine::getTable('usuario')->find($_GET['id']);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" href="../css/reset.css" rel="stylesheet" />
        <link type="text/css" href="../css/mensajes.colorbox.css" rel="stylesheet" />
        <link type="text/css" href="../css/formularios.css" rel="stylesheet" />
       
    </head>

    <body>
        <div class="formTemplate formLeerMensajeAdmin">
            <div class="formEncabezado">
                <p><span class="">Usuario</span></p>
            </div>
            <div class="camposContainer">
                <p><b><?php echo(($usuario->getNombre().' '.$usuario->getApellido())); ?></b></p>
            </div>
            <div class="camposContainer">
                <p><strong>Empresa: </strong><?php echo($usuario->getCompany()); ?><br /><br />
                    <strong>E-mail: </strong><?php echo(($usuario->getEmail())); ?><br /><br />
                    <strong>Tel&eacute;fono: </strong><?php echo(($usuario->telefonoToString())); ?><br /><br />
                    <strong>Celular: </strong><?php echo(($usuario->celularToString())); ?>
                    <br /><br />
                    <strong>Localidad: </strong><?php echo(($usuario->localidad->toString())); ?></p>
                
            </div>
            <div class="clear"></div>
        </div>


    </body>
</html>