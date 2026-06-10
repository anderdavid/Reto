@extends('layout.app')

@section('sidebar')
    @parent
@endsection

@section('content')

   <!--  numberMonth:{{$numberMonth}}
   
    <h1 class="text-secondary" style= "line-height:24px; font-size:24px; margin-bottom:60px;">Puntos de negocio</h1> -->
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
                <th>Telefono Propietario</th>
                <th>descripcion</th>
                <th>direccion</th>
                <th>Categoria</th>
                <th>Valor</th>
                <th>Fecha</th>
                <th>Puntos Concertados</th>
                <th>Puntos Captados</th>
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
                    <td>{{$negocio->valor}}</td>
                    <td>{{$negocio->fecha}}</td>
                    <td>{{$negocio->puntosConcertados}}</td>
                    <td>{{$negocio->puntosCaptados}}</td>
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
                <label>Puntos Captados:</label>
                <span>{{$puntos->puntosCaptados}}</span>
            </div>
            <div>
                <label>Puntos Concertados:</label>
                <span>{{$puntos->puntosConcertados}}</span>
            </div>

             <div>
                <label>Total Puntos:</label>
                <span>{{($puntos->puntosConcertados + $puntos->puntosCaptados)}}</span>
            </div>

            <div>
                <label>Total a pagar:</label>
                <span>{{($puntos->puntosConcertados + $puntos->puntosCaptados)*$valorPunto}}</span>
            </div>
        </div>
    @endisset

   

@endsection