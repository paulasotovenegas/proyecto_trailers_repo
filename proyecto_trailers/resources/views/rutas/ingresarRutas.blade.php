@extends('navbar.navbar')
@section('content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio </a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ingresar Rutas </a></li>
                    <li class="breadcrumb-item active">Rutas</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Ingresar Rutas</strong> </h2>                        
                    </div>
                    <div class="body">
                        @if (session('success'))

                        <div class="alert alert-success" role="alert">
                        ¡Se Agregó Satisfactoriamente!
                        </div>
        
                        @endif
                            <form id="rutas" method="POST" action="{{route('ruta.store')}}">
                                @csrf
                                <h2 class="card-inside-title">Información de Ruta</h2>
                                <div class="row clearfix">
                                <div class="col-sm-12">
                          
                                    <div class="form-group">
                                        <input type="text" name="descripcionRuta" class="form-control" placeholder="Descripción de la Ruta" value="{{old('descripcionRuta')}}"/>
                                        @error('descripcionRuta')
                                        <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">GUARDAR</button>  
                       
                        </form>                  
    </div>
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/momentjs/moment.js"></script> <!-- Moment Plugin Js --> 
<!-- Bootstrap Material Datetime Picker Plugin Js --> 
<script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/forms/basic-form-elements.js"></script>

@endsection