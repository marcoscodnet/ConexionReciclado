<div id="contenedorBloqueSolapa">
    <div class="solapaVerdeTitulosBuscar">
        <div id="spriteBuscar"><p>Buscar - Seleccione subcategor&iacute;as para filtrar los resultados</p></div>
        <a href="como-comprar.php" class="comoVender">&iquest;c&oacute;mo comprar?</a>
        
    </div>
    <div class="clear"></div>
    <div class="contInfoBloques">
        <div class="contBuscadorComboBox">
            <form action="?" method="post" id="buscadorCombos">
                <div class="colBoxes">
                    <p><label for="categoria">Categor&iacute;a</label></p>
                    <?php echo ($categoria->toSelect()); ?>
                    <p><label for="subcategoria">Sub-Categor&iacute;a</label></p>
                    <?php echo ('<span id="subcategoriaContenedor">' . $categoria->subcategoriasToSelect() . '</span>'); ?>
                </div>
                <div class="colBoxes">
                    <p><label for="precio">Precio</label></p>
                    <select name="precio" id="selectPrecio">
                        <option value="0-1000000">Indistinto</option>
                        <option value="0-0">$0</option>
                        <option value="1-1000000">m&aacute;s que $0</option>
                    </select>
                    <!--<p>Periodicidad:</p>
                    <select name="periodicidad" id="selectPeriodicidad">
                        <option value="">Indistinto</option>
                        <option value="1">&Uacute;nica vez</option>
                        <option value="2">Mensualmente</option>
                    </select>-->
                </div>
                <div class="colBoxes">
                    <p><label for="provincia">Provincia</label></p>
                    <?php echo ($provincia->toSelect()); ?>
                    <p><label for="localidad">Localidad</label></p>
                    <span id="localidadContenedor">
                        <select disabled="disabled">
                            <option value="" selected="selected">Localidades</option>
                        </select>
                    </span>
                </div>
                <div>
                	<a href="recibi-ofertas.php" class="btnRecibiOfertas">Recibi ofertas </a>
                	
                </div>
                <input type="hidden" id="fg" name="fg" value="<?php echo ((isset($_SESSION['codigoUsuario'])) ? $_SESSION['codigoUsuario'] : ''); ?>" />
                <input type="hidden" id="pagina" name="pagina" value="1" />
            </form>
        </div>
        <div class="clear"></div>
        <div class="contResultadosBusqueda">
            <div class="encabezadoBusqueda">
                <p>Resultados de la b&uacute;squeda:</p>
            </div>
            <div id="listarProductos"></div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>