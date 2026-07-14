<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visita;
use Illuminate\Support\Facades\DB;
use App\Services\NegocioService;
use App\Services\VisitasService;

class VisitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        $mService = new NegocioService;
        $comisionTotal = null;

        $year = $request->get('year');
        $month = $request->get('month');
        $nombreEmpleado = $request->get('nombreEmpleado');

        $numberMonth = $mService->castMonth($month);

        $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $years = ['2026','2027','2028','2029','2030'];


        if(isset($year) && isset($month) && isset($nombreEmpleado)){
           $visitas = DB::table('visitas as v')
                ->select('v.*','n.nombrePropietario','n.telefonoPropietario','n.descripcion','n.direccion','n.categoria','n.valor')
                ->join('negocios as n', 'v.negocio_id', '=', 'n.id')
                ->whereIn("n.categoria",["Venta","Anticres"])
                ->whereMonth('v.fecha', $numberMonth)
                ->whereYear('v.fecha', $year)
                ->where('v.nombreEmpleado', $nombreEmpleado)
                ->orderBy('v.fecha')
                ->paginate(9);

            $comisionTotal = DB::table('visitas as v')
                ->select(
                    DB::raw('SUM(v.comisionEmpleado) as comision'),
                )
                ->join('negocios as n', 'v.negocio_id', '=', 'n.id')
                ->whereIn("n.categoria",["Venta","Anticres"])
                ->whereMonth('v.fecha', $numberMonth)
                ->whereYear('v.fecha', $year)
                ->where('v.nombreEmpleado', $nombreEmpleado)
                ->groupBy('v.nombreEmpleado')
                ->first();

        }else{
            $visitas = DB::table('visitas as v')
                ->select('v.*','n.nombrePropietario','n.telefonoPropietario','n.descripcion','n.direccion','n.categoria','n.valor')
                ->whereIn("n.categoria",["Venta","Anticres"])
                ->join('negocios as n', 'v.negocio_id', '=', 'n.id')
                ->orderBy('v.fecha')
                ->paginate(9);

        }

      
        return view('visitas/visitasView',compact('visitas'), 
            [
                'currentMonth'=>$month, 
                'currentYear'=>$year,
                'months'=> $months,
                'years'=>$years,
                'nombreEmpleado'=> $nombreEmpleado,
                'numberMonth'=> $numberMonth,
                'comision'=> $comisionTotal
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = ["Anticres", "Venta"];

        $negocios = DB::table('negocios as n')
                ->select('n.id','n.nombrePropietario','n.descripcion','n.categoria')
                ->whereIn("n.categoria",["Venta","Anticres"])
                ->orderBy('n.nombrePropietario')
                ->get();

        return view('/visitas/visitasCreate',['categorias'=>$categorias,'negocios'=>$negocios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mVisita = new visita;
      
     
        $mVisita->nombreEmpleado = $request->nombreEmpleado;
        $mVisita->negocio_id = $request->negocio_id;
        $mVisita->fecha = $request->fecha;
        $mVisita->ubicacion=$request->ubicacion;
        $mVisita->precio=$request->precio;
        $mVisita->acuerdo=$request->acuerdo;

        $negocio = DB::table('negocios as n')
                ->select('n.categoria', 'n.valor')
                ->where('n.id',$mVisita->negocio_id)
                ->first();
        
        $mService = new VisitasService($negocio->valor, $negocio->categoria);
        $mService->setComisionPropuesta();
        $mService->setCalificacion($mVisita->ubicacion, $mVisita->precio, $mVisita->acuerdo);
        $mService->setComisionEmpleado();

        $mVisita->comisionPropuesta = $mService->getComisionPropuesta();
        $mVisita->comisionEmpleado = $mService->getComisionEmpleado();
        $mVisita->calificacionPuntos = $mService->getCalificacionPuntos();
        $mVisita->calificacion = $mService->getCalificacion();

        $mVisita->save();

        return redirect('/visitas/show'); 

    }


    public function export(Request $request){

        $mService = new NegocioService;
        $comisionTotal = null;

        $year = $request->get('year');
        $month = $request->get('month');
        $nombreEmpleado = $request->get('nombreEmpleado');

        $numberMonth = $mService->castMonth($month);

        $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $years = ['2026','2027','2028','2029','2030'];


        if(isset($year) && isset($month) && isset($nombreEmpleado)){
           $visitas = DB::table('visitas as v')
                ->select('v.*','n.nombrePropietario','n.telefonoPropietario','n.descripcion','n.direccion','n.categoria','n.valor')
                ->join('negocios as n', 'v.negocio_id', '=', 'n.id')
                ->whereIn("n.categoria",["Venta","Anticres"])
                ->whereMonth('v.fecha', $numberMonth)
                ->whereYear('v.fecha', $year)
                ->where('v.nombreEmpleado', $nombreEmpleado)
                ->orderBy('v.fecha')
                ->get();

            $comisionTotal = DB::table('visitas as v')
                ->select(
                    DB::raw('SUM(v.comisionEmpleado) as comision'),
                )
                ->join('negocios as n', 'v.negocio_id', '=', 'n.id')
                ->whereIn("n.categoria",["Venta","Anticres"])
                ->whereMonth('v.fecha', $numberMonth)
                ->whereYear('v.fecha', $year)
                ->where('v.nombreEmpleado', $nombreEmpleado)
                ->groupBy('v.nombreEmpleado')
                ->first();

        }else{
            $visitas = DB::table('visitas as v')
                ->select('v.*','n.nombrePropietario','n.telefonoPropietario','n.descripcion','n.direccion','n.categoria','n.valor')
                ->whereIn("n.categoria",["Venta","Anticres"])
                ->join('negocios as n', 'v.negocio_id', '=', 'n.id')
                ->orderBy('v.fecha')
                ->get();

            $comisionTotal = DB::table('visitas as v')
                ->select(
                    DB::raw('SUM(v.comisionEmpleado) as comision'),
                )
                ->join('negocios as n', 'v.negocio_id', '=', 'n.id')
                ->whereIn("n.categoria",["Venta","Anticres"])
                ->groupBy('v.nombreEmpleado')
                ->first();

        }

        return response()->streamDownload(function () use ($visitas,$comisionTotal) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Empleado', 
                'Propietario',
                'Telefono',
                'Descripcion',
                'Direccion',
                'Categoria',
                'Valor',
                'Fecha',
                'Comision propuesta',
                'Calificacion Puntos',
                'Calificacion',
                'Comision Empleado',
        ]);

            foreach ($visitas as $visita) {
                fputcsv($file, [
                    $visita->nombreEmpleado,
                    $visita->nombrePropietario,
                    $visita->telefonoPropietario,
                    $visita->descripcion,
                    $visita->direccion,
                    $visita->categoria,
                    number_format($visita->valor, 0, ',', '.'),
                    $visita->fecha,
                    number_format($visita->comisionPropuesta, 0, ',', '.'),
                    $visita->calificacionPuntos,
                    $visita->calificacion,
                    $visita->comisionEmpleado
                    
                ]);
            }
            fputcsv($file,[]); 
            fputcsv($file,[]); 
            fputcsv($file,['Comision Total ',$comisionTotal->comision]);  


            fclose($file);
        }, 'negocios.csv'); 
 

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
        $mVisita =\App\Models\visita::where('id',$id)->first();

        $categorias = ["Anticres", "Venta"];

        $negocios = DB::table('negocios as n')
                ->select('n.id','n.nombrePropietario','n.descripcion','n.categoria')
                ->whereIn("n.categoria",["Venta","Anticres"])
                ->orderBy('n.nombrePropietario')
                ->get();

       /*  echo "visita: ".json_encode($mVisita); */

        return view('/visitas/visitasEdit',["visita"=>$mVisita, 'categorias'=>$categorias,'negocios'=>$negocios]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mVisita =\App\Models\visita::where('id',$id)->first();
      
        $mVisita->nombreEmpleado = $request->nombreEmpleado;
        $mVisita->negocio_id = $request->negocio_id;
        $mVisita->fecha = $request->fecha;
        $mVisita->ubicacion=$request->ubicacion;
        $mVisita->precio=$request->precio;
        $mVisita->acuerdo=$request->acuerdo;

        $negocio = DB::table('negocios as n')
                ->select('n.categoria', 'n.valor')
                ->where('n.id',$mVisita->negocio_id)
                ->first();
     
      

        $mService = new VisitasService($negocio->valor, $negocio->categoria);
        $mService->setComisionPropuesta();
        $mService->setCalificacion($mVisita->ubicacion, $mVisita->precio, $mVisita->acuerdo);
        $mService->setComisionEmpleado();

        $mVisita->comisionPropuesta = $mService->getComisionPropuesta();
        $mVisita->comisionEmpleado = $mService->getComisionEmpleado();
        $mVisita->calificacionPuntos = $mService->getCalificacionPuntos();
        $mVisita->calificacion = $mService->getCalificacion();

        $mVisita->save();

        return redirect('/visitas/show'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \App\Models\visita::where('id',$id)->delete();
        return redirect('/visitas/show');
    }
}
