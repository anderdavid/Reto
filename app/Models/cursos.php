<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cursos extends Model
{
    protected $table = "cursos";
    public function estudiantes(){
        return $this->belongsToMany("App\Models\estudiantes")->withTimestamps();
    }
}
