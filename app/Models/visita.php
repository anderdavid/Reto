<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class visita extends Model
{
    protected $table = "visitas";

    public function getIdPropiedad(){
        return $this->belongsTo('App\Models\propiedad','propiedad_id');
    }

    public function getIdNegocio(){
        return $this->belongsTo('App\Models\negocio','negocio_id');
    }
}
