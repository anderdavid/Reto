<?php

namespace App\Services;

class NegocioService
{
    public function castMonth($month)
    {
        if($month == "Enero"){
            return 1;
        }
        if($month == "Febrero"){
            return 2;
        }
        if($month == "Marzo"){
            return 3;
        }
        if($month == "Abril"){
            return 4;
        }
        if($month == "Mayo"){
            return 5;
        }
        if($month == "Junio"){
            return 6;
        }
        if($month == "Julio"){
            return 7;
        }
        if($month == "Agosto"){
            return 8;
        }
        if($month == "Septiembre"){
            return 9;
        }
        if($month == "Octubre"){
            return 10;
        }
        if($month == "Noviembre"){
            return 11;
        }
        if($month == "Diciembre"){
            return 12;
        }

        return "";
    }
}