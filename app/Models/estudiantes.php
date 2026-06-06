<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class estudiantes extends Model
{
    protected $table = "estudiantes";

    public function cursos(){
        return $this-> belongsToMany("App\Models\cursos");
    }
}
