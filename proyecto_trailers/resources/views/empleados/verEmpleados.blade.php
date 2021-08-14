@extends('navbar.navbar')
@section('content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Ver Empleados

                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ route('navbar') }}"><i class="zmdi zmdi-home"></i> Inicio </a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ver Empleado</a></li>
                    <li class="breadcrumb-item active">Empleados</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card action_bar">
                    <div class="body">
                    
                        <div class="row clearfix">
                            @if(Auth::user()->id_rol == 1)
                            <div class="col-lg-1 col-md-2 col-2" style="text-align: right">
                          
                                <a href="{{ route('ingresarEmpleados') }}" type="button"
                                    class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round hidden-sm-down">
                                    <i class="zmdi zmdi-plus-circle"></i>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-1 col-2" style="text-align: left">
                                <p> Nuevo Empleado
                                </p>
                            </div>
                           
                            <div class="col-lg-5 col-md-5 col-6">
                                <form id="buscarForm" method="post">
                                    <div class="input-group search">
                                        @csrf
                                        <input id="buscar" type="text" name="buscar" class="form-control"
                                            placeholder="Ingrese la Cédula a Buscar">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-search"></i>
                                        </span>
                                    </div>
                                </form>
                            </div>
                           
                            <div class="col-lg-2 col-md-1 col-2" style="text-align: left">
                                <a class="btn btn-raised btn-primary btn-round waves-effect"
                                    href="{{ route('reporteEmpleadosLicencia') }}">Ver Empleados con Licencia Próxima a
                                    Vencer</a>
                            </div>
                            @endif
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body table-responsive">
                        <table class="table table-hover m-b-0 c_list">
                            <thead>
                                <tr>

                                    <th>Cédula</th>
                                    <th>Nombre</th>
                                    <th data-breakpoints="xs">Primer Apellido</th>
                                    <th data-breakpoints="xs">Segundo Apellido</th>
                                    <th data-breakpoints="xs sm md">Número de Teléfono</th>
                                    <th data-breakpoints="xs sm md">Dirección</th>
                                    <th data-breakpoints="xs">Trailer Encargado</th>
                                    <th data-breakpoints="xs"> </th>
                                    @if(Auth::user()->id_rol == 1)
                                        <th data-breakpoints="xs">Acciones</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <p class="c_name">{{ $item->numeroCedula }} </p>
                                        </td>
                                        <td>

                                            <p class="c_name">{{ $item->nombre }} </p>
                                        </td>
                                        <td>
                                            <p class="c_name">{{ $item->apellido1 }}</p>
                                        </td>
                                        <td>
                                            <p class="c_name">{{ $item->apellido2 }}</p>
                                        </td>

                                        <td>
                                            <p class="c_name">{{ $item->numeroTelefono }}</p>
                                        </td>

                                        <td>
                                            <p class="c_name">{{ $item->provincia }}, {{ $item->canton }},
                                                {{ $item->distrito }} </p>
                                        </td>
                                        <td>
                                            @if ($item->id_trailer == null)
                                                <p name="placaEmpleado" class="c_name">{{ '' }}</p>
                                            @else


                                                <p name="placaEmpleado" class="c_name">{{ $item->trailer->placaTrailer }}
                                                </p>

                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-raised btn-primary btn-round waves-effect"
                                                href="{{ route('empleado.viajes', $item->id_empleado) }}">Ver Viajes</a>
                                        </td>
                                        @if(Auth::user()->id_rol == 1)
                                        <td>
                                            <a class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round"
                                                href="{{ route('empleado.edit', $item->id_empleado) }}"><i
                                                    class="zmdi zmdi-edit"></i></a>
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                            <a data-id="{{ $item->id_empleado }}"
                                                onclick="deleteConfirmation({{ $item->id_empleado }})"
                                                data-action="{{ route('empleados.destroy', $item->id_empleado) }}"
                                                class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round"><span
                                                    class="zmdi zmdi-delete" aria-hidden="true"></span></a>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="pagination pagination-primary m-b-0">
                        {{ $data->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>

    <script type="text/javascript">
        function deleteConfirmation(id) {
            swal({
                title: "¿Seguro que Desea Eliminar?",

                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: '#ab1212',
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/empleados/delete') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {

                            if (results.success === true) {
                                swal("Eliminado", results.message, "success");
                            } else {
                                swal("Error al Eliminar", results.message, "error");
                            }
                        }
                    });

                    window.setTimeout(function() {}, 2000);
                    location.reload();


                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
    </script>


    <script>
        var buscar = document.querySelector("#buscar");

        buscar.addEventListener('input', () => {
            let fd = new FormData(document.querySelector("#buscarForm"));

            fetch('/empleados/verEmpleados', {
                    method: 'POST',
                    body: fd
                }).then(res => res.json())
                .then(res => {
                    var html = "";
                    var tbody = document.querySelector("#tbody");
                    var x = 0;
                    console.log(res[0]["C"]);

                    for (var i in res) {


                        if (res[i]["apellido2"] == null) {
                            res[i]["apellido2"] = "";
                        }

                        if (res[i]["placaTrailer"] == null) {
                            res[i]["placaTrailer"] = "";
                        }

                        if (res[i]["numeroTelefono"] == null) {
                            res[i]["numeroTelefono"] = "";
                        }


                        x = res[i]["id_empleado"];
                        html += `<tr>
               
                    <td>
                        
                        <p class="c_name">${res[i]["cedula"]} </p>
                    </td>
                    <td>
                        
                        <p class="c_name">${res[i]["nombre"]}</p>
                    </td>
                    <td>
                        <p class="c_name">${res[i]["apellido1"]}</p>
                    </td>
                    <td>
                        <p class="c_name">${res[i]["apellido2"]}</p>
                    </td>
                   
                    <td>
                        <p class="c_name">${res[i]["numeroTelefono"]}</p>
                    </td>    
                   
                    <td>
                        <p class="c_name">${res[i]["direccion"]} </p>
                    </td>
                    <td>
                        <p class="c_name">${res[i]["placaTrailer"]}</p>
                    </td>`;


                        html += "<td>" +
                              "<a class='btn btn-raised btn-primary btn-round waves-effect' href=" +
                            "/viajes/viajesEmpleado/" + x + ">Ver Viajes</a>" +
                            "</td>" + "<td>" +
                            "<a class='btn btn-default btn-icon btn-simple btn-icon-mini btn-round' href=" +
                            "/empleados/edit/" + x + "><i class='zmdi zmdi-edit'></i></a>" +
                            "<meta name='csrf-token' content='{{ csrf_token() }}'> " +
                            "<a  data-id=" + x + " onclick='" + "deleteConfirmation(" + x + ")'" +
                            "data-action='/empleados/delete/" + x + "'" +
                            "class='btn btn-default btn-icon btn-simple btn-icon-mini btn-round'><span class='zmdi zmdi-delete' aria-hidden='true'></span></a></td></tr>";
                    }
                    tbody.innerHTML = html;

                });
        });
    </script>

@endsection
