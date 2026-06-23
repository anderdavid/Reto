<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\negocio;
use Illuminate\Support\Facades\DB;
use App\Services\NegocioService;
use App\Services\VisitasService;

class NegociosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mService = new NegocioService;

        $valorPunto = 2500;
        $puntos = null;
        
        $year = $request->get('year');
        $month = $request->get('month');
        $nombreEmpleado = $request->get('nombreEmpleado');

        $numberMonth = $mService->castMonth($month);

        $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $years = ['2026','2027','2028','2029','2030'];
        

        if(isset($year) && isset($month) && isset($nombreEmpleado)){
           $negocios = DB::table('negocios as n')
                ->select('n.*')
                ->whereMonth('n.fecha', $numberMonth)
                ->whereYear('n.fecha', $year)
                ->where('n.nombreEmpleado', $nombreEmpleado)
                ->orderBy('n.fecha')
                ->paginate(9);

            $puntos = DB::table('negocios as n')
                ->select(
                    DB::raw('SUM(n.puntos) as puntos'),
                )
                ->whereMonth('n.fecha', $numberMonth)
                ->whereYear('n.fecha', $year)
                ->where('n.nombreEmpleado', $nombreEmpleado)
                ->groupBy('n.nombreEmpleado')
                ->first();

        }else{
            $negocios = DB::table('negocios as n')
                ->select('n.*')
                ->orderBy('n.fecha')
                ->paginate(9);

        }
    
       
        return view('/negocio/negocioView',compact('negocios'), 
                [
                    'currentMonth'=>$month, 
                    'currentYear'=>$year,
                    'months'=> $months,
                    'years'=>$years,
                    'nombreEmpleado'=> $nombreEmpleado,
                    'numberMonth'=> $numberMonth,
                    'puntos' =>$puntos,
                    'valorPunto'=>$valorPunto
                ]
            ); 


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
        $mNegocio = new negocio;
        $mService = new NegocioService;

        $mNegocio->nombreEmpleado = $request->nombreEmpleado;
        $mNegocio->nombrePropietario = $request->nombrePropietario;
        $mNegocio->telefonoPropietario = $request->telefonoPropietario;
        $mNegocio->descripcion = $request->descripcion;
        $mNegocio->direccion = $request->direccion;
        $mNegocio->categoria = $request->categoria;
        $mNegocio->valor = $request->valor;
        $mNegocio->fecha = $request->fecha;

        $isConcerted = $request->boolean('esConcertado') ? true : false;
        $mService->setPoints($request->categoria);
        $mService->addConcertedPoints($isConcerted);
        
        $mNegocio->esConcertado = $isConcerted;
        $mNegocio->puntos = $mService->getPoints();
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
        //echo "edit ".$id;
        $mNegocio =\App\Models\negocio::where('id',$id)->first();

        //echo json_encode($negocio);
        $categorias = ["Arriendo", "Anticres", "Venta"];
        return view('/negocio/negocioEdit',['categorias'=>$categorias, "mNegocio"=>$mNegocio]);
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mNegocio =\App\Models\negocio::where('id',$id)->first();
        $mService = new NegocioService;
       

        $mNegocio->nombreEmpleado = $request->nombreEmpleado;
        $mNegocio->nombrePropietario = $request->nombrePropietario;
        $mNegocio->telefonoPropietario = $request->telefonoPropietario;
        $mNegocio->descripcion = $request->descripcion;
        $mNegocio->direccion = $request->direccion;
        $mNegocio->categoria = $request->categoria;
        $mNegocio->valor = $request->valor;
        $mNegocio->fecha = $request->fecha;

        $isConcerted = $request->boolean('esConcertado') ? true : false;
        $mService->setPoints($request->categoria);
        $mService->addConcertedPoints($isConcerted);
        
        $mNegocio->esConcertado = $isConcerted;
        $mNegocio->puntos = $mService->getPoints();
        $mNegocio->save();


        $mVisitas = \App\Models\visita::from('visitas as v')
            ->select('v.*', 'n.categoria', 'n.valor')
            ->join('negocios as n', 'v.negocio_id', '=', 'n.id')
            ->whereIn('n.categoria', ['Venta', 'Anticres'])
            ->where('v.negocio_id', $mNegocio->id)
            ->get();

        foreach($mVisitas as $mVisita){
            $mVisitaServices = new VisitasService($mNegocio->valor, $mNegocio->categoria);
            $mVisitaServices->setComisionPropuesta();
            $mVisitaServices->setCalificacion($mVisita->ubicacion, $mVisita->precio, $mVisita->acuerdo);
            $mVisitaServices->setComisionEmpleado();

            $mVisita->comisionPropuesta =  $mVisitaServices->getComisionPropuesta();
            $mVisita->comisionEmpleado =  $mVisitaServices->getComisionEmpleado();
            $mVisita->calificacionPuntos =  $mVisitaServices->getCalificacionPuntos();
            $mVisita->calificacion =  $mVisitaServices->getCalificacion();


         /*    echo "visita".json_encode($mVisita)."<br>"; */

            $mVisita->save();
        }


        return redirect('/negocios/show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \App\Models\negocio::where('id',$id)->delete();
        return redirect('/negocios/show');
    }
}
