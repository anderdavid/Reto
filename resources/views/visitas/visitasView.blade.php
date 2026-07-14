@extends('layout.app')

@section('sidebar')
    @parent
@endsection

@section('content')

<div class= "viewContainer">
    <script type="text/javascript">

        var idVisita="";

        function eliminar(id){
			idVisita =id;
		}

		function borrar(){
			location.href = "/visitas/destroy/"+idVisita;
		}

        function exportar(year = '',month='',nombreEmpleado= ''){
            year = year ?? '';
            month = month ?? '';
            nombreEmpleado = nombreEmpleado ?? '';
            
            location.href =  `/visitas/exportar?year=${year}&month=${month}&nombreEmpleado=${nombreEmpleado}`
        }
    </script>
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

    <div class="col-md-4">
        <button 
            class="btn btn-secondary" 
            style= "margin-left:4px; background: #238945; color:#fff;" 
            data-dismiss="modal"
            onclick='exportar(@json($currentYear),@json($currentMonth),@json($nombreEmpleado))'
            >
            Exportar
        </button>
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
                                @if(now()->month <= \Carbon\Carbon::parse($visita->fecha)->month)
								<a  href="/visitas/edit/{{$visita->id}}"><i class="icono-action far fa-edit"></i>
									<span class="tooltiptext">Editar</span>
								</a>
                                @else
                                <a href="#">
                                    <i class="icono-action fas fa-lock"></i>
                                </a>
                                @endif
                            </div>
                             <div class="col-md-3">
                                <a onclick="eliminar({{$visita->id}})" data-toggle="modal" data-target="#modalErase">
                                    <i class="icono-action fas fa-trash-alt" style = "color: #007bff; cursor:pointer;"></i>
                                    <span class="tooltiptext">Borrar</span>
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

      <div class="modal" id="modalErase">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger" style= "background-color: #45627f !important">
					<h4 class="modal-title text-light">Advertencia!</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					¿Está seguro de eliminar esta visita?
				</div>
				<div class="modal-footer">
					<div class="row" style="margin-right: 10px">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<button onClick="borrar()" class="btn btn-primary">Aceptar</button>
						</div>
						<div class="col-md-4">
							<button class="btn btn-danger" style= "margin-left:4px;" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>

			</div>
		</div>
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

