@extends('navbar.navbar')
@section('content')

<div class="block-header">
    <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio </a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Ver Viajes </a></li>
                <li class="breadcrumb-item active">Editar Viaje</li>
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
                    <h2><strong>Editar Viaje</strong> </h2>
                </div>
                <div class="body">
                    @if (session('success'))

                    <div class="alert alert-success" role="alert">
                        ¡Se Editó Satisfactoriamente!
                    </div>

                    @endif
                    <form id="viajes" method="POST" action="{{route('viajes.update',$item->id_viaje)}}">
                        @csrf
                        
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h2 class="card-inside-title">Fecha y Hora de Salida</h2>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>

                                        <input type="datetime-local" name="fechaHoraSalida" class="form-control date" value="{{$fechaHoraSalida}}" placeholder="Fecha y Hora de Salida, eje: 30/07/2016, 8:00am">
                                        @error('fechaHoraSalida')
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror

                                    </div><br>
                                

                                <h2 class="card-inside-title">Fecha y Hora de Llegada</h2>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>

                                        <input type="datetime-local" name="fechaHoraLlegada" class="form-control date" value="{{$fechaHoraLlegada}}" placeholder="Fecha y Hora de Llegada, eje: 30/07/2016, 8:00am">

                                       
                                        @error('fechaHoraLlegada')
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror

                                    </div><br>

                                 
                                    <h2 class="card-inside-title">Hora de Descarga</h2>
                                    <div class="input-group">
                                    <input type="time" class="form-control" placeholder="Tiempo de Descarga" name="tiempoDescarga" value="{{$item->tiempoDescarga}}" />
                                    @error('tiempoDescarga')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div><br>

                                    <h2 class="card-inside-title">Peajes</h2>
                                    <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Peajes" onchange="sumar()" name="peajes"  id="peajes"  value="{{$item->peajes}}" />
                                    @error('peajes')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div><br>

                                <h2 class="card-inside-title">Diesel</h2>

                                <div class="input-group">

                                    <input type="text" class="form-control" name="diesel" onchange="sumar()"  id="diesel"  value="{{$item->diesel}}" placeholder="Diesel">
                                    @error('diesel')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror

                                </div><br>


                                <h2 class="card-inside-title">Ganancia Bruta</h2>

                                <div class="input-group">

                                    <input type="text" class="form-control" name="gananciaBruta"  onchange="sumar()" id="gananciaBruta" value="{{$item->gananciaBruta}}" placeholder="Ganancia Bruta">
                                    @error('gananciaBruta')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror

                                </div><br>

                                <h2 class="card-inside-title">Pago de Empleado</h2>

                                <div class="input-group">

                                    <input type="text" class="form-control" id="pagoEmpleado" onchange="sumar()" name="pagoEmpleado" value="{{$item->pagoEmpleado}}" placeholder="Pago de Empleado">
                                    @error('pagoEmpleado')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror

                                </div><br>


                                <h2 class="card-inside-title">Descripción del Viaje</h2>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Descripción del Viaje" name="descripcionViaje" value="{{$item->descripcionViaje}}" />
                                    @error('descripcionViaje')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div><br>

                                <h2 class="card-inside-title">Descripción de Carga</h2>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Descripción de Carga" name="descripcionCarga" value="{{$item->descripcionCarga}}" />
                                    @error('descripcionCarga')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div><br>

                                <h2 class="card-inside-title">Ganancia Neta</h2>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Ganancia Neta" id="gananciaNeta" name="gananciaNeta" value="{{$item->gananciaNeta}}" readonly />
                                    @error('gananciaNeta')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div><br>

                                <div><br>
                                    <select name="id_trailer" class="form-control show-tick">
                                        @if($item->id_trailer != null)
                                        <option value="{{$item->id_trailer}}">{{$item->trailer->placaTrailer}}</option>
                                        @foreach($trailers as $trailer)

                                        <option value="{{$trailer->id_trailer}}">{{$trailer->placaTrailer}}</option>

                                        @endforeach
                                        @else
                                  
                                        <option value="">Seleccione el Trailer Encargado:</option>
                                        @foreach($trailers as $trailer)

                                        <option value="{{$trailer->id_trailer}}">{{$trailer->placaTrailer}}</option>

                                        @endforeach
                                        @endif
                                    </select>
                                    @error('id_trailer')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div><br>
                               
                                <div><br>
                                  

                                  <select name="id_ruta" class="form-control show-tick">
                                        @if($item->id_ruta != null)
                                        <option value="{{$item->id_ruta}}">{{$item->ruta->descripcionRuta}}</option>
                                        @foreach($rutas as $ruta)

                                        <option value="{{$ruta->id_ruta}}">{{$ruta->descripcionRuta}}</option>

                                        @endforeach
                                        @else
                                  
                                        <option value="">Seleccione la Ruta:</option>
                                        @foreach($rutas as $ruta)

                                        <option value="{{$ruta->id_ruta}}">{{$ruta->descripcionRuta}}</option>

                                        @endforeach
                                        @endif
                                    </select>
                                    @error('id_ruta')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div><br>

                                <div><br>
                                    <select name="id_empleado" class="form-control show-tick">
                                        @if($item->id_empleado != null)
                                        <option value="{{$item->id_empleado}}">{{$item->empleado->nombre}}</option>
                                        @foreach($empleados as $empleado)

                                        <option value="{{$empleado->id_empleado}}">{{$empleado->nombre}}</option>

                                        @endforeach
                                        @else
                                  
                                        <option value="">Seleccione el Empleado:</option>
                                        @foreach($empleados as $empleado)

                                        <option value="{{$empleado->id_empleado}}">{{$empleado->nombre}}</option>

                                        @endforeach
                                        @endif
                                    </select>
                                    @error('id_empleado')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div><br>

                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">GUARDAR</button>
                            </div>

                            <script>
                                function sumar () {
                                    var gananciaNeta = 0;	
                                    var sumas = 0;	
                                  var  gananciaBruta = document.getElementById('gananciaBruta').value;
                                    console.log(gananciaBruta);
                                  var  diesel = document.getElementById('diesel').value;
                                   var peajes = document.getElementById('peajes').value;
                                   var pagoEmpleado = document.getElementById('pagoEmpleado').value;
                                
                                    
                                if(gananciaBruta == 0 || gananciaBruta == null || gananciaBruta == ""){
                                    gananciaNeta="";
                                }else if(diesel == 0 || diesel == null || diesel == ""){
                                    gananciaNeta="";
                                }else if(peajes == 0 || peajes == null || peajes == ""){
                                    gananciaNeta="";
                                }else if(pagoEmpleado == 0 || pagoEmpleado == null || pagoEmpleado == ""){
                                    gananciaNeta="";
                                }else{
                                    sumas = parseInt(diesel) + parseInt(peajes) + parseInt(pagoEmpleado);
                                    gananciaNeta = parseInt(gananciaBruta) - parseInt(sumas);
                                }
                                document.getElementById('gananciaNeta').value = gananciaNeta;
                                }
                                </script>
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