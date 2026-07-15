@extends('layout.app')

@section('sidebar')
    @parent
@endsection

@section('content')

<div class="container">
    <script>
        $(function () {
            console.log('jQuery cargado');

            $('#negocio').select2({
                placeholder: 'Buscar negocio',
                /*minimumInputLength: 1*/
            });
        });
    </script>
    <style>
        .select2-selection--single{
            height: 38px !important;
            border: 1px solid #dfe3e7 !important;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        .select2-search__field:focus{
            border-color: #80bdff !important;
            outline: none !important;
        }
    </style>
    <div class="title-container">
        <h1 class="text-secondary">Actualizar Visita</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="/visitas/update/{{$visita->id}}">
                  {{ csrf_field() }}
                  <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Nombre Empleado: </label>
                            <input class="form-control" type="text" name="nombreEmpleado" placeholder="Ingrese nombre del empleado" required="true" value ="{{$visita->nombreEmpleado}}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Negocio: </label>
                            <select id="negocio" name="negocio_id" class="form-control">
                                @foreach ($negocios as $negocio)
                                <option 
                                    value="{{$negocio->id}}"
                                    {{$negocio->id == $visita->negocio_id ? "selected": "" }}
                                    >
                                    {{$negocio->nombrePropietario}} - {{$negocio->descripcion}} -{{$negocio->categoria}}
                                    
                                </option>
                                @endforeach
                            </select>
                        </div>
                  
                       <div class="form-group">
                            <label for="sel1">Fecha de Visita:</label>
                            <input id="datepicker1" width="276" name="fecha" value="{{$visita->fecha}}" />
                            <script>
                                $('#datepicker1').datepicker({

                                        uiLibrary: 'bootstrap4',
                                        format: 'yyyy-mm-dd'

                                    });
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Ubicacion: (%) </label>
                            <input 
                                class="form-control" 
                                type="number" 
                                name="ubicacion" 
                                placeholder="Califique de 0 a 50"
                                min="0" 
                                max="50"
                                required="true" 
                                oninput="this.setCustomValidity('')"
                                oninvalid="this.setCustomValidity('El valor debe estar entre 0 y 50')"
                                value="{{$visita->ubicacion}}"  
                            >
                        </div>
                        <div class="form-group">
                            <label for="nombre">Precio:  (%)</label>
                            <input 
                                class="form-control" 
                                type="number" 
                                name="precio" 
                                placeholder="Califique de 0 a 30" 
                                min="0" 
                                max="30" 
                                required="true"
                                oninput="this.setCustomValidity('')"
                                oninvalid="this.setCustomValidity('El valor debe estar entre 0 y 30')"
                                value="{{$visita->precio}}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="nombre">Acuerdo:  (%)</label>
                            <input 
                                class="form-control" 
                                type="number" 
                                name="acuerdo" 
                                placeholder="Califique de 0 a 20" 
                                min="0" 
                                max="20" 
                                required="true"
                                oninput="this.setCustomValidity('')"
                                oninvalid="this.setCustomValidity('El valor debe estar entre 0 y 20')"
                                value="{{$visita->acuerdo}}"
                            >
                        </div>
                        
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="Guardar" value="Actualizar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection