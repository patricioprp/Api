<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fabricante;
use App\Vehiculo;

class fabricanteVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $fabricante = Fabricante::find($id);
        $vehiculos = $fabricante->Vehiculos;
        if(!$fabricante){
            return response()->json(['Mensaje'=>'No se encontro al vehiculo con Id='.$id,'Codio 404'],404);
        }
        return response()->json(['Vehiculo'=>$vehiculos],202);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return "Creando vehiculos para el fabricantes".$id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        if(!$request->get('color')||!$request->get('cilindraje')||!$request->get('peso')||!$request->get('potencia'))
        {
        return response()->json(['Mensaje'=>'Datos invalidos o incompletos'],422);
        }
        $fabricante = Fabricante::find($id);
        if(!$fabricante){
        return response()->json(['Mensaje'=>'El fabricante no existe'],404);
        }
        //Vehiculo::create($request->all());//$fabricante->vechiculos()->create($request->all()); es equivalente
        Vehiculo::create([
            'color'=>$request->get('color'),
            'cilindraje'=>$request->get('cilindraje'),
            'peso'=>$request->get('peso'),
            'potencia'=>$request->get('potencia'),
            'fabricante_id'=>$id
        ]);
        return response()->json(['Mensaje'=>'El vehiculo se inserto correctamente'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idFabricante,$idVehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idFabricante,$idVehiculo)
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
    public function update(Request $request,$idFabricante,$idVehiculo)
    {
        $metodo = $request->method();//obtengo el metodo, PUT o PATH
        $fabricante = Fabricante::find($idFabricante);

          if(!$fabricante){
           return response()->json(['Mensaje'=>'No se encuentra el fabricante'],404);
        }
        
        $vehiculo = $fabricante->vehiculos->find($idVehiculo);

          if(!$vehiculo){
            return response()->json(['Mensaje'=>'No se encuentra el vehiculo'],404);
         }

         $color= $request->get('color');
         $cilindraje= $request->get('cilindraje');
         $peso= $request->get('peso');
         $potencia= $request->get('potencia');

         $flag=false;
         
          if($metodo==="PATCH"){//los "===" significa que estamos comparando en valor y tipo
          
          if($color!=null&&$color!=''){
           $vehiculo->color=$color;
           $flag=true;
          }
          
          if($cilindraje!=null&&$cilindraje!=''){
           $vehiculo->cilindraje=$cilindraje;
           $flag=true;
          }
          
          if($peso!=null&&$peso!=''){
            $vehiculo->peso=$peso;
            $flag=true;
           }

          if($potencia!=null&&$potencia!=''){
            $vehiculo->potencia=$potencia;
            $flag=true;
           }

           if($flag){
            $vehiculo->save();
            return response()->json(['Mensaje'=>'El vehiculo fue editado ok'],202);
           }
           return response()->json(['Mensaje'=>'No fue necesario guardar ningun cambio','codigo'=>200],200);
           }

          if(!$color||!$potencia||!$peso||!$cilindraje){
            return response()->json(['Mensaje'=>'Datos Invalidos'],404);
           }
        $vehiculo->color=$color;
        $vehiculo->cilindraje=$cilindraje;
        $vehiculo->peso=$peso;
        $vehiculo->potencia=$potencia;
        $vehiculo->save();
        return response()->json(['Mensaje'=>'El vehiculo fue editado ok'],202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idFabricante,$idVehiculo)
    {
        $fabricante = Fabricante::find($idFabricante);

        if(!$fabricante){
            return response()->json(['Mensaje'=>'No se encuentra el fabricante','codigo'=>404],404);
         } 
         $vehiculo = $fabricante->vehiculos()->find($idVehiculo); 

         if(!$vehiculo){
            return response()->json(['Mensaje'=>'No se encuentra el vehiculo asociado a este fabricante','codigo'=>404],404);
         }
         $vehiculo->delete();
         return response()->json(['Mensaje'=>'El vehiculo fue eliminado','codigo'=>200],200);
    }
}
