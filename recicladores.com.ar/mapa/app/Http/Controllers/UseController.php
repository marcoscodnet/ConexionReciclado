<?php namespace App\Http\Controllers;

use App\TipoReciclador;
use App\Categoria;
use App\Subcategoria;
use App\ListaPrecio;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request as Request;

class UseController extends BaseController
{

    public function show(Request $request)
    {
        $tipo_reciclador = $request->get('tipo_reciclador');
        $categoria = $request->get('categoria');
        $subcategoria = $request->get('subcategoria');
//$tipo_reciclador=($tipo_reciclador)?$tipo_reciclador:0;
        $q = DB::table('reciclador')
            ->whereNotNull('latitud')
            ->whereNotNull('longitud')
            ->select('reciclador.nombre', 'reciclador.direccion', 'reciclador.latitud', 'reciclador.longitud', 'tipo_reciclador.value as tipo_name', 'reciclador.id_tipo', 'subcategoria.id_categoria', 'reciclador.tel', 'reciclador.email', 'reciclador.web', DB::raw('group_concat(subcategoria.contenido) AS contenido'), 'localidad.contenido AS localidad', 'provincia.contenido AS provincia')
            ->leftjoin('tipo_reciclador', 'reciclador.id_tipo', '=', 'tipo_reciclador.id')
            ->leftjoin('localidad', 'reciclador.id_localidad', '=', 'localidad.id')
            ->leftjoin('provincia', 'localidad.id_provincia', '=', 'provincia.id')
            ->leftjoin('rel_reciclador_subcategoria', 'reciclador.id', '=', 'rel_reciclador_subcategoria.id_reciclador')
            ->leftjoin('subcategoria', 'subcategoria.id', '=', 'rel_reciclador_subcategoria.id_subcategoria')
            ->groupBy('reciclador.id');

        

       //     $q->whereIn('id_tipo', array($tipo_reciclador));

        if($tipo_reciclador){
            $q->where('id_tipo', $tipo_reciclador);
        }
        if($categoria ){
            $q->where('subcategoria.id_categoria', $categoria);
        }
        if($subcategoria ){
            $q->where('subcategoria.id', $subcategoria);
        }    
        
        $recicladores = $q->get();
        $direccion = $request->get('direccion');
         $pagina = $request->get('pagina');
        return view('map', ['recicladores' => $recicladores, 'direccion' => $direccion, 'pagina' => $pagina]);
    }

    public function usage(Request $request)
    {

        $options = $request->only('width', 'height', 'tipo_reciclador', 'categoria', 'subcategoria', 'direccion', 'pagina');
        if(!$options['width']){
            $options['width']='600px';
        }
        if(!$options['height']){
            $options['height']='400px';
        }
        $tipo_reciclador = TipoReciclador::all();
        $categoria = Categoria::all();
        $subcategoria = Subcategoria::where('id_categoria',$request->get('categoria'))->get();
        $direccion = $request->get('direccion');
        $pagina = $request->get('pagina');
        return view('use', ['options' => $options, 'tipo_reciclador' => $tipo_reciclador, 'categoria' => $categoria, 'subcategoria' => $subcategoria, 'direccion' => $direccion, 'pagina' => $pagina]);
    }
    
	public function que_es(Request $request)
    {
		$options = $request->only('width', 'height', 'tipo_reciclador', 'categoria', 'subcategoria', 'direccion', 'pagina');
        if(!$options['width']){
            $options['width']='600px';
        }
        if(!$options['height']){
            $options['height']='400px';
        }
        $tipo_reciclador = TipoReciclador::all();
        $categoria = Categoria::all();
        $subcategoria = Subcategoria::where('id_categoria',$request->get('categoria'))->get();
        $direccion = $request->get('direccion');
        $pagina = $request->get('pagina');
        return view('que_es', ['options' => $options, 'tipo_reciclador' => $tipo_reciclador, 'categoria' => $categoria, 'subcategoria' => $subcategoria, 'direccion' => $direccion, 'pagina' => $pagina]);
    }

public function somos(Request $request)
    {
		$options = $request->only('width', 'height', 'tipo_reciclador', 'categoria', 'subcategoria', 'direccion', 'pagina');
        if(!$options['width']){
            $options['width']='600px';
        }
        if(!$options['height']){
            $options['height']='400px';
        }
        $tipo_reciclador = TipoReciclador::all();
        $categoria = Categoria::all();
        $subcategoria = Subcategoria::where('id_categoria',$request->get('categoria'))->get();
        $direccion = $request->get('direccion');
        $pagina = $request->get('pagina');
        return view('somos', ['options' => $options, 'tipo_reciclador' => $tipo_reciclador, 'categoria' => $categoria, 'subcategoria' => $subcategoria, 'direccion' => $direccion, 'pagina' => $pagina]);
    }

public function contacto(Request $request)
    {
		$options = $request->only('width', 'height', 'tipo_reciclador', 'categoria', 'subcategoria', 'direccion', 'pagina');
        if(!$options['width']){
            $options['width']='600px';
        }
        if(!$options['height']){
            $options['height']='400px';
        }
        $tipo_reciclador = TipoReciclador::all();
        $categoria = Categoria::all();
        $subcategoria = Subcategoria::where('id_categoria',$request->get('categoria'))->get();
        $direccion = $request->get('direccion');
        $pagina = $request->get('pagina');
        return view('contacto', ['options' => $options, 'tipo_reciclador' => $tipo_reciclador, 'categoria' => $categoria, 'subcategoria' => $subcategoria, 'direccion' => $direccion, 'pagina' => $pagina]);
    }


public function lista_precios(Request $request)
    {
		$options = $request->only('width', 'height', 'tipo_reciclador', 'categoria', 'subcategoria', 'direccion', 'pagina');
        if(!$options['width']){
            $options['width']='600px';
        }
        if(!$options['height']){
            $options['height']='400px';
        }
        
        $listaPrecio = ListaPrecio::all();
        
        $pagina = $request->get('pagina');
        return view('lista_precios', ['options' => $options, 'listaPrecio' => $listaPrecio, 'pagina' => $pagina]);
    }
}
