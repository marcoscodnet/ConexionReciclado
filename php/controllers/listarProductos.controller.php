<?php
include_once('../bootstrap.php');
include_once('../clases/Archivo.php');
include_once('../clases/Texto.php');
include_once('../clases/Paginador.php');

$pagina = $_POST['pagina']-1;
$cuantos = 10;
$desde = $pagina * $cuantos;

$precio = ($_POST['precio'] == '0-1000000')?0:1;

$q = Doctrine_Query::create()
        ->select('p.*')
        ->from('Producto p')
        ->leftJoin('p.subcategoria s')
        ->leftJoin('p.publicacion pb')
        ->leftJoin('pb.estado e')
        ->leftJoin('s.categoria c')
        ->leftJoin('p.sugerencia sg')
        //->leftJoin('p.periodicidad r')
        ->leftJoin('p.direccion d')
        ->leftJoin('d.localidad l')
        ->leftJoin('l.provincia prov')
        ->where('pb.finalizacion >= "' . date('Y-m-d') . '"')
        ->andWhere('e.contenido = "aceptada" or e.contenido = "comprada"')
        ->orderBy('pb.inicio desc')
;
        

if (isset($_POST['categoria']) && $_POST['categoria']) $q->addWhere ('c.id = ?', $_POST['categoria']);
if (isset($_POST['subcategoria']) && $_POST['subcategoria']) $q->addWhere ('s.id = ?', $_POST['subcategoria']);
//if (isset($_POST['periodicidad']) && $_POST['periodicidad']) $q->addWhere ('r.id = ?', $_POST['periodicidad']);
if (isset($_POST['provincia']) && $_POST['provincia']) $q->addWhere ('prov.id = ?', $_POST['provincia']);
if (isset($_POST['localidad']) && $_POST['localidad']) $q->addWhere ('l.id = ?', $_POST['localidad']);
if ($precio) {
    if ($_POST['precio'] == '0-0') {
        $q->addWhere('sg.precio = ?', 0);
    } else {
        $q->addWhere('sg.precio > ?', 0);
    }
}

$q2 = $q->copy();
$total = $q->removeDqlQueryPart('select')->addSelect('count(p.id)')->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
$productos = $q2->limit($cuantos)->offset($desde)->execute();

// Mostrar resultado
$template = Archivo::leer('../../tpl/listarProductos.php');
$html = '';
include_once('../replacers/listarProductos.replacer.php');

$html .= Paginador::crearNumeritos ($cuantos, $total, 'listarProductos', $_POST['pagina']);
echo ($html);
?>