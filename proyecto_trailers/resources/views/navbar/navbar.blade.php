<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <title>Zumbado</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/morrisjs/morris.min.css') }}" />
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <!-- Custom Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css') }}">
    <link href="{{ 'assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css' }}"
        rel="stylesheet" />
    <!-- Bootstrap Select Css -->
    <link href="{{ 'assets/plugins/bootstrap-select/css/bootstrap-select.css' }}" rel="stylesheet" />

</head>

<body class="theme-cyan">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img class="zmdi-hc-spin" src="{{ asset('assets/images/logo.svg') }} " width="48"
                    height="48" alt="Compass"></div>
            <p>Cargando...</p>
        </div>
    </div>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="col-12">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{ route('navbar') }}"><img
                        src="{{ asset('assets/images/logozumbado.svg') }}" width="500" alt="Zumbado"><span
                        class="m-l-10"></span></a>
            </div>
            <ul class="nav navbar-nav navbar-left">
                <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i
                            class="zmdi zmdi-swap"></i></a></li>
                <li class="hidden-sm-down">

                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li>
                    <a href="javascript:void(0);" class="fullscreen hidden-sm-down" data-provide="fullscreen"
                        data-close="true"><i class="zmdi zmdi-fullscreen"></i></a>
                </li>

                <li class=""><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i
                            class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
            </ul>
        </div>
    </nav>

    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info">
                        <div> </div>
                        <div class="detail">
                            <h4><strong> {{ Auth::user()->name }}</strong></h4>

                        </div>

                        @auth
                            <a href="{{ route('logout') }}" title="Cerrar Sesión" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">

                                <i class="zmdi zmdi-power"></i></a>
                             

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                <i class="zmdi zmdi-pin-account"></i></a>
                                @csrf
                            </form>
                        @endauth
                    </div>
                </li>
                <li class="header">Administración</li>

                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                    class="zmdi zmdi-pin-account"></i><span>Perfil</span> </a>
            <ul class="ml-menu">
                <li> <a href="{{ route('miPerfil') }}">Ver Mi Perfil</a></li>
            </ul>
        </li>
                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-assignment-account"></i><span>Empleados</span> </a>
                    <ul class="ml-menu">
                        <li> <a href="{{ route('verEmpleados') }}">Ver Empleados</a></li>
                        @if (Auth::user()->id_rol == 1)
                            <li> <a href="{{ route('ingresarEmpleados') }}">Ingresar Empleados</a></li>

                        @endif
                    </ul>
                </li>
                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-flight-takeoff"></i><span>Viajes</span> </a>
                    <ul class="ml-menu">
                        <li> <a href="{{ route('verViajes') }}">Ver Viajes</a></li>
                        @if(Auth::user()->id_rol == 1)
                        <li> <a href="{{ route('viajes.create') }}">Ingresar Viajes</a></li>
                        @endif

                    </ul>
                </li>
                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-pin-drop"></i><span>Rutas</span> </a>
                    <ul class="ml-menu">
                        <li> <a href="{{ route('verRutas') }}">Ver Rutas</a></li>
                        @if(Auth::user()->id_rol == 1)
                        <li> <a href="{{ route('ingresarRutas') }}">Ingresar Rutas</a></li>
                        @endif

                    </ul>
                </li>
                @if (Auth::user()->id_rol == 1)
                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account"></i><span>Usuarios</span> </a>
                        <ul class="ml-menu">
                            <li><a href="{{ route('verUsuarios') }}">Ver Usuarios</a></li>
                            

                        </ul>
                    </li>
                @endif
                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-settings-square"></i><span>Reparaciones</span> </a>
                    <ul class="ml-menu">
                        <li> <a href="{{ route('verReparaciones') }}">Ver Reparaciones</a></li>
                        @if(Auth::user()->id_rol == 1)
                        <li> <a href="{{ route('ingresarReparaciones') }}">Ingresar Reparaciones</a></li>

                        @endif
                    </ul>
                </li>
                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-truck"></i><span>Trailers</span> </a>
                    <ul class="ml-menu">
                        <li> <a href="{{ route('verTrailers') }}">Ver Trailers</a></li>
                        @if(Auth::user()->id_rol == 1)
                        <li> <a href="{{ route('ingresarTrailers') }}">Ingresar Trailers</a></li>
                        @endif
                    </ul>
                </li>


                <li class="header">Gráficas</li>
                <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-chart"></i><span>Ver
                            Gráficas</span> </a>
                    <ul class="ml-menu">
                        <li> <a href="/grafic/Viajes">Gráfica de Viajes</a></li>
                        <li> <a href="{{ route('graficoReparaciones') }}">Gráfica de Reparaciones</a></li>
                        <li> <a href="{{ route('graficoRutas') }}">Gráfica de Rutas</a></li>

                    </ul>
                </li>

                <li class="header">Reportes</li>
                <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-collection-pdf"></i><span>Ver
                            Reportes</span> </a>
                    <ul class="ml-menu">
                        <li> <a href="{{ route('reporteEmpleados') }}">Reporte de Empleados</a></li>
                        <li> <a href="{{ route('reporteViajes') }}">Reporte de Viajes</a></li>
                        <li> <a href="{{ route('reporteRutas') }}">Reporte de Rutas</a></li>
                        <li> <a href="{{ route('reporteReparaciones') }}">Reporte de Reparaciones</a></li>
                        <li> <a href="{{ route('reporteTrailers') }}">Reporte de Trailers</a></li>
                    </ul>
                </li>
                @if(Auth::user()->id_rol == 1)
                <li> <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-assignment"></i><span>Bitácora</span> </a>
                    <ul class="ml-menu">
                        <li><a href="{{ route('reporteBitacora') }}">Ver Bitácora</a></li>
                    </ul>
                </li>
@endif
            </ul>
        </div>
    </aside>

    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting"><i
                        class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active slideRight" id="setting">
                <div class="slim_scroll">
                    <div class="card">

                        <div class="card">
                            <h6>Aspecto</h6>
                            <ul class="list-unstyled theme-light-dark">
                                <li>
                                    <div class="t-light btn btn-default btn-simple btn-round">Claro</div>
                                </li>
                                <li>
                                    <div class="t-dark btn btn-default btn-round">Obscuro</div>
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>

            </div>
    </aside>

    <!-- Main Content -->
    <main class="content home">
        <section class="content home">
            @yield('content')
        </section>
    </main>


    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
    <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="{{ asset('assets/bundles/morrisscripts.bundle.js') }}"></script>
    <!-- Morris Plugin Js -->
    <script src="{{ asset('assets/bundles/jvectormap.bundle.js') }}"></script>
    <!-- JVectorMap Plugin Js -->
    <script src="{{ asset('assets/bundles/knob.bundle.js') }}"></script>
    <!-- Jquery Knob Plugin Js -->
    <script src="{{ asset('assets/bundles/sparkline.bundle.js') }}"></script>
    <!-- Sparkline Plugin Js -->

    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/index.js') }}"></script>


    <script src="{{ 'assets/plugins/momentjs/moment.js' }}"></script>
    <script src="{{ 'assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js' }}">
    </script>
    <script src="{{ 'assets/js/pages/forms/basic-form-elements.js' }}"></script>

    <script>
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            autoclose: true
        });
    </script>
</body>

</html>
