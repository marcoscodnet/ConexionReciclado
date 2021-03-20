<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Mapa Reciclario</title>
	 <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map { height: 100% }
    </style>
	
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAggBwZ10PL9galUdtJZ2HR221SbKKXb3M&sensor=true">
    </script>

</head>
<body>
  <div id="map"></div>



  <script type="text/javascript">
  	var locations = [
                   <?php foreach($recicladores as $reciclador): ?>
                     ['<?php echo utf8_decode(addslashes($reciclador->nombre)) ?>', <?php echo $reciclador->latitud ?>, <?php echo $reciclador->longitud ?>, <?php echo $reciclador->id_tipo ?>, '<?php echo ($reciclador->tipo_name) ?>', '<?php echo utf8_decode(addslashes($reciclador->direccion." ".$reciclador->localidad.", ".$reciclador->provincia)) ?>',<?php echo $reciclador->id_categoria ?>, '<?php echo utf8_decode($reciclador->tel) ?>', '<?php echo ($reciclador->email) ?>', '<?php echo ($reciclador->web) ?>', '<?php echo utf8_decode(addslashes($reciclador->contenido)) ?>'],
                   <?php endforeach; ?>
                   ];
    
    var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
    
    var icons = [
      iconURLPrefix + 'red-dot.png',
      iconURLPrefix + 'green-dot.png',
      iconURLPrefix + 'blue-dot.png',
      iconURLPrefix + 'orange-dot.png',
      iconURLPrefix + 'purple-dot.png',
      iconURLPrefix + 'pink-dot.png',      
      iconURLPrefix + 'yellow-dot.png'
    ]
    var iconsLength = icons.length;

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 4,
      center: new google.maps.LatLng(-38.416097, -63.616672),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: true,
      panControl: false,
      zoomControlOptions: {
         position: google.maps.ControlPosition.LEFT_BOTTOM
      }
    });
    var geocoder;
    var address = '<?php echo $direccion ?>';

    if(address !='') {
        geocoder = new google.maps.Geocoder();
        
        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            //document.getElementById('x').innerHTML = results[0].geometry.location.lat().toFixed(6);
            //document.getElementById('y').innerHTML = results[0].geometry.location.lng().toFixed(6);
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                zoom: 3,
                position: results[0].geometry.location
            });
          } else {
            alert('La localización no tuvo éxito por la siguiente razón: ' + status);
          }
        });
      }


    var infowindow = new google.maps.InfoWindow({
      maxWidth: 300
    });

    var markers = new Array();
    
    var iconCounter = 0;
    var icon = '';
    var tipo = '';
    var materiales = '';
    var nombre = '';
    var contacto= '';
   
    // Add the markers and infowindows to the map
    for (var i = 0; i < locations.length; i++) {  
              if((locations[i][3]==1)||(locations[i][3]==2)){
                 icon = 'http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/iconos/'+locations[i][3]+'_'+locations[i][6]+'.png';
              }
              else{
                 icon = 'http://www.conexionreciclado.com.ar/recicladores.com.ar/mapa/iconos/'+locations[i][3]+'.png';
              }
          
	      var iconLevel1= new google.maps.MarkerImage(
	      icon,
	      
	       null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(6, 6));

     var iconLevel3= new google.maps.MarkerImage(
	      icon,
	      
	     null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(18, 18));
	
	      var iconLevel2= new google.maps.MarkerImage(
	      icon,
	      
	      null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(12, 12));
	      var marker = new google.maps.Marker({
	        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
	        map: map,
	
	        icon: iconLevel1
	      });
	
	
	      marker.iconLevel1 = iconLevel1;
	      marker.iconLevel2 = iconLevel2;
	      marker.iconLevel3 = iconLevel3;
	
	      markers.push(marker);
	
	      google.maps.event.addListener(marker, 'click', (function(marker, i) {
	 
	        return function() {
                  tipo = '<SPAM style="font-weight:bold ">TIPO:</SPAM>&nbsp;'+locations[i][4];
                  if(locations[i][10]){
                   materiales= '<SPAM style="font-weight:bold ">MATERIALES:</SPAM>&nbsp;'+locations[i][10]+ "<br><br>"; 
                  }
                  
                  nombre= '<SPAM style="font-weight:bold ">NOMBRE:</SPAM>&nbsp;'+locations[i][0]; 
                  contacto1=(locations[i][5])?locations[i][5]+'<br>':'';
                  contacto2=(locations[i][7])?locations[i][7]+'<br>':'';
                  contacto3=(locations[i][8])?locations[i][8]+'<br>':'';
                  contacto4=(locations[i][9])?locations[i][9]+'<br>':'';  
                  contacto= '<SPAM style="font-weight:bold ">CONTACTO:</SPAM><br>'+contacto1+contacto2+contacto3+contacto4;
                  
	          infowindow.setContent(tipo + "<br><br>"+materiales+nombre+ "<br><br>"+contacto);
	          infowindow.open(map, marker);
	        }
	      })(marker, i));
	
	     
	   
	var zoomLevel = 1;
	
	google.maps.event.addListener(map, 'zoom_changed', function() {
	  var i, prevZoomLevel;
	
	  prevZoomLevel = zoomLevel;
	
	  map.getZoom() < 6 ? zoomLevel = 1 : zoomLevel = 2;
	
	
	  if(map.getZoom() < 5){
	     zoomLevel = 1;
	  }
	  if((map.getZoom() >= 5)&&(map.getZoom() <= 8)){
	     zoomLevel = 2;
	  }
	  if(map.getZoom() > 8){
	     zoomLevel = 3;
	  }
	  if (prevZoomLevel !== zoomLevel) {
	    for (i = 0; i < markers.length; i++) {
	      
	      switch (zoomLevel ) {
	       case 1:
	        markers[i].setIcon(markers[i].iconLevel1);
	        break;
	       case 2:
	        markers[i].setIcon(markers[i].iconLevel2);
	        break;
	       case 3:
	        markers[i].setIcon(markers[i].iconLevel3);
	        break;
	      } 
	    }
	  }
	});
      
      
    }

    function autoCenter() {
      //  Create a new viewpoint bound
     if(markers.length>0){ 
     var bounds = new google.maps.LatLngBounds();
      //  Go through each...
      for (var i = 0; i < markers.length; i++) {  
        bounds.extend(markers[i].position);
      }
      //  Fit these bounds to the map
      map.fitBounds(bounds);
     }
    }
    //autoCenter();
    </script>
</body>
</html>
