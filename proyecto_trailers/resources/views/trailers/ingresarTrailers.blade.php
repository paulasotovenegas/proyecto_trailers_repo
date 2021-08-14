@extends('navbar.navbar')
@section('content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">     
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio </a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ingresar Trailers </a></li>
                    <li class="breadcrumb-item active">Trailers</li>
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
                        <h2><strong>Ingresar Trailers</strong> </h2>                        
                    </div>
                    <div class="body">
                        @if (session('success'))

                        <div class="alert alert-success" role="alert">
                        ¡Se Agregó Satisfactoriamente!
                        </div>
        
                        @endif
                            <form id="trailers" method="POST" action="{{route('trailers.store')}}">
                                @csrf
                        <h2 class="card-inside-title">Información de los Trailers</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">                                    
                                    <input type="text" class="form-control date" placeholder="Placa de Tráiler" name="placaTrailer" value="{{old('placaTrailer')}}" />
                                    @error('placaTrailer')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div><br>
                              
                                    <h2 class="card-inside-title">Fecha de Vencimiento de Tarjeta de Pesos y Dimensiones</h2>
                                  
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>
                                    
                                    <input type="date" name="tarjetaPesosDimensiones"  id="tarjetaPesosDimensiones" class="form-control date" placeholder="Tarjeta de Pesos y Dimensiones, eje: 30/07/2016">
                                    @error('tarjetaPesosDimensiones')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                                </div><br>

                                
                                    <h2 class="card-inside-title">Fecha de Vencimiento de Riteve</h2>
                                  
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>
                                    
                                    <input type="date" name="riteve"  id="riteve" class="form-control date" placeholder="Riteve, eje: 30/07/2016">
                                    @error('riteve')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                                </div><br>
                                
                              
                                    <h2 class="card-inside-title">Fecha de Vencimiento del Marchamo</h2>
                                    
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>
                                    
                                    <input type="date" name="marchamo"  id="marchamo" class="form-control date" placeholder="Marchamo, eje: 30/07/2016">
                                    @error('marchamo')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                                </div><br>
                             
                                    <h2 class="card-inside-title">Fecha de Vencimiento de Tarjeta de Transporte Peligroso</h2>
                                   
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>
                                    
                                    <input type="date" name="tarjetaTransportePeligroso"  id="tarjetaTransportePeligroso" class="form-control date" placeholder="Tarjeta de Transporte Peligroso, eje: 30/07/2016">
                                    @error('tarjetaTransportePeligroso')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                                </div><br>

                               
                                    <h2 class="card-inside-title">Código de Transportista</h2>
                                   
                                    <div class="form-group">                                    
                                        <input type="text" class="form-control date" placeholder="Código de Transportista" name="codigoTransportista" value="{{old('codigoTransportista')}}" />
                                        @error('codigoTransportista')
                                        <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>                            
                                   
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">GUARDAR</button>
    </div>
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/momentjs/moment.js"></script> <!-- Moment Plugin Js --> 
<!-- Bootstrap Material Datetime Picker Plugin Js --> 
<script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/forms/basic-form-elements.js"></script>


<script>
    var today = new Date().toISOString().split('T')[0];
   document.getElementsByName("tarjetaPesosDimensiones")[0].setAttribute('min', today);
   document.getElementsByName("riteve")[0].setAttribute('min', today);
   document.getElementsByName("marchamo")[0].setAttribute('min', today);
   document.getElementsByName("tarjetaTransportePeligroso")[0].setAttribute('min', today);
 </script>
@endsection