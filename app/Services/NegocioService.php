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

    public function getPoints($category){
        if($category == "Arriendo"){
            return 1;
        }
        if($category == "Anticres"){
            return 3;
        }
        if($category == "Venta"){
            return 2;
        }
    }

    public function getConcertedPoints($concerted){
        if($concerted){
            return 2;
        }
        else{
            return 0; 
        }
    }

    public function getComisionPropuesta($valor){
        return $valorTotalVenta * 1.8 / 100;
    }

    public function calificacion($ubicacion, $precio, $acuerdo, $category){
        $calificacionPuntos = $ubicacion + $precio + $acuerdo;

        if($category == "venta"){
            if($calificacionPuntos > 80 ){
                return "Exclusividad plus";
            }
            if($calificacionPuntos  == 80  ){
                return "Exclusividad";
            }
            if( $calificacionPuntos >= 73 && $calificacionPuntos<80 ){
                return "Inventario general";
            }
            if( $calificacionPuntos < 73){
                return "Inventario por defecto";
            }
        }
        if($category == "anticres"){
            if($calificacionPuntos > 80 ){
                return "Exclusividad plus";
            }

            if($calificacionPuntos < 80 ){
                return "Exclusividad";
            }
         }

        
    }

    public function getComisionEmpleado($calificacion, $comisionPropuesta,$category){
        if($category == "venta"){
            if($calificacion == "Exclusividad plus"){
                return 0.008 * $comisionPropuesta;
            }
            if($calificacion == "Exclusividad"){
                return 0.006 * $comisionPropuesta;
            }
              if($calificacion == "Inventario general"){
                return 0.003 * $comisionPropuesta;
            }
              if($calificacion == "Inventario por defecto"){
                return 0.002 * $comisionPropuesta;
            }
        }

         if($category == "anticres"){
            if($calificacion == "Exclusividad plus"){
                return 0.06* $comisionPropuesta;
            }
            if($calificacion == "Exclusividad"){
                return 0.04* $comisionPropuesta;
            }
        }
       
    } 


}