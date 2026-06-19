@extends('layout.app')

@section('sidebar')
    @parent
@endsection

@section('content')

<div class= "viewContainer">
   <div>
     <form method="GET">
            {{ csrf_field() }}
            <div class="form-inline" style ="margin-bottom: 25px;">
                <label for="curso" style="margin-left: 20px; margin-right: 10px" >Nombre empleado:</label>
                <input class="form-control" type= "text" placeholder= "Nombre Empleado" name="nombreEmpleado" value="{{$nombreEmpleado}}" required/>
                <label for="curso" style="margin-left: 20px; margin-right: 10px" ">Mes:</label>
                <select class="form-control" id="sel1" name="month" required>
                        <option value="" selected disabled>Seleccione un mes</option>
                        @foreach($months as $month)
                        <option value="{{$month}}"  {{$currentMonth == $month ? 'selected': ''}}>{{$month}}</option>
                        @endforeach
                    </select>

                <label for="curso" style="margin-left: 20px; margin-right: 10px">Año:</label>
                    <select class="form-control" id="sel2" name="year" required>
                        <option value="" selected disabled>Seleccione un año</option>
                        @foreach($years as $year)
                        <option value="{{$year}}" {{$currentYear == $year ? 'selected': ''}}>{{$year}}</option>
                        @endforeach
                    </select>
                <input type="submit" value="Calcular" class ="btn btn-primary" style="margin-left: 20px; margin-right: 10px"/>
            </div>
        </form>
    </div>

    <table class="table table-borderless table-responsive-md mt-3" style="font-size: 12px !important">
        <thead class="thead-light">
            <tr>
                <th>Nombre Empleado</th>
                <th>Nombre Propietario</th>
                <th>Teléfono Propietario</th>
                <th width= 150px>Descripción</th>
                <th width= 150px>Dirección</th>
                <th>Categoría</th>
                <th>Valor</th>
                <th width= 100px>Fecha</th>
                <th>Comision Propuesta</th>
                <th>Calificacion Puntos</th>
                <th>Calificacion</th>
                <th>Comision Empleado</th>
                <th>Acciones</th>
                
            </tr>
          

        </thead>
        <tbody>
            @foreach($visitas as $visita)
                <tr>
                    <td>{{$visita->nombreEmpleado}}</td>
                    <td>{{$visita->nombrePropietario}}</td>
                    <td>{{$visita->telefonoPropietario}}</td>
                    <td>{{$visita->descripcion}}</td>
                    <td>{{$visita->direccion}}</td>
                    <td>{{$visita->categoria}}</td>
                    <td>{{number_format($visita->valor, 0, ',', '.')}}</td>
                    <td>{{$visita->fecha}}</td>
                    <td>{{number_format($visita->comisionPropuesta, 0, ',', '.')}}</td>
                    <td>{{$visita->calificacionPuntos}}</td>
                    <td>{{$visita->calificacion}}</td>
                    <td>{{number_format($visita->comisionEmpleado, 0, ',', '.')}}</td>
                     <td id="action">
						<div class="row">
						    <div class="col-md-3">
								<a  href="/visitas/edit/{{$visita->id}}"><i class="icono-action far fa-edit"></i>
									<span class="tooltiptext">Editar</span>
								</a>
                            </div>
                        </div>
                    </td>
                
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
       {{ $visitas->appends(request()->query())->links() }}
    </div>

    @isset($comision)
    <div class="puntosContainer">
        <div>
            <label>Comision Total:</label>
            <span>{{$comision->comision}}</span>
        </div>
    </div>
    @endisset
   
</div>

@endsection

