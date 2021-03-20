<?php
session_start();
include_once('php/clases/Archivo.php');
include_once('php/clases/Includer.php');
include_once('php/includes/defined.php');
include_once('php/bootstrap.php');
$provincia = Doctrine::getTable('provincia')->find(1);
$categoria = Doctrine::getTable('categoria')->find(1);
$html = Archivo::leer('tpl/header.html');
$html = str_replace('<!--{recursoJs}-->', Includer::addJs('jquery-1.6.1.min', 'jquery.colorbox', 'loginRegister', 'cufon-yui', 'HelvLight_400.font', 'dropdown-menu', 'jquery-ui.min', 'listarPublicacionesAdmin', 'validadores', 'newsletter', 'seguir'), $html);
$html = str_replace('<!--{recursoCss}-->', Includer::addCss('reset', 'vistas', 'jquery-ui', 'jquery.fileupload-ui', 'colorbox'), $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
echo($html);
include_once('php/comprobadores/loginNoAdmin.comprobador.php');
?>
<body>
	<!-- ENCABEZADO - LOGO - BOTONERA -->
    <div id="header-wrapper">
        <div class="contAnchoHeader">
        <?php
			include_once('php/comprobadores/encabezado.comprobador.php');
			$html = Archivo::leer('tpl/logoBotonera.html');
                        $class = (isset($_SESSION['log']))?'':'class="login"';
                        $vender = (isset($_SESSION['log']))?'vender.php':'tpl/formularios/login.php';
                        $html = str_replace('<!--{comprobarVender}-->', $vender, $html);
                        $html = str_replace('<!--{class}-->', $class, $html);
                        echo($html);
		?>
        </div>
    </div>
    <!-- FIN ENCABEZADO - LOGO - BOTONERA -->

    <div class="clear"></div>

    <!-- CONTENIDO HOME -->
    <div id="content-wrapper">
        <?php include 'tpl/contenidoPublicacionesAdmin.php'; ?>
    </div>
    <!-- FIN CONTENT WRAPPER -->

    <div class="clear"></div>
    
    <!-- FOOTER WRAPPER -->
    <div id="footer-wrapper">
    <?php
    	$html = Archivo::leer('tpl/pieDePagina.html');
		include_once('php/replacers/pieDePagina.replacer.php');
		echo ($html);
	?>
    </div>
    <!-- FIN FOOTER WRAPPER -->
</body>
</html>