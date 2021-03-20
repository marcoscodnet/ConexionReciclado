var mensajes = new String();
var soloNumeros = RegExp ("^[0-9]*$");
var precio = RegExp ("^[0-9]+\.?[0-9]{0,2}$");
$(document).ready(function() {	
    $('#altaProducto, .btnEditar').click(function () {
        mensajes = '';
        var ok = true;
		
        //limpiar la clase validador al hacer foco
        $('.tituloArticulo, #cantidad, #frecuencia, #descArticulo, #precio, #calle, #numero').focus(function () {
            $(this).removeClass('validador')
        })
		
        //validacion de la titulo
        if (!$('.tituloArticulo').val()) {
            mensajes += '<p>Debe ingresar el t&iacute;tulo.</p>';
            $('.tituloArticulo').addClass('validador');
            ok = false;
        }
		
        //validacion de la cantidad
        if (!$('#cantidad').val()) {
            mensajes += '<p>Tiene indicar la cantidad que desea vender.</p>';
            $('#cantidad').addClass('validador');
            ok = false;
        } else if (!soloNumeros.test($('#cantidad').val())) {
            mensajes += '<p>La cantidad del producto la debe expresar en n&uacute;meros enteros.</p>';
            $('#cantidad').addClass('validador');
            ok = false;
        }
		
        //validacion de la duracion del contrato
        if ($('#frecuencia option:selected').val() == 2) {
            if (!$('#duracion-contrato').val()) {
                mensajes += '<p>Le fat&oacute; indicar la duraci&oacute;n del contrato.</p>';
                $('#frecuencia').addClass('validador');
                ok = false;
            } else if (!soloNumeros.test($('#duracion-contrato').val())) {
                mensajes += '<p>La duraci&oacute;n del contrato la debe expresar en n&uacute;meros enteros.</p>';
                $('#frecuencia').addClass('validador');
                ok = false;
            }
        }
		
        //validacion de la descripcion
        if (!$('#descArticulo').val()) {
            mensajes += '<p>La descripci&oacute;n del producto es obligatoria.</p>';
            $('#descArticulo').addClass('validador');
            ok = false;
        }
		
        //validacion de las imagenes
        if (!$('td.preview canvas').size() && !$('td.preview img').size()) {
            mensajes += '<p>Debe cargar al menos una imagen.</p>';
            ok = false;
        } else	if (!$('td.preview img').size()) {
            mensajes += '<p>Olvid&oacute; subir las im&aacute;genes. Para hacerlo, presione el bot&oacute;n subir fotos</p>';
            ok = false;
        }
		
        //validar precio
        if (!$('#precio').val() && !$('input[name="tipo_precio"]').is(':checked')) {
            mensajes += '<p>Tiene indicar el precio del producto.</p>';
            $('#precio').addClass('validador');
            ok = false;
        } else if (!$('input[name="tipo_precio"]').is(':checked') && !precio.test($('#precio').val())) {
            mensajes += '<p>El precio est&aacute; mal expresado. Si desea utilizar n&uacute;meros decimales debe usar el punto como separador y no puede poner m&aacute;s de dos decimales.</p>';
            $('#precio').addClass('validador');
            ok = false;
        }
		
        /*
		//validar calle
		if (!$('#calle').val()) {
			mensajes += '<p>La calle es obligatoria.</p>';
			$('#calle').addClass('validador');
			ok = false;
		}
		
		//validar numero
		if (!$('#numero').val()) {
			mensajes += '<p>El n&uacute;mero es obligatorio.</p>';
			$('#numero').addClass('validador');
			ok = false;
		}*/
        if (!ok) {
            $.colorbox({
                href:'tpl/mensajes/validacionVender.error.php', 
                iframe:true, 
                innerWidth:400, 
                innerHeight:250, 
                top:150
            })
        } else {
            $('#altaProducto').addClass('disabled').attr('disabled', true);
            $(this).parents('form').submit();
        }
        return ok;
    })
	
	
    //impedir otros caracteres en inputs numericos
    $('#duracion-contrato, #cantidad, #numero').keydown(function (e) {
        if ( (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode == 8 || e.keyCode == 46  || e.keyCode == 116) {
            return true;
        } else {
            return false;
        }
    })
	
    //impedir otros caracteres en inputs numericos o el punto
    $('#precio').keydown(function (e) {
        if ( (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode == 8 || e.keyCode == 46  || e.keyCode == 116 || e.keyCode == 110 || e.keyCode == 190) {
            return true;
        } else {
            return false;
        }
    })
})