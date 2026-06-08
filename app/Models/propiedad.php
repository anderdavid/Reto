<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class propiedad extends Model
{
    protected $table = "propiedades";

    public function negocio(){
        return $this->hasOne('App\Models\negocio');
    }

    public function visitas(){
        return $this->hasMany('App\Models\visitas');
    }
}
