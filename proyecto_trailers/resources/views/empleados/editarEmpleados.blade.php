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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ver Empleados </a></li>
                    <li class="breadcrumb-item active">Editar Empleado</li>
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
                        <h2><strong>Editar Empleado</strong> </h2>
                    </div>
                    <div class="body">
                        @if (session('success'))

                            <div class="alert alert-success" role="alert">
                                ¡Se Editó Satisfactoriamente!
                            </div>

                        @endif
                        <form id="empleados" method="POST" action="{{ route('empleados.update', $item->id_empleado) }}">
                            @csrf

                            <h2 class="card-inside-title">Información Personal</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Nombre" name="nombre"
                                            value="{{ $item->nombre }}" />
                                        @error('nombre')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Primer Apellido"
                                            name="apellido1" value="{{ $item->apellido1 }}" />
                                        @error('apellido1')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Segundo Apellido"
                                            name="apellido2" value="{{ $item->apellido2 }}" />
                                        @error('apellido2')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div><br>

                                        <select name="tipoLicencia" class="form-control show-tick">


                                            <option value="{{ $item->tipoLicencia }}">{{ $item->tipoLicencia }}</option>

                                         

                                            <option value="Licencia B4 (camión articulado)">Licencia B4 (Camión Articulado)
                                            </option>

                                        </select>
                                        @error('tipoLicencia')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>
                                    <div>
                                        <h6> Fecha de Vencimiento de Licencia</h6>
                                    </div><br>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>

                                        <input type="date" name="fechaVencimientoLicencia"
                                            value="{{ $item->fechaVencimientoLicencia }}" class="form-control date"
                                            placeholder="Fecha de Vencimiento de Licencia, eje: 30/07/2016">
                                        @error('fechaVencimientoLicencia')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror

                                    </div><br>
                                    <div>
                                        <h6> Fecha de Nacimiento</h6>
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i> </span>

                                        <input type="date" name="fechaNacimiento" class="form-control date"
                                            placeholder="Fecha de Nacimiento, eje: 30/07/2016"
                                            value="{{ $item->fechaNacimiento }}">
                                        @error('fechaNacimiento')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div><br>
                                        <select name="tipoCedula" class="form-control show-tick">
                                            <option value="{{ $item->tipoCedula }}">{{ $item->tipoCedula }}</option>
                                            <option value="Persona Física Nacional">Persona Física Nacional</option>
                                            <option value="Persona Física Residente">Persona Física Residente</option>
                                        </select>
                                        @error('tipoCedula')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>
                                    <h2 class="card-inside-title">Número de Cédula</h2>
                                    <div class="form-group">
                                        <input type="number" name="numeroCedula" class="form-control"
                                            placeholder="Número de Cédula" value="{{ $item->numeroCedula }}" />
                                        @error('numeroCedula')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>

                                    <div><br>
                                        <select id="provinciaSelect" name="provinciaSelect" class="form-control show-tick">
                                            <option value="{{ $item->provincia }}">{{ $item->provincia }}</option>
                                            @php $i = 1; @endphp
                                            @foreach ($respuestaProvincia as $provincia)
                                                <option value="{{ $i }}">{{ $provincia }}</option>
                                                @php $i = $i + 1; @endphp
                                            @endforeach
                                        </select>
                                        @error('provincia')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>
                                    <div><br>
                                        <select id="cantonSelect" name="cantonSelect" class="form-control show-tick">
                                            <option value="{{ $item->canton }}">{{ $item->canton }}</option>
                                        </select>
                                        @error('canton')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>
                                    <div><br>
                                        <select id="distritoSelect" name="distrito" class="form-control show-tick">
                                            <option value="{{ $item->distrito }}">{{ $item->distrito }}</option>
                                        </select>
                                        @error('distrito')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>

                                    <div class="form-group">
                                        <input type="text" name="otrasReferencias" value="{{ $item->otrasReferencias }}"
                                            class="form-control" placeholder="Otras Señas" />
                                        @error('otrasReferencias')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div><br>
                                        <select name="sexo" class="form-control show-tick">
                                            <option value="{{ $item->sexo }}">{{ $item->sexo }}</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Masculino</option>

                                        </select>
                                        @error('sexo')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-smartphone"></i></span>
                                        <input type="number" name="numeroTelefono" class="form-control mobile-phone-number"
                                            placeholder="Número de Teléfono" value="{{ $item->numeroTelefono }}">
                                        @error('numeroTelefono')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                                        <input type="text" name="email" class="form-control email"
                                            value="{{ $item->email }}" placeholder="Email, eje: ejemplo@ejemplo.com">
                                        @error('email')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="observaciones" value="{{ $item->observaciones }}"
                                            class="form-control" placeholder="Observaciones" />
                                        @error('observaciones')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                   
                                    <div><br>
                                        <select name="id_trailer" class="form-control show-tick">
                                            @if ($item->id_trailer != null)
                                                <option value="{{ $item->id_trailer }}">{{ $item->trailer->placaTrailer }}
                                                </option>
                                                @foreach ($trailers as $trailer)

                                                    <option value="{{ $trailer->id_trailer }}">
                                                        {{ $trailer->placaTrailer }}</option>

                                                @endforeach
                                            @else

                                                <option value="">Seleccione el Trailer Encargado:</option>
                                                @foreach ($trailers as $trailer)

                                                    <option value="{{ $trailer->id_trailer }}">
                                                        {{ $trailer->placaTrailer }}</option>

                                                @endforeach
                                            @endif
                                        </select>
                                        @error('id_trailer')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div><br>

                                    <input type="hidden" id="provincia" name="provincia">
                                    <input type="hidden" id="canton" name="canton">

                                    <button type="submit"
                                        class="btn btn-raised btn-primary btn-round waves-effect">GUARDAR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Jquery Core Js -->
                    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
                    <!-- Lib Scripts Plugin Js -->
                    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
                    <!-- Lib Scripts Plugin Js -->

                    <script src="assets/plugins/momentjs/moment.js')}}"></script>
                    <!-- Moment Plugin Js -->
                    <!-- Bootstrap Material Datetime Picker Plugin Js -->
                    <script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
                    </script>

                    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
                    <!-- Custom Js -->
                    <script src="{{ asset('assets/js/pages/forms/basic-form-elements.js') }}"></script>

                    <script>
                        var provinciaSelect = document.querySelector("#provinciaSelect");
                        var cantonSelect = document.querySelector("#cantonSelect");
                        var distritoSelect = document.querySelector("#distritoSelect");

                        provinciaSelect.addEventListener("input", () => {
                            var form = document.getElementById("empleados");
                            var opt = provinciaSelect.options[provinciaSelect.selectedIndex];

                            console.log(form);
                            fd = new FormData(form);

                            console.log(fd);
                            fetch('/provincia/select', {
                                    method: "POST",
                                    body: fd
                                })
                                .then(response => response.json())
                                .then(response => {
                                    let html = "<option>Seleccione su Cantón</option>";
                                    var cantonSelect = document.querySelector("#cantonSelect");

                                    for (key in response) {

                                        html += `<option value="${key}">${response[key]}</option>`;
                                    }
                                    document.querySelector("#provincia").value = opt.text;
                                    cantonSelect.innerHTML = html;
                                })
                        });

                        cantonSelect.addEventListener("input", () => {
                            var form = document.getElementById("empleados");
                            var opt = cantonSelect.options[cantonSelect.selectedIndex];

                            console.table(form);
                            fd = new FormData(form);

                            console.log(fd);
                            fetch('/canton/select/api', {
                                    method: "POST",
                                    body: fd
                                })
                                .then(response => response.json())
                                .then(response => {
                                    console.log(response);
                                    let html = "<option>Seleccione su Distrito</option>";
                                    var distritoSelect = document.querySelector("#distritoSelect");

                                    for (key in response) {
                                        html += `<option value="${response[key]}">${response[key]}</option>`;
                                    }
                                    document.querySelector("#canton").value = opt.text;
                                    distritoSelect.innerHTML = html;
                                })
                        });
                    </script>

                    <script>
                        var today = new Date().toISOString().split('T')[0];
                        document.getElementsByName("fechaVencimientoLicencia")[0].setAttribute('min', today);
                    </script>
                @endsection
