<?php

class Producto extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('producto');
        $this->hasColumn('id_subcategoria', 'integer'); //subcategoria
        $this->hasColumn('id_contenedor', 'integer'); //suelto - en caja - embalado - en pallets - otro
        $this->hasColumn('id_color', 'integer'); //color
        $this->hasColumn('id_cantidad', 'integer'); //cantidad
        $this->hasColumn('id_periodicidad', 'integer'); //unica ves - mensual
        $this->hasColumn('periodo', 'integer', 2); //(solo si es mensual) numero entero que representa la cantidad de meses de la contratacion
        $this->hasColumn('id_fuente', 'integer'); //Post-Industrial - Post-Consumidor
        $this->hasColumn('id_frecuencia', 'integer'); //mensual - �nica vez
        $this->hasColumn('id_enContactoCon', 'integer'); //Ha estado en contacto con:
        $this->hasColumn('detalle', 'string', 10000); //tiene relacion con la col anterior: Detalle
        $this->hasColumn('titulo', 'string', 300);
        $this->hasColumn('descripcion', 'string', 10000);
        $this->hasColumn('id_direccion', 'integer');
        $this->hasColumn('requerimentos', 'string', 1000);
        $this->hasColumn('condiciones', 'string', 1000);
        $this->hasColumn('procedencia', 'string', 1000); //�De d�nde proviene? �Para qu� fue utilizado?
        $this->hasColumn('id_sugerencia', 'integer'); //sugerencia de precio minimo que pone el vendedor
        $this->hasColumn('publicar_mail', 'integer', 2); 
    }

    public function setUp() {
        $this->hasOne('Publicacion as publicacion', array(
            'local' => 'id',
            'foreign' => 'id_producto'
        ));
        $this->hasOne('Subcategoria as subcategoria', array(
            'local' => 'id_subcategoria',
            'foreign' => 'id'
        ));
        $this->hasOne('Contenedor as contenedor', array(
            'local' => 'id_contenedor',
            'foreign' => 'id'
        ));
        $this->hasOne('Color as color', array(
            'local' => 'id_color',
            'foreign' => 'id'
        ));
        $this->hasOne('Cantidad as cantidad', array(
            'local' => 'id_cantidad',
            'foreign' => 'id'
        ));
        $this->hasOne('Periodicidad as periodicidad', array(
            'local' => 'id_periodicidad',
            'foreign' => 'id'
        ));
        $this->hasOne('EnContactoCon as enContactoCon', array(
            'local' => 'id_enContactoCon',
            'foreign' => 'id'
        ));
        $this->hasOne('Fuente as fuente', array(
            'local' => 'id_fuente',
            'foreign' => 'id'
        ));
        $this->hasOne('Frecuencia as frecuencia', array(
            'local' => 'id_frecuencia',
            'foreign' => 'id'
        ));
        $this->hasOne('Direccion as direccion', array(
            'local' => 'id_direccion',
            'foreign' => 'id'
        ));
        $this->hasOne('Sugerencia as sugerencia', array(
            'local' => 'id_sugerencia',
            'foreign' => 'id'
        ));
        $this->hasMany('Imagen as imagenes', array(
            'local' => 'id',
            'foreign' => 'id_producto'
        ));
    }

    public function getTitulo() {
        return utf8_decode($this->_get('titulo'));
    }

    public function setTitulo($titulo) {
        $this->_set('titulo', utf8_encode($titulo));
    }

    public function getDescripcion() {
        return utf8_decode($this->_get('descripcion'));
    }

    public function setDescripcion($descripcion) {
        $this->_set('descripcion', utf8_encode($descripcion));
    }

    public function getRequerimentos() {
        return utf8_decode($this->_get('requerimentos'));
    }

    public function setRequerimentos($requerimentos) {
        $this->_set('requerimentos', utf8_encode($requerimentos));
    }

    public function getConciciones() {
        return utf8_decode($this->_get('condiciones'));
    }

    public function setCondiciones($condiciones) {
        $this->_set('condiciones', utf8_encode($condiciones));
    }

    public function getProcedencia() {
        return utf8_decode($this->_get('procedencia'));
    }

    public function setProcedencia($procedencia) {
        $this->_set('procedencia', utf8_encode($procedencia));
    }

    public function getDetalle() {
        return utf8_decode($this->_get('detalle'));
    }

    public function setDetalle($detalle) {
        $this->_set('detalle', utf8_encode($detalle));
    }

    public function precioPorUnidad() {
        if ($this->_get('id_sugerencia') == NULL) {
            return 'Precio a convenir';
        }
        if ($this->sugerencia->medida->id != NULL) {
            return '$' . $this->sugerencia->precio . ' por ' . $this->sugerencia->medida->contenidoSingular;
        } else {
            if ($this->sugerencia->precio == 0) {
                $valorUnidad = $this->sugerencia->precio;
            } else {
                $valorUnidad = $this->sugerencia->precio / $this->cantidad->valor;
                $valorUnidad = round($valorUnidad, 2);
            }
            return '$' . $valorUnidad . ' por ' . $this->cantidad->medida->contenidoSingular;
        }
    }

    public function precioPorTotal() {
        if ($this->_get('id_sugerencia') == NULL) {
            return 'Precio a convenir';
        }
        if ($this->sugerencia->medida->id == NULL) {
            return '$' . $this->sugerencia->precio;
        } else {
            $valorTotal = $this->cantidad->valor * $this->sugerencia->precio;
            return '$' . $valorTotal;
        }
    }

    public function periodoToString() {
        $i = $this->_get('periodo');
        switch ($i) {
            case 0: $html = '';
                break;
            case 1: $html = $i . ' mes';
                break;
            default: $html = $i . ' meses';
                break;
        }
        return $html;
    }

    static public function ultimoId() {
        $q = Doctrine_Query::create()
                ->select('p.id')
                ->from('producto p')
                ->orderBy('p.id desc')
                ->limit(1);
        $producto = $q->execute();
        return $producto[0]->id;
    }

    public function imagenesToHTML($tipo = 'ch') {
        $html = '';
        if ($tipo == 'ch') {
            $i = 0;
            foreach ($this->imagenes as $imagen) {
                $html .= '<img alt="' . htmlentities($this->titulo) . '" src="images/productos/ch/' . $imagen->ruta . '?i=' . time() . '" id="img' . $i . '" class="fadeFotos" />';
                $i++;
            }
        } else {
            $i = 0;
            $html .= '<div id="imagenes">';
            foreach ($this->imagenes as $imagen) {
                $active = ($i == 0) ? 'active ' : '';
                $html .= '<a href="images/productos/' . $imagen->ruta . '?i=' . time() . '" class="galleryBox" rel="galleryBox' . $this->id . '" title="' . htmlentities($this->titulo) . '">';
                $html .= '<div class="zoomHover"></div>';
                $html .= '<img src="images/productos/gr/' . $imagen->ruta . '?i=' . time() . '" alt="' . htmlentities($this->titulo) . '" class="' . $active . 'galeria" />';
                $html .= '</a>';
                $i++;
            }
            $html .= '</div>';
        }
        return $html;
    }

    //validaciones
    public function isVencido() {
        return $this->publicacion->isVencida();
    }

    public function sePuedeMostrar($usuario) {
        $mostrarPropio = ($usuario) ? ($usuario->id == $this->publicacion->owner) : true;
        return $this->isVencido && $mostrarPropio;
    }

}

?>