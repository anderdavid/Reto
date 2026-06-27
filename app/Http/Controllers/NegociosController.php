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

    private $categorias = ["Arriendo", "Anticres", "Venta"];
    private  $valorPunto = 2500;

    public function index(Request $request)
    {
        $mService = new NegocioService;

       
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
                    'valorPunto'=>$this->valorPunto
                ]
            ); 


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/negocio/negocioCreate',['categorias'=>$this->categorias]);
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

        
        $existNegocio= $mNegocio->where('telefonoPropietario', $request->telefonoPropietario)->first();
        
        if(isset($existNegocio)){
            return view('/negocio/negocioCreate',['errorPhone'=>"telefono ya existe",'categorias'=>$this->categorias]);
        }

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

    public function export(Request $request){

       
     
        $mService = new NegocioService;

        $year = $request->get('year');
        $month = $request->get('month');
        $nombreEmpleado = $request->get('nombreEmpleado');

        $numberMonth = $mService->castMonth($month);

        if(isset($year) && isset($month) && isset($nombreEmpleado)){
           $negocios = DB::table('negocios as n')
                ->select('n.*')
                ->whereMonth('n.fecha', $numberMonth)
                ->whereYear('n.fecha', $year)
                ->where('n.nombreEmpleado', $nombreEmpleado)
                ->orderBy('n.fecha')
                ->get();

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
                ->get();

            $puntos = DB::table('negocios as n')
                ->select(
                    DB::raw('SUM(n.puntos) as puntos'),
                )
                ->first();

        }

       

       
        // echo "negocios ".json_encode($negocios); 
        // echo "puntos ".$puntos->puntos;

        return response()->streamDownload(function () use ($negocios,$puntos) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Empleado', 
                'Propietario',
                'Telefono',
                'Descripcion',
                'Direccion',
                'Categoria',
                'valor',
                'fecha',
                'Es concertado',
                'puntos'

            ]);

            foreach ($negocios as $negocio) {
                fputcsv($file, [
                    $negocio->nombreEmpleado,
                    $negocio->nombrePropietario,
                    $negocio->telefonoPropietario,
                    $negocio->descripcion,
                    $negocio->direccion,
                    $negocio->categoria,
                    $negocio->valor,
                    $negocio->fecha,
                    $negocio->esConcertado?"Si":"No",
                    $negocio->puntos
                ]);
            }
            fputcsv($file,[]); 
            fputcsv($file,[]); 
            fputcsv($file,['puntos',$puntos->puntos]);
            fputcsv($file,['Total a pagar ',$puntos->puntos * $this->valorPunto]);  


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
        //echo "edit ".$id;
        $mNegocio =\App\Models\negocio::where('id',$id)->first();

        //echo json_encode($mNegocio);
        
        return view('/negocio/negocioEdit',['categorias'=>$this->categorias, "mNegocio"=>$mNegocio]);
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mNegocio =\App\Models\negocio::where('id',$id)->first();
        $mService = new NegocioService;
        $gNegocio = new negocio;
       

        $mNegocio->nombreEmpleado = $request->nombreEmpleado;
        $mNegocio->nombrePropietario = $request->nombrePropietario;
        $mNegocio->telefonoPropietario = $request->telefonoPropietario;

        $existNegocio= $gNegocio->where('telefonoPropietario', $request->telefonoPropietario)->first();
        //echo "exist negocio ".json_encode($existNegocio);

        
        if(isset($existNegocio) && $existNegocio->id != $mNegocio->id){
            return view('/negocio/negocioEdit',['errorPhone'=>"telefono ya existe",'categorias'=>$this->categorias,'mNegocio'=>$mNegocio]);
        }

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
