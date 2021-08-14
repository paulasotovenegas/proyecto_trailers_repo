

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
                        <a class="nav-link btn btn-primary btn-round" href="{{route('inicioSesion')}}">Iniciar Sesion</a>
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
            <div class="card" style="background-color: black;">
                <div class="card-header">{{ __('¡Verifique su correo!') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Una verificación de correo nueva ha sido enviada a su correo.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor compruebe su correo en el link de verificación que se le envió.') }}
                    <br>
                    {{ __('Si no recibió el correo') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button  style="background-color: white;" type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('¡Click aquí para solicitar otro!') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<footer  style="background-color: black;" class="footer">
    <div  class="container">
        
        <div class="copyright">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>,
            <span> <a href="#" target="_blank">ZUMBADO</a></span>
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
