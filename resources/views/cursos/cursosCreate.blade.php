@extends('layout.app')

@section('sidebar')
    @parent
@endsection

@section('content')
   
    <div class="title-container">
         <h1 class="text-secondary">Crear Curso</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <form method="POST" action="/cursos/store">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Nombre: </label>
                            <input class="form-control" type="text" name="nombre_curso" placeholder="Ingrese nombre del curso " required="true">
                        </div>
                    
                        <div class="form-group">
                            <label for="sel1">Horario:</label>
                            <select class="form-control" id="sel1" name="horario">
                                @foreach ($horarios as $horario)
                                    <option value="{{$horario}}">{{$horario}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Fecha de Inicio:</label>
                            <input id="datepicker" width="276" name="fecha_inicio" value="2026-06-10" />
                            <script>
                                $('#datepicker').datepicker({
                                    
                                    uiLibrary: 'bootstrap4',
                                    format: 'yyyy-mm-dd'
                                    
                                });
                                
                            </script>	
                        </div>

                        <div class="form-group">
                            <label for="sel1">Fecha de Finalizacion:</label>
                            <input id="datepicker2" width="276" name="fecha_fin" value="2026-06-10"/>
                            <script>
                                $('#datepicker2').datepicker({

                                    uiLibrary: 'bootstrap4',
                                    format: 'yyyy-mm-dd'

                                });
                            </script>	
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="registrar" value="Registrar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
       
    </div>
@endsection