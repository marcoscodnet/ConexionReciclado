<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<link rel="stylesheet" href="http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/images/base.min.css"/>
<link rel="stylesheet" href="http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/images/fancy.min.css"/>
<link rel="stylesheet" href="http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/images/main.css"/>

<script src="http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/images/compatibility.min.js"></script>

<script>
try{
theViewer.defaultViewer = new theViewer.Viewer({});
}catch(e){}
</script>
<title></title>
</head>
<body>


<div class="pc pc7 w0 h0"><img class="bi x4 y7 w2 h0" alt="" src="http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/images/bg3.png"/>


<table class="t x5 h6">
<tr class="fsLP fc2 ff3 sc0 lsLP ws0">
 <td colspan="5">
LISTA DE PRECIOS<br><br>
</td>
</tr>   
<tr class="fsListaPrecio fc1 ff2 sc0 ls1 ws0" style="border-width:1px;border-color:black">
  <td style="font-weight:bold; text-align:center;" width="100px;">MATERIAL</td>
  <td style="font-weight:bold; text-align:center;" width="100px;">$/KG</td>
  <td style="font-weight:bold; text-align:center;" width="20%">VAR. TRIM. ANT. ($)</td>
  <td style="font-weight:bold; text-align:center;" width="20%">VAR. TRIM. ANT. (%)</td>
  <td style="font-weight:bold; text-align:center;" width="100px;">ACOPIADOR/RECICLADOR</td>
</tr>
 <?php
 foreach($listaPrecio as $tr): ?>
    <tr class="fsListaPrecio fc1 ff2 sc0 ls1 ws0" style="border-width:1px;border-color:black">
      <td><?echo utf8_decode($tr->material)?></td>
      <td style="text-align:center;"><?echo  trim( number_format($tr->precio_kg, 2, ',', '.') ) ;?></td>
      <td style="text-align:center;"><?echo trim( number_format($tr->variacion_precio, 2, ',', '.') ) ;?></td>
      <td style="text-align:center;"><?echo trim( number_format($tr->variacion_porcentaje, 2, ',', '.') ) ;?></td>
	  <td style="text-align:center;"><?echo utf8_decode($tr->tipo)?></td>
   </tr>                        
                        
 <?php  endforeach; ?>
 <tr class="fsListaPrecio fc1 ff2 sc0 ls1 ws0">
 <td colspan="5">
Los precios expresados corresponden al promedio del precio pagado por empresas recicladoras y/o acopiadores seg&uacute;n informado por 5 plantas de<br>clasificaci&oacute;n localizadas en el Area Metropolitana de Buenos Aires en un relevamiento a cargo de Conexi&oacute;n Reciclado.<br><br>
Ultima Actualizaci&oacute;n: Junio 2016<br><br>
Para conocer los precios por kilo de material reciclable de otras provincias consult&aacute; el listado de precios de referencia del <br><a href="http://observatoriorsu.ambiente.gob.ar/herramientas/6/precios-de-referencia-de-materiales-reciclables" target="_blank">Observatorio Nacional para la Gesti&oacute;n de Residuos S&oacute;lidos.</a>

</td>
</tr>      
</table>

</body>
</html>
