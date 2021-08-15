@extends('navbar.navbar')
@section('content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Ver Viajes
                   
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ route('navbar') }}"><i class="zmdi zmdi-home"></i> Inicio </a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ver Viajes</a></li>
                    <li class="breadcrumb-item active">Viajes</li>
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
                            <div class="col-lg-1 col-md-2 col-2" style="text-align: right">
                                @if (Auth::user()->id_rol == 1)
                                    <a href="{{ route('viajes.create') }}" type="button"
                                        class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round hidden-sm-down">
                                        <i class="zmdi zmdi-plus-circle"></i>
                                    </a>
                            </div>
                            <div class="col-lg-2 col-md-1 col-2" style="text-align: left">
                                <p> Nuevo Viaje
                                </p>
                            </div>
                            <div class="col-lg-5 col-md-5 col-6">
                                <form id="buscarForm" method="post">
                                    <div class="input-group search">
                                        @csrf
                                        <input id="buscar" type="text" name="buscar" class="form-control"
                                            placeholder="Ingrese la Descripción a Buscar">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-search"></i>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
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
                                    <th>Fecha y Hora de Salida</th>
                                    <th>Fecha y Hora de Llegada</th>
                                    <th>Hora de Descarga</th>
                                    <th>Peajes</th>
                                    <th>Diesel</th>
                                    <th>Ganancia Bruta</th>
                                    <th>Pago del Empleado</th>
                                    <th>Descripción de Viaje</th>
                                    <th>Descripción de Carga</th>
                                    <th>Ganancia Neta</th>
                                    <th>Trailer Encargado</th>
                                    <th>Ruta</th>
                                    <th>Empleado</th>
                                    @if (Auth::user()->id_rol == 1)
                                        <th data-breakpoints="xs">Acciones</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($data as $item)
                                    <tr>
                                        <td>

                                            <p class="c_name">{{ $item->fechaHoraSalida }} </p>
                                        </td>
                                        <td>
                                            <p class="c_name">{{ $item->fechaHoraLlegada }} </p>
                                        </td>

                                        <td>
                                            <p class="c_name">{{ $item->tiempoDescarga }}</p>
                                        </td>
                                        <td>
                                            <p class="c_name">₡{{ number_format($item->peajes, 2) }}</p>
                                        </td>

                                        <td>
                                            <p class="c_name">₡{{ number_format($item->diesel, 2) }}</p>
                                        </td>
                                        <td>
                                            <p class="c_name">₡{{ number_format($item->gananciaBruta, 2) }}</p>
                                        </td>
                                        <td>
                                            <p class="c_name">₡{{ number_format($item->pagoEmpleado, 2) }}</p>
                                        </td>
                                        <td>
                                            <p class="c_name">{{ $item->descripcionViaje }}</p>
                                        </td>
                                        <td>
                                            <p class="c_name">{{ $item->descripcionCarga }}</p>
                                        </td>
                                        <td>
                                            <p class="c_name">₡{{ number_format($item->gananciaNeta, 2) }}</p>
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
                                            @if ($item->id_ruta == null)
                                                <p class="c_name">{{ '' }}</p>
                                            @else


                                                <p class="c_name">{{ $item->ruta->descripcionRuta }}</p>

                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->id_empleado == null)
                                                <p class="c_name">{{ '' }}</p>
                                            @else


                                                <p class="c_name">{{ $item->empleado->nombre }}</p>

                                            @endif
                                        </td>

                                        @if (Auth::user()->id_rol == 1)
                                        <td>
                                            <a class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round"
                                                href="{{ route('viajes.edit', $item->id_viaje) }}"><i
                                                    class="zmdi zmdi-edit"></i></a>
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                            <a data-id="{{ $item->id_viaje }}"
                                                onclick="deleteConfirmation({{ $item->id_viaje }})"
                                                data-action="{{ route('viaje.destroy', $item->id_viaje) }}"
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
                        url: "{{ url('/viajes/delete') }}/" + id,
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

            fetch('/viajes/verViajes', {
                    method: 'POST',
                    body: fd
                }).then(res => res.json())
                .then(res => {
                    var html = "";
                    var tbody = document.querySelector("#tbody");

                    for (var i in res) {


                        if (res[i]["fechaHoraSalida"] == null) {
                            res[i]["fechaHoraSalida"] = "";
                        }

                        if (res[i]["tiempoDescarga"] == null) {
                            res[i]["tiempoDescarga"] = "";
                        }

                        if (res[i]["peajes"] == null) {
                            res[i]["peajes"] = "";
                        }

                        if (res[i]["diesel"] == null) {
                            res[i]["diesel"] = "";
                        }

                        if (res[i]["pagoEmpleado"] == null) {
                            res[i]["pagoEmpleado"] = "";
                        }

                        if (res[i]["gananciaNeta"] == null) {
                            res[i]["gananciaNeta"] = "";
                        }

                



                        x = res[i]["id_viaje"];
                        html += `<tr>
                <td>
                            <p class="c_name">${res[i]["fechaHoraLlegada"]} </p>
                        </td>
                        <td>
                            <p class="c_name">${res[i]["fechaHoraSalida"]} </p>
                        </td>
                        <td>
                            <p class="c_name">${res[i]["tiempoDescarga"]} </p>
                        </td>
                        <td>
                            <p class="c_name">₡${res[i]["peajes"]} </p>
                        </td>
                        <td>
                            <p class="c_name">₡${res[i]["diesel"]} </p>
                        </td>
                        <td>
                            <p class="c_name">₡${res[i]["gananciaBruta"]} </p>
                        </td>
                        <td>
                            <p class="c_name">₡${res[i]["pagoEmpleado"]} </p>
                        </td>
                        <td>
                            <p class="c_name">${res[i]["descripcionViaje"]} </p>
                        </td>
                        <td>
                            <p class="c_name">${res[i]["descripcionCarga"]} </p>
                        </td>
                        <td>
                            <p class="c_name">₡${res[i]["gananciaNeta"]} </p>
                        </td>
                        <td>
                            <p class="c_name">${res[i]["id_trailer"]} </p>
                        </td>
                        <td>
                            <p class="c_name">${res[i]["id_ruta"]} </p>
                        </td>
                    <td>
                            <p class="c_name">${res[i]["id_empleado"]} </p>
                        </td>`;

                        html += "<td>" +
                            "<a class='btn btn-default btn-icon btn-simple btn-icon-mini btn-round' href=" +
                            "/viajes/edit/" + x + "><i class='zmdi zmdi-edit'></i></a>" +
                            "<meta name='csrf-token' content='{{ csrf_token() }}'> " +
                            "<a  data-id=" + x + " onclick='" + "deleteConfirmation(" + x + ")'" +
                            "data-action='/viajes/delete/" + x + "'" +
                            "class='btn btn-default btn-icon btn-simple btn-icon-mini btn-round'><span class='zmdi zmdi-delete' aria-hidden='true'></span></a></td></tr>";
                    }
                    tbody.innerHTML = html;

                });
        });
    </script>

@endsection
