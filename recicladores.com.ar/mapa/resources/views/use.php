<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Mapa de Recicladores de Argentina</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style type="text/css">
	
    @font-face {
       font-family: 'Avenir LT Std 85 Heavy';
       font-style: normal;
       font-weight: normal;
       src: local('Avenir LT Std 85 Heavy'), url('http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/images/AvenirLTStd-Heavy.woff') format('woff');
    }
    @font-face {
       font-family: 'Avenir LT Std 85 Medium';
       font-style: normal;
       font-weight: normal;
       src: local('Avenir LT Std 85 Medium'), url('http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/images/AvenirLTStd-Medium.woff') format('woff');
    }
       #menu {
        position:relative;
        width:70%;
        height:100%;
        float:right;
    }
    .itemMenu
    {
        font-family:'Avenir LT Std 85 Heavy';
        position:relative;
        bottom:-35px;
        float:right;
        font-size:13px;
        
    }
    a {
     color: #454545; /* Tu color en Hexa o RGB */
     text-decoration: none;
    }
    a:hover {
      color: #414141;
      text-decoration: none;
    }
   .page-header-mio{
      border-bottom: 1px solid #eee;
      padding-bottom:9px;
      margin-top: 1px;
   }

   #footer{
        position:relative;
        float:right;
    }
    spam.buscador {
	border:1px solid #d7d7d7;
	padding: 4px;
	height: 22px;
	width: 270px;
}
input.buscar {
	border: 0px;
	width: 220px;
	position: relative;
	background: transparent;
	outline: none;
	padding: 2px;
}
input.image_buscar {
	width: 20px;
	border: 0px;
	position: relative;
	top:5px;
}
.textGris
    {
        font-family:'Avenir LT Std 85 Medium';
        color:#808080;
        font-size:12px;
    }
    

    .modalDialog {
		position: fixed;
		font-family: Arial, Helvetica, sans-serif;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0,0,0.8);
		z-index: 99999;
		opacity:0;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		pointer-events: none;
	}

	.modalDialog:target {
		opacity:1;
		pointer-events: auto;
	}

	.modalDialog > div {
		width: 400px;
		position: relative;
		margin: 10% auto;
		padding: 5px 20px 13px 20px;
		border-radius: 10px;
		background: #fff;
		background: -moz-linear-gradient(#fff, #999);
		background: -webkit-linear-gradient(#fff, #999);
		background: -o-linear-gradient(#fff, #999);
	}

	.close {
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		position: absolute;
		right: -12px;
		text-align: center;
		top: -10px;
		width: 24px;
		text-decoration: none;
		font-weight: bold;
		-webkit-border-radius: 12px;
		-moz-border-radius: 12px;
		border-radius: 12px;
		-moz-box-shadow: 1px 1px 3px #000;
		-webkit-box-shadow: 1px 1px 3px #000;
		box-shadow: 1px 1px 3px #000;
	}

	.close:hover { background: #00d9ff; }
    </style>
	 <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('buscador')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  //autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAggBwZ10PL9galUdtJZ2HR221SbKKXb3M&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
<script>
function enviarForm(tipo, cat, subcat){
var direccion = document.getElementById("direccion");
var buscador= document.getElementById("buscador");
var tipo_reciclador= document.getElementById("tipo_reciclador");
var categoria= document.getElementById("categoria");
var subcategoria= document.getElementById("subcategoria");
var cambioTipo = 0;
if(tipo==0){
   tipo_reciclador.value = '<?php echo (!$options['tipo_reciclador'])?"1" : $options['tipo_reciclador'];?>';
}
else{
   tipo_reciclador.value = tipo;
   cambioTipo = 1;
}
if(cambioTipo){
   categoria.value = 0;
   subcategoria.value = 0;
}
else{
if(cat==0){
   categoria.value = '<?php echo $options['categoria'];?>';
}
else{
   if((tipo_reciclador.value==1)||(tipo_reciclador.value==2)){
     categoria.value = cat;
   }
   else{
     categoria.value = 0;
   }
   
}
}
if(cambioTipo){
   categoria.value = 0;
   subcategoria.value = 0;
}
else{
if(subcat==0){
   //subcategoria.value = '<?php echo $options['subcategoria'];?>';
}
else{
   subcategoria.value = subcat;
}
}
var form= document.getElementById("form-id");
direccion.value = buscador.value;

form.submit();
}

</script>
</head>

<body>


  <div class="container">
      
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-header-mio">
            <a href='http://recicladores.com.ar/'><img src='http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/images/logo_header.PNG'></a>
            <div id="menu">
              <div class="itemMenu"><a href='http://recicladores.com.ar/'>MAPA</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://recicladores.com.ar?pagina=1'>QUÃ‰ ES</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://recicladores.com.ar?pagina=4'>LISTA DE PRECIOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://recicladores.com.ar?pagina=2'>QUIÃ‰NES SOMOS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://recicladores.com.ar?pagina=3'>CONTACTO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <spam class="buscador">
    
        <input id="buscador" name="buscador" type="textbox" value="<?php echo $direccion; ?>" class="buscar" placeholder="BUSCADOR" onFocus="geolocate()">
        <input type="image" src="http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/images/search.png" class="image_buscar" onClick="enviarForm(0,0,0);" >
    
</spam> 
<spam style="padding:4px;"></spam>
              </div>
              
            </div>
          </h1>
        </div>
      </div>
      <div class="row">
<div class="col-md-2">
          <div style="font-family:'Avenir LT Std 85 Heavy';font-size:15px;">El mapa de la cadena de valorizaciÃ³n de residuos en Argentina</div>
<h1 class="page-header-mio"></h1>
          <form action="/" method="GET" id="form-id">
              
              <p><div class="textGris">FILTRAR: TIPO</div></p>
              <div style="font-family:'Avenir LT Std 85 Medium';font-size:10px;">
                <?php
					if(!$options['tipo_reciclador']){
						$options['tipo_reciclador']=1;
					}
                    foreach($tipo_reciclador as $tr): ?>
                       <p>
                        <img src='http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/iconos/<?=$tr->id?>.png'  height="12" width="12">
                        <?php if($options['tipo_reciclador']==$tr->id){
                          echo "<u>";
                        }?> 
                        <a href="#" onclick="enviarForm('<?=$tr->id?>','0','0')"><?=$tr->value?></a>
                        <?php if($options['tipo_reciclador']==$tr->id){
                          echo "</u>";
                        }?> 
                        </p>
                    <?php  endforeach; ?>
              </div>
              <h1 class="page-header-mio"></h1>
<div id="divCat" style="display:<?php if(($options['tipo_reciclador']==1)||($options['tipo_reciclador']==2)){ ?> block <?php } else { ?>none;<?php } ?>">
              <p><div class="textGris">FILTRAR: MATERIAL</div></p>
              <div style="font-family:'Avenir LT Std 85 Medium';font-size:10px;">
               <?php
                    foreach($categoria as $tr): ?>
                        <p>
                        <img src='http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/iconos/<?=$options['tipo_reciclador']?>_<?=$tr->id?>.png'  height="12" width="12">
                        
                        <?php if($options['categoria']==$tr->id){
                          echo "<u>";
                        }?> 
                        <a href="#" onclick="enviarForm('0','<?=$tr->id?>','0')"><?=utf8_decode($tr->contenido)?></a>
                        <?php if($options['categoria']==$tr->id){
                          echo "</u>";
                        }?>  
                         </p>
                        <div id="divSubCat_<?=$tr->id?>" style="display:<?php if($options['categoria']==$tr->id){ ?> block <?php } else { ?>none;<?php } ?>">
                         <?php
                    if(count($subcategoria)>1){
                    foreach($subcategoria as $trsub): ?>
                        
                        <?php if($options['subcategoria']==$trsub->id){
                          echo "<u>";
                        }?> 
                        <a href="#" onclick="enviarForm('0','<?=$tr->id?>','<?=$trsub->id?>')">&nbsp;&nbsp;&nbsp;&nbsp;<?=utf8_decode($trsub->contenido)?></a>
                        <?php if($options['subcategoria']==$trsub->id){
                          echo "</u>";
                        }?>  
                         <br>
                    <?php  endforeach; 
                    }?>
                        </div>
                    <?php  endforeach; ?>
                 </div>
                 <h1 class="page-header-mio"></h1>
</div>
                 <!-- <div class="form-group">

                <label for="">Tipo</label>
                <select name="tipo_reciclador" id="" class="form-control">
                    <option value="" selected>Todas</option>
                  <?php
                    foreach($tipo_reciclador as $tr): ?>
                        <option value="<?=$tr->id ?>" <?php if($options['tipo_reciclador']==$tr->id){?>selected<?php } ?>><?=$tr->value?></option>
                    <?php  endforeach; ?>
                </select>
                <label for="">CategorÃ­a</label>
                <select name="categoria" id="" class="form-control" onChange="document.getElementById('form-id').submit();">
                    <option value="" selected>Todas</option>
                  <?php
                    foreach($categoria as $tr): ?>
                        <option value="<?=$tr->id ?>" <?php if($options['categoria']==$tr->id){?>selected<?php } ?>><?=utf8_decode($tr->contenido)?></option>
                    <?php  endforeach; ?>
                </select>
                <label for="">SubcategorÃ­a</label>
                <select name="subcategoria" id="" class="form-control">
                    <option value="" selected>Todas</option>
                  <?php
                    foreach($subcategoria as $tr): ?>
                        <option value="<?=$tr->id ?>" <?php if($options['subcategoria']==$tr->id){?>selected<?php } ?>><?=utf8_decode($tr->contenido)?></option>
                    <?php  endforeach; ?>
                </select>
                
                
                
              </div>-->

          
        </div>

           <input id="direccion" name="direccion" type="hidden">    
           <input id="tipo_reciclador" name="tipo_reciclador" type="hidden">      
           <input id="categoria" name="categoria" type="hidden">   
           <input id="subcategoria" name="subcategoria" type="hidden">      
          </form>

        <div class="col-md-10">
          <?php 
        $pagina = $options['pagina'];
        $src = '';
        switch ($pagina) {
        	case 1:
        		$src="http://recicladores.com.ar/que_es";
        	break;
        	case 2:
        		$src="http://recicladores.com.ar/somos";
        	break;
                case 3:
        		$src="http://recicladores.com.ar/contacto";
        	break;
                case 4:
        		$src="http://recicladores.com.ar/lista_precios";
        	break;
        	default:
        		$src="http://recicladores.com.ar/implementacion?tipo_reciclador=".$options['tipo_reciclador']."&categoria=".$options['categoria']."&subcategoria=".$options['subcategoria']."&direccion=".$options['direccion'];
        	break;
        }
        ?>
          <iframe src="<?=$src?>" frameborder="0" width="100%" height="600px"></iframe>
        </div>
        
      </div>
<div class="row">
        <div id="footer">
          
            <img src='http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/images/logo_bottom.PNG'>
            
      </div>
  </div>

<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>Modal Box</h2>
		<p>This is a sample modal box that can be created using the powers of CSS3.</p>
		<p>You could do a lot of things here like have a pop-up ad that shows when your website loads, or create a login/register form for users.</p>
	</div>
</div>
</div>
</body>
</html>