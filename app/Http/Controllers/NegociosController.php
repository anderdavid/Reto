<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\propiedad;
use \App\Models\negocio;

class NegociosController extends Controller
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
        return view('/negocio/negocioCreate',['categorias'=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo "store";
        $mPropiedad = new propiedad;
        $mNegocio = new negocio;

        $mPropiedad->descripcion = $request->descripcion;
        $mPropiedad->nombrePropietario = $request->nombrePropietario;
        $mPropiedad->telefonoPropietario = $request->telefonoPropietario;
        $mPropiedad->valor = $request->valor;
        $mPropiedad->direccion = $request->direccion;
        $mPropiedad->save();

        $mNegocio->fecha = $request->fecha;
        $mNegocio->nombreEmpleado = $request->nombreEmpleado;
        $mNegocio->categoria = $request->categoria;
        $mNegocio->puntosConcertados = $request->puntosConcertados;
        $mNegocio->puntosCaptados = $request->puntosCaptados;

        $mNegocio->getIdPropiedad()->associate($mPropiedad);
        $mNegocio->save();

        return redirect('/negocios/show');
    
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
