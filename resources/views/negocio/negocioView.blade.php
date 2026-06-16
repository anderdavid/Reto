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

    <table class="table table-borderless table-responsive-md mt-3">
        <thead class="thead-light">
            <tr>
                <th>Nombre Empleado</th>
                <th>Nombre Propietario</th>
                <th>Teléfono Propietario</th>
                <th>Descripción</th>
                <th>Dirección</th>
                <th>Categoría</th>
                <th>Valor</th>
                <th>Fecha</th>
                <th>Es Concertado</th>
                <th>Puntos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
             @foreach($negocios as $negocio)
                <tr>
                    <td>{{$negocio->nombreEmpleado}}</td>
                    <td>{{$negocio->nombrePropietario}}</td>
                    <td>{{$negocio->telefonoPropietario}}</td>
                    <td>{{$negocio->descripcion}}</td>
                    <td>{{$negocio->direccion}}</td>
                    <td>{{$negocio->categoria}}</td>
                    <td>{{number_format($negocio->valor, 0, ',', '.')}}</td>
                    <td>{{$negocio->fecha}}</td>
                    <td>{{$negocio->esConcertado ? "Si" : "No"}}</td>
                    <td>{{$negocio->puntos}}</td>
                    <td id="action">
						<div class="row">
						    <div class="col-md-3">
								<a  href="/negocios/edit/{{$negocio->id}}"><i class="icono-action far fa-edit"></i>
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
       {{ $negocios->appends(request()->query())->links() }}
    </div>
   

    @isset($puntos)
        <div class="puntosContainer">
            <div>
                <label>Puntos:</label>
                <span>{{$puntos->puntos}}</span>
            </div>
          
            <div>
                <label>Total a pagar:</label>
                <span>{{($puntos->puntos)*$valorPunto}}</span>
            </div>
        </div>
    @endisset

</div>  

@endsection