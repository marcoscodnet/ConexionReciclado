<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulosBuscar">
        <div id="spriteVender"><p>Vender - Publique su residuo en solo tres simples pasos</p></div>
        <a href="como-vender.php" class="comoVender">&iquest;c&oacute;mo publicar?</a>
    </div>
    <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="contVender"> <!--php/controllers/publicar.controller.php-->
            <form action="php/controllers/publicar.controller.php" method="post" enctype="multipart/form-data" id="datosVender">
                <!-- FORMULARIO VENDER ETAPA 1 -->
                <div class="bloqueEtapa">
                    <div class="encabezadoBloqueEtapa">
                        <div class="tituloEtapaVender">
                            <div class="fotoEtapa"></div>
                            <p style="padding-top: 6px;"><span>Informaci&oacute;n General</span></p>
                        </div>
                        <div class="infoEtapaVender">
                            <p><span>Cu&eacute;ntenos de sobre su publicaci&oacute;n</span></p>
                            <p>Por favor complete los detalles del producto que desea vender.</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="contFormVender">
                        <div class="contTituloArticuloVender">
                            <p>T&iacute;tulo de la publicaci&oacute;n</p>
                            <input type="text" name="titulo" class="tituloArticulo" value="<!--{productoTitulo}-->" />
                        </div>
                        <div class="colBoxes">
                            <p><label for="categoria">Categor&iacute;a</label></p>
                            <!--{categoriaToSelect}-->
                            <p><label for="subcategoria">Sub-Categor&iacute;a</label></p>
                            <span id="subcategoriaContenedor"><!--{subcategoriasToSelect}--></span>
                        </div>
                        <div class="colBoxes">
                            <p><label for="cantidad">Cantidad</label></p>
                            <div class="contCantidad">
                                <input type="text" name="cantidadValor" id="cantidad" value="<!--{productoCantidad}-->" />
                            </div>
                            <div class="contUnidad"><!--{medidaToSelect}--></div>
                            <div class="clear"></div>
                            <p><label for="fuente">Presentaci&oacute;n</label></p>
                            <!--{contenedorToSelect}-->
                        </div>
                        <div class="colBoxes" style="float: right !important;width: 216px !important;">
                            
                            <div class="clear"></div>
                            <p><label for="fuente">Fuente</label></p>
                            <!--{fuenteToSelect}-->
                            <div class="clear"></div>
                            <p><label for="frecuencia">Frecuencia</label></p>
                            <!--{frecuenciaToSelect}-->
                            
                        </div>
                        <div class="clear"></div>
                        <div class="contDescArticulo">
                            <p><label for="descArticulo">Descripci&oacute;n detallada</label></p>
                            <textarea name="descripcion" id="descArticulo" cols="30" rows="10"><!--{productoDescripcion}--></textarea>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- FIN FORMULARIO ETAPA 1 -->
                <div class="clear"></div>
                <!-- BLOQUE CARGAR FOTOS -->
                <div class="bloqueEtapa">
                    <div class="encabezadoBloqueEtapa">
                        <div class="tituloEtapaVender">
                            <div class="fotoEtapa" style="background-position: 0px -41px;"></div>
                            <p style="padding-top: 6px;"><span>Fotos</span></p>
                        </div>
                        <div class="infoEtapaVender">
                            <p><span>Sub&iacute; fotos del producto!</span></p>
                            <p>Le recomendamos subir como minimo 2 fotos. (m&aacute;ximo permitido 4).Tama�o m�ximo de cada foto: 2 mbytes.</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="contUploadFotos">
                        <div id="fileupload">
                            <div class="fileupload-buttonbar">
                                <label class="fileinput-button">
                                    <span>Agregar fotos</span>
                                    <input type="file" name="files[]" multiple>
                                </label>
                                <button type="submit" class="start">Subir fotos</button>
                                <button type="reset" class="cancel">Cancelar fotos</button>
                                <button type="button" class="delete">Eliminar fotos</button>
                            </div>
                            <div class="fileupload-content">
                                <table class="files"></table>
                                <div class="fileupload-progressbar"></div>
                            </div>
                        </div>
                        <script id="template-upload" type="text/x-jquery-tmpl">
                            <tr class="template-upload{{if error}} ui-state-error{{/if}}">
                                <td class="preview"></td>
                                <td class="name">${name}</td>
                                <td class="size">${sizef}</td>
                                {{if error}}
                                <td class="error" colspan="2">Error:
                                    {{if error === 'maxFileSize'}}El archivo es muy pesado
                                    {{else error === 'minFileSize'}}El archivo es muy liviano
                                    {{else error === 'acceptFileTypes'}}Extensi&oacute;on de archivo no permitida
                                    {{else error === 'maxNumberOfFiles'}}M&aacute;ximo de archivos permitido excedido
                                    {{else}}${error}
                                    {{/if}}
                                </td>
                                {{else}}
                                <td class="progress"><div></div></td>
                                <td class="start"><button>Comenzar</button></td>
                                {{/if}}
                                <td class="cancel"><button>Cancelar</button></td>
                            </tr>
                        </script>
                        <script id="template-download" type="text/x-jquery-tmpl">
                            <tr class="template-download{{if error}} ui-state-error{{/if}}">
                                {{if error}}
                                <td></td>
                                <td class="name">${name}</td>
                                <td class="size">${sizef}</td>
                                <td class="error" colspan="2">Error:
                                    {{if error === 1}}La imagen es demasiado grande, se aceptan tamaños menores a 2 Mb.
                                    {{else error === 2}}La imagen es demasiado grande, se aceptan tamaños menores a 2 Mb.
                                    {{else error === 3}}Se subió sólo parcialmente
                                    {{else error === 4}}El archivo NO fue subido
                                    {{else error === 5}}Falta la carpeta temporal
                                    {{else error === 6}}No se ha podido copiar el archivo en el disco
                                    {{else error === 7}}La carga de archivos por extensión se detuvo
                                    {{else error === 'maxFileSize'}}La imagen es demasiado grande, se aceptan tamaños menores a 2 Mb.
                                    {{else error === 'minFileSize'}}File is too small
                                    {{else error === 'acceptFileTypes'}}Extensi&oacute;n de archivo no permitida
                                    {{else error === 'maxNumberOfFiles'}}M&aacute;ximo de archivos permitido excedido
                                    {{else error === 'uploadedBytes'}}Uploaded bytes exceed file size
                                    {{else error === 'emptyResult'}}Empty file upload result
                                    {{else}}${error}
                                    {{/if}}
                                </td>
                                {{else}}
                                <td class="preview">
                                    {{if thumbnail_url}}
                                    <a href="${url}" target="_blank"><img src="${thumbnail_url}"></a>
                                    {{/if}}
                                </td>
                                <td class="name">
                                    <a href="${url}"{{if thumbnail_url}} target="_blank"{{/if}}>${name}</a>
                                </td>
                                <td class="size">${sizef}</td>
                                <td colspan="2"></td>
                                {{/if}}
                                <td class="delete">
                                    <button data-type="${delete_type}" data-url="${delete_url}">Delete</button>
                                </td>
                            </tr>
                        </script>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- FIN BLOQUE CARGAR FOTOS -->
                <div class="clear"></div>
                <!-- BLOQUE CONDICIONES -->
                <div class="bloqueEtapa">
                    <div class="encabezadoBloqueEtapa">
                        <div class="tituloEtapaVender">
                            <div class="fotoEtapa" style="background-position: 0px -82px;"></div>
                            <p style="padding-top: 6px;"><span>Condiciones de venta</span></p>
                        </div>
                        <div class="infoEtapaVender">
                            <p><span>Ingrese las condiciones de venta</span></p>
                            <p>Por favor complete lo mas detallado posible.</p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="contFormVender" style="border: none !important;">
                        <div class="colBoxes">
                            <p><label for="precio">Precio</label></p>
                            <div class="contCantidad">
                                <input type="text" name="sugerenciaPrecio" id="precio" value="<!--{productoSugerencia}-->" />
                            </div>
                            <div class="contUnidad">
                                <select name="sugerenciaMedida" id="unidad2">
                                    <option value="0">x el total</option>
                                    <option value="1">x unidad</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                            <p style="float: left;"><label for="gratis" style="cursor: pointer;">Gratis</label></p>
                            <input type="radio" value="1" name="tipo_precio" id="gratis" align="right" style="display: block;float: left;margin-left: 15px;" <!--{tipoPrecio}--> />
                            <p style="float: left; margin-left: 25px"><label for="a_convenir" style="cursor: pointer;">A convenir</label></p>
                            <input type="radio" value="2" name="tipo_precio" id="a_convenir" align="right" style="display: block;float: left;margin-left: 15px;" <!--{tipoPrecio}--> />
                        </div>
                        <div class="colBoxes">
                            <p><label for="provincia">Provincia</label></p>
                            <!--{provinciaToSelect}-->
                            <p><label for="localidad">Localidad</label></p>
                            <span id="localidadContenedor"><!--{localidadesToSelect}--></span>
                        </div>
                        <!--<div class="colBoxes" style="margin-right: 0px !important;float: right;width: 215px !important;">
                            <p><label for="calle">Calle</label></p>
                            <input type="text" name="calle" id="calle" class="inputAncho" value="<!--{direccionCalle}->" />
                            <p><label for="numero">N&uacute;mero</label></p>
                            <input type="text" name="numero" id="numero" class="inputAncho" value="<!--{direccionNumero}->" />
                        </div>-->
                        <div class="clear"></div>
                        <div class="colTextareas">
                            <p><label for="contacto">Ha estado en contacto con:</label></p>
                            <!--{enContactoConToSelect}-->
                            <div class="clear"></div>
                            <p><label for="detalle">Detalle:</label></p>
                            <textarea name="detalle" id="detalle" cols="" rows=""><!--{productoDetalle}--></textarea>
                        </div>
                        <div class="clear"></div>
                        <div class="colTextareas">
                            <p><label for="reqReutilizacion">Requerimientos especiales para su transporte</label></p>
                            <textarea name="requerimentos" id="reqReutilizacion" cols="30" rows="10"><!--{productoRequerimientos}--></textarea>
                        </div>
                        <div class="clear"></div>
                        <div class="colTextareas" style="margin-top: 0px !important;">
                            <p><label for="condReutilizacion">Condiciones especiales para su reutilizaci&oacute;n</label></p>
                            <textarea name="condiciones" id="condReutilizacion" cols="30" rows="10"><!--{productoCondiciones}--></textarea>
                        </div>
                        <!--<div class="colTextareas" style="margin-top: 0px !important;">
                            <p><label for="dondeProviene">&iquest;De d&oacute;nde proviene? &iquest;Para qu&eacute; fue utilizado?</label></p>
                            <textarea name="dondeProviene" id="dondeProviene" cols="30" rows="10"><!-{productoProcedencia}-></textarea>
                        </div>-->
                        <div class="colTextareas">
                        <p style="float: left;"><label for="publicar_mail" style="cursor: pointer;">Desea mostrar su mail en la publicaci&oacute;n para ser contactado directamente?</label></p>
                            <input type="checkbox" value="1" name="publicar_mail" id="publicar_mail" align="right" style="display: block;float: left;margin-left: 15px;" <!--{publicarMail}--> />
                        <div class="clear"></div>
                        </div>
                        <input type="hidden" name="codigo" value="<!--{codigoUsuario}-->" />
                        <input type="hidden" name="productoId" value="<!--{productoId}-->" />
                        <p><a href="javascript:void(0);" id="vistaPrevia"></a></p>
                        <input type="submit" name="vender" value="Vender" <!--{clase}--> />
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- FIN BLOQUE CONDICIONES -->
                <div class="clear"></div>
            </form>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>