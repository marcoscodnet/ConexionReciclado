<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" href="../../css/reset.css" rel="stylesheet" />
        <link type="text/css" href="../../css/mensajes.colorbox.css" rel="stylesheet" />
        <link type="text/css" href="../../css/formularios.css" rel="stylesheet" />
        <script type="text/javascript">
			var url = top.location.pathname + '';
			urlArray = url.split('/');
			if (urlArray[urlArray.length-1] == 'publicaciones-admin.php') {
				window.parent.bindColorbox('reload');
			} else {
				window.parent.bindColorbox('publicaciones-admin.php');
			}
			setTimeout(window.parent.cerrarColorbox, 1800);
        </script>
    </head>

    <body>
        <div class="formTemplate formBorrarExito">
            <div class="formEncabezado">
                <p><span class="iconsSprite iconAtencion">Atenci&oacute;n</span></p>
            </div>
            <div class="camposContainer">
                <p><b>La publicaci&oacute;n ha sido dada de baja</b></p>
                <br/>
                <p>La publicaci&oacute;n se elimi&oacute; con &eacute;xito.</p>
            </div>
            <div class="clear"></div>
        </div>


    </body>
</html>