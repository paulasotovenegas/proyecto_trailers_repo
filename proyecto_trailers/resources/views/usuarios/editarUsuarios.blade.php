@extends('navbar.navbar')
@section('content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">     
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio </a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ver Usuarios </a></li>
                    <li class="breadcrumb-item active">Editar Usuario</li>
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
                        <h2><strong>Editar Usuario</strong> </h2>                        
                    </div>
                    <div class="body">
                        @if (session('success'))

                        <div class="alert alert-success" role="alert">
                        ¡Se Editó Satisfactoriamente!
                        </div>
        
                        @endif
                            <form id="trailers" method="POST" action="{{route('usuario.update',$item->id)}}">
                                @csrf
                        <h2 class="card-inside-title">Información de los Usuarios</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <h2 class="card-inside-title">Email</h2>
                                <div class="form-group">                                    
                                    <input type="email" class="form-control date" placeholder="Email" readonly name="email" value="{{$item->email}}" />
                                    @error('email')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                              
                                <h2 class="card-inside-title">Nombre</h2>
                                <div class="form-group">                                    
                                    <input type="text" class="form-control date" placeholder="Nombre" name="name" value="{{$item->name}}" />
                                    @error('name')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                             
                                <div><br>
                                    <select name="id_rol" class="form-control show-tick">
                                        <option value="{{$item->id_rol}}">{{$item->rol->descripcionRol}}</option>
                                        @foreach($roles as $rol)

                                        <option value="{{$rol->id_rol}}">{{$rol->descripcionRol}}</option>

                                        @endforeach
                                    </select>
                                    @error('id_rol')
                                    <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div><br>                      
                                   
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">GUARDAR</button>
    </div>
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