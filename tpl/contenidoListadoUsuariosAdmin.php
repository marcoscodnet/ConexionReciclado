<div id="contenedorBloqueSolapa">
    <div class="contMenuIzqBack">
        <div class="cajaIzqMenuBack">
            <div class="solapaVerdeTitulos">
                <div id="spriteMiConexion"><p>Mi Conexi&oacute;n</p></div>
            </div>
            <div class="clear"></div>
            <div class="cajaBotonesBack">
                <ul id="botoneraRightBack">
                    <li><a href="publicaciones-admin.php">Publicaciones</a></li>
                    <li><a href="mensajes-admin.php">Mensajes</a></li>
                    <li><a href="conexiones-admin.php">Conexiones</a></li>
                    <li><a href="historial-conexiones-admin.php">Historial</a></li>
                    <li><a href="en-seguimiento-admin.php">En seguimiento</a></li>
                    <li><a href="listado-usuarios-admin.php" class="activo">Usuarios</a></li>
                    <li class="roundBottom"><a href="php/controllers/newsletterToCsv.controller.php">Exportar Mails</a></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="contCajaDerBack">
        <div class="solapaVerdeTitulos"></div>
        <div class="clear"></div>
        <div class="cajaDerBack">
        	<div id="listarMiConexion">
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <input type="hidden" name="codigo" id="codigo" value="<?php echo($_SESSION['codigoUsuario']); ?>" />
</div>