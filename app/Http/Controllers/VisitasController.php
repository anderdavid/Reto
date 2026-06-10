<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visita;

class VisitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = ["Arriendo", "Anticres", "Venta"];
        return view('/visitas/visitasCreate',['categorias'=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mVisita = new visita;
     
        $mVisita->nombreEmpleado = $request->nombreEmpleado;
        $mVisita->nombrePropietario=$request->nombrePropietario;
        $mVisita->telefonoPropietario=$request->telefonoPropietario;
        $mVisita->descripcion=$request->descripcion;
        $mVisita->direccion=$request->direccion;
        $mVisita->categoria=$request->categoria;
        $mVisita->valor=$request->valor;
        $mVisita->evaluacion=$request->evaluacion;
        $mVisita->fecha=$request->fecha;
        $mVisita->calificacion=$request->calificacion;
        $mVisita->comision=$request->comision;
        $mVisita->save(); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
