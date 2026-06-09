<html>
    <head>
        <title>App Name - @yield('title')</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="{{asset('css/styles.css') }}">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

         <!--  DatePicker -->
        <script type="text/javascript" src="{{asset('js/messages.es-es.js') }}"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        @section('sidebar')
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style ="background: #45627f !important; padding: 20px 40px 20px 30px;">
                
                <a class="navbar-brand" href="#">SOLINAR PUNTOS DE NEGOCIO</a>
            </nav>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style ="background: #3f5a74 !important;">
             
            <!-- Links -->
              <ul class="navbar-nav">
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Negocios
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="/negocios/show">Ver</a>
                    <a class="dropdown-item" href="/negocios/create">Crear</a>
                  </div>
                </li>
               <!--  <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Cursos
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="/cursos/show">Ver</a>
                    <a class="dropdown-item" href="/cursos/create">Crear</a>
                  </div> -->
                 <!--   <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Funciones
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="/funciones/asignarCursos">Asignar Curso</a>
                    <a class="dropdown-item" href="/funciones/top3">Top 3</a>
                  </div>
                </li>
                </li> -->
              </ul>
            </nav>

        @show

        <div class="container">
            @yield('content')
        </div>
      <!--  <footer>
        <p>Created by SmartAppSolutions</p>
      </footer> -->
    </body>
</html>