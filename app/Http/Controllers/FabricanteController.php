<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fabricante;

class FabricanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic',['only'=>['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return  $fabricantes = Fabricante::all(); asi tmb se puede mostra un json pero es basico
        return response()->json(['Fabricantes'=>Fabricante::all()],202);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->get('nombre')||!$request->get('telefono'))
        {
        return response()->json(['Mensaje'=>'Datos invalidos o incompletos'],202);
        }
        Fabricante::create($request->all());
        return response()->json(['Mensaje'=>'El fabricante a sido creado'],202);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fabricante = Fabricante::find($id);
        if(!$fabricante){
            return response()->json(['Mensaje'=>'No se encontro al fabricante con Id='.$id,'Codio 404'],404);
        }
        return response()->json(['Fabricantes'=>$fabricante],202);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $metodo = $request->method();//obtengo el metodo, PUT o PATH
        $fabricante = Fabricante::find($id);
        $flag=false;
        if($metodo==="PATCH"){//los "===" significa que estamos comparando en valor y tipo
          $nombre = $request->get('nombre');
          if($nombre!=null&&$nombre!=''){
           $fabricante->nombre=$nombre;
           $flag=true;
          }
          $telefono = $request->get('telefono');
          if($telefono!=null&&$telefono!=''){
           $fabricante->telefono=$telefono;
           $flag=true;
          }
          if($flag){
            $fabricante->save();
            return response()->json(['Mensaje'=>'El fabricante fue editado ok'],202);
          }
            return response()->json(['Mensaje'=>'No fue necesario guardar ningun cambio','codigo'=>200],200);
        }
        $nombre = $request->get('nombre');
        $telefono = $request->get('telefono');
        if(!$nombre||!$telefono){
            return response()->json(['Mensaje'=>'Datos Invalidos'],404);
        }
        $fabricante->nombre=$nombre;
        $fabricante->telefono=$telefono;
        $fabricante->save();
        return response()->json(['Mensaje'=>'El fabricante fue editado ok'],202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fabricante = Fabricante::find($id);
        if(!$fabricante){
        return response()->json(['Mensaje'=>'No se encuentra el fabricante','codigo'=>404],404);
        }
        $vehiculos = $fabricante->vehiculos;
        if(sizeof($vehiculos)>0){
        return response()->json(['Mensaje'=>'Fabricante posee vehiculos asociados y no se puede eliminar, 
        primero elimine los vehivulos','codigo'=>404],404);
        }
        $fabricante->delete();
        return response()->json(['Mensaje'=>'El fabricante fue eliminado','codigo'=>200],200);
    }
}
