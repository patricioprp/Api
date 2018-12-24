<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;

class VehiculoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculo = Vehiculo::all();
        if(!$vehiculo){
            return response()->json(['Mensaje'=>'No existen vehiculos','Codio 404'],404);
        }
        return response()->json(['Vehiculos'=>$vehiculo],202);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::find($id);
        if(!$vehiculo){
            return response()->json(['Mensaje'=>'No se encontro al vehiculo con Id='.$id,'Codio 404'],404);
        }
        return response()->json(['Vehiculo'=>$vehiculo],202);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
}
