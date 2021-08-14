


<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>Zumbado</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/authentication.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/color_skins.css')}}">
</head>

<body class="theme-cyan authentication sidebar-collapse">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">        
        <div class="navbar-translate n_logo">
            <img src="{{asset('assets/images/logozumbado.svg')}}" href="{{route('inicioSesion')}}" alt="" height="50" width="200">
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                            
                <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-round" href="{{route('registro')}}">Registrarme</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<div class="page-header">
    <div class="page-header-image" style="background-color: black;"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            @if(session('notification'))
        <div class="alert alert-success">

{{session('notification')}}

        </div>
        @endif
            <div class="card-plain">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="header">
                        <div class="logo-container">
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account" style="font-size: 50px"></i><span></span> </a>
                        </div>
                        <h5>INICIO DE SESIÓN</h5>
                    </div>
                    <div class="content">                                                
                        <div class="input-group input-lg">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Nombre de Usuario" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-account-circle"></i>
                            </span>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                         
                        </div>
                        <div class="input-group input-lg">
                            <input id="password" type="password" placeholder="Clave" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                          
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="submit" class="btn l-cyan btn-round btn-lg btn-block waves-effect waves-light">
                            {{ __('INICIAR SESIÓN') }}
                        </button>
                       
                        @if (Route::has('password.request'))
                                    <a class="m-t-20" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidó su clave?') }}
                                    </a>
                                @endif
                      
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            
            <div class="copyright">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>,
                <span><a href="#" target="_blank">ZUMBADO</a></span>
            </div>
        </div>
    </footer>
</div>

<!-- Jquery Core Js -->
<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->

<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
//=============================================================================
$('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
}).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
});
</script>
</body>
