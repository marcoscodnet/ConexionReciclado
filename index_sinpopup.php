<?php
session_start();
include_once('php/clases/Archivo.php');
include_once('php/clases/Includer.php');
include_once('php/includes/defined.php');
include_once('php/bootstrap.php');
$html = Archivo::leer('tpl/header.html');
$html = str_replace('<!--{recursoJs}-->', Includer::addJs('jquery-1.6.1.min', 'loginRegister', 'jquery.nivo.slider.pack', 'cufon-yui', 'HelvLight_400.font', 'jquery.colorbox', 'dropdown-menu', 'nivo-slider-home', 'validadores', 'newsletter', 'helpers'), $html);
$html = str_replace('<!--{recursoCss}-->', Includer::addCss('reset', 'vistas', 'nivo-slider', 'colorbox'), $html);
$html = preg_replace('/<!-+\{*[A-Za-z0-9]*\}*-+>/', '', $html);
echo($html);
?>



<!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
  <link rel="stylesheet" href="css/style.css">
  <script>
  $(function() {
      /*if (!coockieHelper.getCookie('visitado')) {
        $.colorbox({href:'images/pop-up_conexion-reciclado.png'});
        coockieHelper.setCookie('visitado', 'true', 365);
      }*/
      //$.colorbox({href:'images/pop-up_conexion-reciclado.png'});
  });
  </script>


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
    <?php
    	$html = Archivo::leer('tpl/contenidoHome.html');
		include_once('php/replacers/contenidoHome.replacer.php');
		echo ($html);
	?>
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
    
    <script type="text/javascript">
        $('select[name="categoria"]').each(function () {
            $(this).addClass('form-control');
            $(this).find('option:first').remove();
        })
        $('select[name="categoria"]').bind('change', function () {
            var $this = $(this)
            if ($(this).val() !== '') {
                $.ajax({
                    type:'POST',
                    url:'php/controllers/subcategoriaSelect.controller.php',
                    data: 'cat='+$(this).val(),
                    success:function (ok) {
                        $this.next().next().html($(ok).addClass('form-control'));
                    }
                })
            } else {
                $this.next().next().html('<select class="form-control" disabled="disabled"><option value="">Cualquier Subcategor&iacute;a</option></select>')
            }
        })
        //$('select[name="categoria"]').change();
        $('.moduloOfertarDemandar .naranja').click(function (event) {
            event.preventDefault();
            location.href = $(this).attr('href')+'?'+$(this).parents('form').serialize();
        })
    </script>
    
</body>
</html>