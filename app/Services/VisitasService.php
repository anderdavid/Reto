<?php

namespace App\Services;

class VisitasService{

    public string $EXCLUSIVIDAD_PLUS = "Exclusividad plus";
    public string $EXCLUSIVIDAD = "Exclusividad";
    public string $INVENTARIO_GENERAL = "Inventario general";
    public string $INVENTARIO_POR_DEFECTO = "Inventario por defecto";

    public string $ANTICRES = "Anticres";
    public string $VENTA = "Venta";

    public int $valorVenta;
    public string $category;

    public int $comisionPropuesta;
    public int $calificacionPuntos;
    public string $calificacion;
    public float $comisionEmpleado;
    
    public function __construct(int $valorVenta, string $category) {
        $this->valorVenta = $valorVenta;
        $this->category = $category;
    }


    public function getCategory(){
        return $this->category;
    }

    public function getValorVenta(){
        return $this->valorVenta;

    }
     public function getComisionPropuesta(){
        return $this->comisionPropuesta;
    }

    public function getCalificacion(){
        return $this->calificacion;
    }
    
    public function getCalificacionPuntos(){
        return $this->calificacionPuntos;
    }

    public function getComisionEmpleado(){
        return $this->comisionEmpleado;
    }

      public function setComisionPropuesta(){
        $this->comisionPropuesta =  (($this->valorVenta * 1.8) / 100);
    }

   

    public function setCalificacion($ubicacion, $precio, $acuerdo){
        $this->calificacionPuntos = $ubicacion + $precio + $acuerdo;

        if($this->category == $this->VENTA){
            if($this->calificacionPuntos > 80 ){
                $this->calificacion = $this->EXCLUSIVIDAD_PLUS;
            }
            if($this->calificacionPuntos  == 80  ){
                $this->calificacion = $this->EXCLUSIVIDAD;
            }
            if( $this->calificacionPuntos >= 73 && $calificacionPuntos<80 ){
                $this->calificacion = $this->INVENTARIO_GENERAL;
            }
            if( $this->calificacionPuntos < 73){
                $this->calificacion = $this->INVENTARIO_POR_DEFECTO;
            }
        }
        if($this->category == $this->ANTICRES){
            if($this->calificacionPuntos > 80 ){
                $this->calificacion = $this->EXCLUSIVIDAD_PLUS;
            }

            if($this->calificacionPuntos < 80 ){
                $this->calificacion = $this->EXCLUSIVIDAD;
            }
        }

        
    }

    public function setComisionEmpleado(){
        if($this->category == $this->VENTA){
            if($this->calificacion == $this->EXCLUSIVIDAD_PLUS){
                $this->comisionEmpleado =  0.008 * $this->comisionPropuesta;
            }
            if($this->calificacion == $this->EXCLUSIVIDAD){
                $this->comisionEmpleado =  0.006 * $this->comisionPropuesta;
            }
              if($this->calificacion == $this->INVENTARIO_GENERAL){
                $this->comisionEmpleado =  0.003 * $this->comisionPropuesta;
            }
              if($this->calificacion == $this->INVENTARIO_POR_DEFECTO){
                $this->comisionEmpleado =  0.002 * $this->comisionPropuesta;
            }
        }

        if($this->category == $this->ANTICRES){
            if($this->calificacion == $this->EXCLUSIVIDAD_PLUS){
                $this->comisionEmpleado =  0.06* $this->comisionPropuesta;
            }
            if($this->calificacion ==  $this->EXCLUSIVIDAD){
                $this->comisionEmpleado =  0.04* $this->comisionPropuesta;
            }
        }
       
    } 

   


}