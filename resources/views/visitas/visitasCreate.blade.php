@extends('layout.app')

@section('sidebar')
    @parent
@endsection

@section('content')

<div class="container">
    <div class="title-container">
        <h1 class="text-secondary">Crear Visita</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="/visitas/store">
                  {{ csrf_field() }}
                  <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Nombre Empleado: </label>
                            <input class="form-control" type="text" name="nombreEmpleado" placeholder="Ingrese nombre del empleado" required="true">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre Propietario: </label>
                            <input class="form-control" type="text" name="nombrePropietario" placeholder="Ingrese nombre del propietario" required="true">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Telefono: </label>
                            <input class="form-control" type="text" name="telefonoPropietario" placeholder="Telefono" required="true">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Descripcion: </label>
                            <input class="form-control" type="text" name="descripcion" placeholder="Descripcion" required="true">
                        </div>

                        <div class="form-group">
                            <label for="nombre">Direccion: </label>
                            <input class="form-control" type="text" name="direccion" placeholder="Direccion" required="true">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Categoria:</label>
                            <select class="form-control" id="sel1" name="categoria">
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria}}">{{$categoria}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Valor: </label>
                            <input class="form-control" type="number" name="valor" placeholder="Ingrese valor" required="true">
                        </div>
                        <div class="form-group">
                            <label for="sel1">Fecha de Visita:</label>
                            <input id="datepicker1" width="276" name="fecha" value="2026-06-10" />
                            <script>
                                $('#datepicker1').datepicker({

                                        uiLibrary: 'bootstrap4',
                                        format: 'yyyy-mm-dd'

                                    });
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Comision: </label>
                            <input class="form-control" type="number" name="comision" placeholder="Ingrese comision" required="true">
                        </div>
                         <div class="form-group">
                            <label for="nombre">Calificacion: </label>
                            <input class="form-control" type="text" name="calificacion" placeholder="Ingrese calificacion" required="true">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Evaluacion: </label>
                            <input class="form-control" type="number" step= "0.01" name="evaluacion" placeholder="Ingrese evaluacion" required="true">
                        </div>
                       

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="Guardar" value="Guardar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection