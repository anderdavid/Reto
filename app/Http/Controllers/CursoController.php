<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('/cursos/cursosView');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $horarios = ["7am-9am", "9am-11am", "11am-1pm", "2pm-4pm"];
        return view('/cursos/cursosCreate',['horarios'=>$horarios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $curso = new \App\Models\cursos;
      $curso->nombre = $request->nombre_curso;
      $curso->horario = $request->horario;
      $curso->fecha_inicio = $request->fecha_inicio;
      $curso->fecha_fin = $request->fecha_fin;
      $curso->save();

      return redirect('/cursos/show');
    }
   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return view('/cursos/cursosViewId');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('/cursos/cursosUpdate');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        echo "update";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        echo "delete";
    }
}
