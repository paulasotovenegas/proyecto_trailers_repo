@extends('navbar.navbar')
@section('content')
<style>

.without_ampm::-webkit-datetime-edit-ampm-field {
   display: none;
 }
 input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
 }


</style>



    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">     
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio </a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ingresar Viajes </a></li>
                    <li class="breadcrumb-item active">Viajes</li>
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
                        <h2><strong>Ingresar Viajes</strong> </h2>                        
                    </div>
                    <div class="body">
                        @if (session('success'))

                <div class="alert alert-success" role="alert">
                ¡Se Agregó Satisfactoriamente!
                </div>

                @endif
                    <form id="reparaciones" method="POST" action="{{route('viajes.store')}}">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-sm-12">
                            

                                <div>
                                    <h2 class="card-inside-title">Fecha y Hora de Salida</h2>
                                    </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>
                                    
                                    <input type="datetime-local" name="fechaHoraSalida" class="form-control date" placeholder="Fecha y Hora de Salida, eje: 30/07/2016">
                                    @error('fechaHoraSalida')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div><br>
                                <div>
                                    <h2 class="card-inside-title">Fecha y Hora de Llegada</h2>
                                    </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>
                                    
                                    <input type="datetime-local" name="fechaHoraLlegada" class="form-control date" placeholder="Fecha y Hora de Llegada, eje: 30/07/2016">
                                    @error('fechaHoraLlegada')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div><br>
                                <h2 class="card-inside-title">Hora de Descarga</h2>
                               
                               <div class="form-group">
                                   <input type="time" name="tiempoDescarga" class="form-control" placeholder="Tiempo de Descarga" />
                                   @error('tiempoDescarga')
                                   <div class="alert alert-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                                       </div>
                                   @enderror
                               </div><br>

                               <div>
                                    <h2 class="card-inside-title">Peajes</h2>
                                    </div>
                                <div class="input-group">
                                        <span class="input-group-addon"><i>₡</i></span>
                                        <input type="number" step="0.01" class="form-control money-dollar" id="peajes" onchange="sumar()" name="peajes" placeholder="Peajes, eje:  ₡100.000" value="{{old('peajes')}}">
                                        @error('peajes')
                                        <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>

                                    <div>
                                    <h2 class="card-inside-title">Diesel</h2>
                                    </div>
                                <div class="input-group">
                                        <span class="input-group-addon"><i>₡</i></span>
                                        <input type="number" class="form-control money-dollar" id="diesel" onchange="sumar()" name="diesel" placeholder="Diesel, eje:  ₡100.000" value="{{old('diesel')}}">
                                        @error('diesel')
                                        <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>

                                    <div>
                                    <h2 class="card-inside-title">Ganancia Bruta</h2>
                                    </div>
                                <div class="input-group">
                                        <span class="input-group-addon"><i>₡</i></span>
                                        <input type="number" class="form-control money-dollar" id="gananciaBruta" onchange="sumar()" name="gananciaBruta" placeholder="Ganancia Bruta, eje:  ₡100.000" value="{{old('gananciaBruta')}}">
                                        @error('gananciaBruta')
                                        <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>

                                    <div>
                                    <h2 class="card-inside-title">Pago de Empleado</h2>
                                    </div>
                                <div class="input-group">
                                        <span class="input-group-addon"><i>₡</i></i></span>
                                        <input type="number" class="form-control money-dollar" name="pagoEmpleado" onchange="sumar()" id="pagoEmpleado" placeholder="Pago Empleado, eje:  ₡100.000" value="{{old('pagoEmpleado')}}">
                                        @error('pagoEmpleado')
                                        <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>

                                    <h2 class="card-inside-title">Descripción del Viaje</h2>
                               
                               <div class="form-group">
                                   <input type="text" name="descripcionViaje" class="form-control" placeholder="Descripción del Viaje" value="{{old('descripcionViaje')}}" />
                                   @error('descripcionViaje')
                                   <div class="alert alert-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                                       </div>
                                   @enderror
                               </div><br>

                               <h2 class="card-inside-title">Descripción de la Carga</h2>
                               
                               <div class="form-group">
                                   <input type="text" name="descripcionCarga" class="form-control" placeholder="Descripción de la Carga" value="{{old('descripcionCarga')}}" />
                                   @error('descripcionCarga')
                                   <div class="alert alert-danger" role="alert">
                                   <strong>{{ $message }}</strong>
                                       </div>
                                   @enderror
                               </div><br>
                                    
                               <div>
                                    <h2 class="card-inside-title">Ganancia Neta</h2>
                                    </div>
                                <div class="input-group">
                                        <span class="input-group-addon"><i>₡</i></span>
                                        <input type="number" class="form-control money-dollar" name="gananciaNeta" id="gananciaNeta" placeholder="Ganancia Neta, eje:  ₡100.000" value="{{old('gananciaNeta')}}" readonly>
                                        @error('gananciaNeta')
                                        <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>

                                <div><br>
                                    <select name="id_trailer" class="form-control show-tick">
                                        <option value="">Seleccione el Trailer:</option>
                                        @foreach($trailers as $trailer)

                                        <option value="{{$trailer->id_trailer}}">{{$trailer->placaTrailer}}</option>

                                        @endforeach
                                    </select>
                                    @error('id_trailer')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div><br>
                               
                                <div><br>
                                    <select name="id_ruta" class="form-control show-tick">
                                        <option value="">Seleccione la Ruta:</option>
                                        @foreach($rutas as $ruta)

                                        <option value="{{$ruta->id_ruta}}">{{$ruta->descripcionRuta}}</option>

                                        @endforeach
                                    </select>
                                    @error('id_ruta')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div><br>

                                <div><br>
                                    <select name="id_empleado" class="form-control show-tick">
                                        <option value="">Seleccione el Empleado:</option>
                                        @foreach($empleados as $empleado)

                                        <option value="{{$empleado->id_empleado}}">{{$empleado->nombre}}</option>

                                        @endforeach
                                    </select>
                                    @error('id_empleado')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div><br>
                                
                                  
                                   
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">GUARDAR</button>
    </div>
</form>

<script>
    function sumar () {
        var gananciaNeta = 0;	
        var sumas = 0;	
      var  gananciaBruta = document.getElementById('gananciaBruta').value;
        console.log(gananciaBruta);
      var  diesel = document.getElementById('diesel').value;
       var peajes = document.getElementById('peajes').value;
       var pagoEmpleado = document.getElementById('pagoEmpleado').value;
    
        
    if(gananciaBruta == null || gananciaBruta == ""){
        gananciaNeta="";
    }else if(diesel == null || diesel == ""){
        gananciaNeta="";
    }else if(peajes == null || peajes == ""){
        gananciaNeta="";
    }else if(pagoEmpleado == null || pagoEmpleado == ""){
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

@endsection
