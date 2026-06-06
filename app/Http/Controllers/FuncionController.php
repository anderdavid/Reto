<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function asignarCursos()
    {
        return view('/funciones/asignarCursos');
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo "store";
    }

    /**
     * Display the specified resource.
     */
    public function estudianteCurso(string $id)
    {
        return view('/funciones/estudianteCurso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function top3()
    {
        return view('/funciones/top3');
    }

    
}
