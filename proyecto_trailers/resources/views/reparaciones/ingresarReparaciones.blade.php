@extends('navbar.navbar')
@section('content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ route('navbar') }}"><i class="zmdi zmdi-home"></i> Inicio </a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ingresar Reparaciones </a></li>
                    <li class="breadcrumb-item active">Reparaciones</li>
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
                        <h2><strong>Ingresar Reparaciones</strong> </h2>
                    </div>
                    <div class="body">
                        @if (session('success'))

                            <div class="alert alert-success" role="alert">
                                ¡Se Agregó Satisfactoriamente!
                            </div>

                        @endif
                        <form id="reparaciones" method="POST" action="{{ route('reparaciones.store') }}">
                            @csrf
                            <h2 class="card-inside-title">Información de las Reparaciones</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div><br>
                                        <select name="id_trailer" class="form-control show-tick">
                                            <option value="">Seleccione el Trailer:</option>
                                            @foreach ($trailers as $trailer)

                                                <option value="{{ $trailer->id_trailer }}">{{ $trailer->placaTrailer }}
                                                </option>

                                            @endforeach
                                        </select>
                                        @error('id_trailer')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>

                                    <h2 class="card-inside-title">Descripción de la Reparación</h2>

                                    <div class="form-group">
                                        <input type="text" name="descripcionReparacion" class="form-control"
                                            placeholder="Descripción de la Reparación"
                                            value="{{ old('descripcionReparacion') }}" />
                                        @error('descripcionReparacion')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>
                                    <div>
                                        <h2 class="card-inside-title">Fecha de Reparación</h2>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>

                                        <input type="date" onchange="calcular()" name="fechaReparacion" id="fechaReparacion"
                                            class="form-control date" placeholder="Fecha de Reparación, eje: 30/07/2016">
                                        @error('fechaReparacion')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>
                                    <div>
                                        <h2 class="card-inside-title">Fecha de Daño</h2>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>

                                        <input type="date" onchange="calcular()" name="fechaDano" id="fechaDano"
                                            class="form-control date" placeholder="Fecha de Daño, eje: 30/07/2016">
                                        @error('fechaDano')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>
                                    <div>
                                        <h2 class="card-inside-title">Observaciones</h2>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="observaciones" class="form-control"
                                            placeholder="Observaciones" value="{{ old('observaciones') }}" />
                                        @error('observaciones')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>
                                    <div>
                                        <h2 class="card-inside-title">Costo</h2>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i>₡</i></span>
                                        <input type="number" class="form-control" name="costo"
                                            placeholder="Costo ,eje:  ₡100.000" value="₡{{ old('costo') }}">
                                        @error('costo')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>
                                    <div>
                                        <h2 class="card-inside-title">Duración</h2>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="duracion" id="duracion" class="form-control"
                                            placeholder="Duración" readonly />
                                        @error('duracion')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>

                                    <button type="submit"
                                        class="btn btn-raised btn-primary btn-round waves-effect">GUARDAR</button>
                                </div>
                        </form>

                        <script>
                            var date_diff_indays = function(date1, date2) {
                                dt1 = new Date(date1);
                                dt2 = new Date(date2);
                                return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(),
                                    dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24));
                            }

                            function calcular() {
                                var duracion = "";
                                var fechaReparacion = document.getElementById('fechaReparacion').value;
                                var fechaDano = document.getElementById('fechaDano').value;



                                if ((fechaReparacion != null && fechaDano != null) || (fechaReparacion != "" && fechaDano != "")) {
                                    console.log(date_diff_indays(fechaReparacion, fechaDano));
                                    duracion = (date_diff_indays(fechaReparacion, fechaDano)) + " Días";
                                    document.getElementById('duracion').value = duracion;
                                } else {
                                    duracion = "";
                                }

                            }
                        </script>


                        <!-- Jquery Core Js -->
                        <script src="assets/bundles/libscripts.bundle.js"></script>
                        <!-- Lib Scripts Plugin Js -->
                        <script src="assets/bundles/vendorscripts.bundle.js"></script>
                        <!-- Lib Scripts Plugin Js -->

                        <script src="assets/plugins/momentjs/moment.js"></script>
                        <!-- Moment Plugin Js -->
                        <!-- Bootstrap Material Datetime Picker Plugin Js -->
                        <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

                        <script src="assets/bundles/mainscripts.bundle.js"></script>
                        <!-- Custom Js -->
                        <script src="assets/js/pages/forms/basic-form-elements.js"></script>

                    @endsection
