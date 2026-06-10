@extends('layout.app')

@section('sidebar')
    @parent
@endsection

@section('content')

<div class="container">
    <div class="title-container">
        <h1 class="text-secondary">Crear Negocio</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="/negocios/store">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Descripcion: </label>
                            <input class="form-control" type="text" name="descripcion" placeholder="Ingrese descripcion propiedad" required="true">
                        </div>

                        <div class="form-group">
                            <label for="nombre">Direccion: </label>
                            <input class="form-control" type="text" name="direccion" placeholder="Ingrese direccion" required="true">
                        </div>

                        <div class="form-group">
                            <label for="nombre">Propietario: </label>
                            <input class="form-control" type="text" name="nombrePropietario" placeholder="Nombre propietario" required="true">
                        </div>

                        <div class="form-group">
                            <label for="nombre">Telefono: </label>
                            <input class="form-control" type="text" name="telefonoPropietario" placeholder="Telefono propietario" required="true">
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
                            <input class="form-control" type="text" name="valor" placeholder="Ingrese valor" required="true">
                        </div>


                        <div class="form-group">
                            <label for="sel1">Fecha de Negocio:</label>
                            <input id="datepicker1" width="276" name="fecha" value="2026-06-10" />
                            <script>
                                $('#datepicker1').datepicker({

                                        uiLibrary: 'bootstrap4',
                                        format: 'yyyy-mm-dd'

                                    });
                            </script>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Empleado: </label>
                            <input class="form-control" type="text" name="nombreEmpleado" placeholder="Ingrese nombre del Empleado " required="true">
                        </div>

                        <div class="form-group">
                            <label for="nombre">Puntos Consertados: </label>
                            <input class="form-control" type="number" name="puntosConcertados" placeholder="Puntos Concertados" required="true">
                        </div>

                        <div class="form-group">
                            <label for="nombre">Puntos Captados: </label>
                            <input class="form-control" type="number" name="puntosCaptados" placeholder="Puntos Captados" required="true">
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

