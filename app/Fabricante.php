<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    protected $table ="fabricantes";

    protected $fillable = ['id','nombre','telefono'];

    protected $hidden = ['created_at','updated_at'];

    public function Vehiculos(){
        return $this->hasmany('App\Vehiculo');
    }
}
