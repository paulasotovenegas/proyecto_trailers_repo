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
                <img src="{{asset('assets/images/logozumbado.svg')}}" alt="" height="50" width="200">
                <button class="navbar-toggler" type="button">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                                
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-round" href="{{route('inicioSesion')}}">Iniciar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="page-header">
        <div class="page-header-image" style="background-color: black;"></div>
        <div class="container">
            <div class="col-md-12 justify-content-center">
                <div class="col-md-12 justify-content-center">
                    <div class="card-body">
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <div class="header">{{ __('Restaurar Contraseña') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Clave') }}</label>

                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Clave') }}</label>
                            <div class="col-md-4">
                                <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Restaurar Clave') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
