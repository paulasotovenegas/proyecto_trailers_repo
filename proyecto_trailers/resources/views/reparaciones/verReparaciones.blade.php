@extends('navbar.navbar')
@section('content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Ver Reparaciones

                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ route('navbar') }}"><i class="zmdi zmdi-home"></i> Inicio </a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ver Reparaciones</a></li>
                    <li class="breadcrumb-item active">Reparaciones</li>
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
                            @if(Auth::user()->id_rol == 1)
                                <a href="{{ route('ingresarReparaciones') }}" type="button"
                                    class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round hidden-sm-down">
                                    <i class="zmdi zmdi-plus-circle"></i>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-1 col-2" style="text-align: left">
                                <p> Nueva Reparación
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

                                    <th>Placa Tráiler</th>

                                    <th>Descripción</th>
                                    <th>Fecha Reparación</th>
                                    <th>Fecha Daño</th>
                                    <th>Observaciones</th>
                                    <th>Costo</th>
                                    <th>Duración</th>
                                    @if(Auth::user()->id_rol == 1)
                                        <th data-breakpoints="xs">Acciones</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            @if ($item->id_trailer == null)
                                                <p name="placaEmpleado" class="c_name">{{ '' }}</p>
                                            @else


                                                <p name="placaEmpleado" class="c_name">{{ $item->trailer->placaTrailer }}
                                                </p>

                                            @endif
                                        </td>

                                        <td>
                                            <p class="c_name">{{ $item->descripcionReparacion }} </p>
                                        </td>
                                        <td>
                                            <p class="c_name">{{ $item->fechaReparacion}} </p>
                                        </td>
                                        <td>
                                            <p class="c_name">{{ $item->fechaDano }} </p>
                                        </td>
                                        <td>
                                            <p class="c_name">{{ $item->observaciones }} </p>
                                        </td>
                                        <td>
                                            <p class="c_name">₡{{ number_format($item->costo, 2) }} </p>
                                        </td>
                                        <td>
                                            <p class="c_name">{{ $item->duracion }} </p>
                                        </td>
                                        @if (Auth::user()->id_rol == 1)
                                        <td>
                                            <a class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round"
                                                href="{{ route('reparaciones.edit', $item->id_reparacion) }}"><i
                                                    class="zmdi zmdi-edit"></i></a>
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                            <a data-id="{{ $item->id_reparacion }}"
                                                onclick="deleteConfirmation({{ $item->id_reparacion }})"
                                                data-action="{{ route('reparaciones.destroy', $item->id_reparacion) }}"
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
                        url: "{{ url('reparaciones/delete') }}/" + id,
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

            fetch('/reparaciones/verReparaciones', {
                    method: 'POST',
                    body: fd
                }).then(res => res.json())
                .then(res => {
                    var html = "";
                    var tbody = document.querySelector("#tbody");
                    var x = 0;
                    console.log(res[0]["C"]);

                    for (var i in res) {



                        if (res[i]["id_trailer"] == null) {
                            res[i]["id_trailer"] = "";
                        }

                        if (res[i]["observaciones"] == null) {
                            res[i]["observaciones"] = "";
                        }

                        if (res[i]["duracion"] == null) {
                            res[i]["duracion"] = "";
                        }

                        if (res[i]["fechaDano"] == null) {
                            res[i]["fechaDano"] = "";
                        }

                        if (res[i]["costo"] == null) {
                            res[i]["costo"] = "";
                        }

                        x = res[i]["id_reparacion"];
                        html += `<tr>
                     

                         <td>
                            <p class="c_name">${res[i]["id_trailer"]}</p>
                        </td>

                        <td>
                            
                            <p class="c_name">${res[i]["descripcionReparacion"]} </p>
                        </td>
                        <td>
                            
                            <p class="c_name">${res[i]["fechaReparacion"]}</p>
                        </td>
                        <td>
                            
                            <p class="c_name">${res[i]["fechaDano"]}</p>
                        </td>
                        <td>
                            <p class="c_name">${res[i]["observaciones"]}</p>
                        </td>
                        <td>
                            <p class="c_name">${res[i]["costo"]}</p>
                        </td>
                       
                        <td>
                            <p class="c_name">${res[i]["duracion"]}</p>
                        </td>`;

                        html += "<td>" +
                            "<a class='btn btn-default btn-icon btn-simple btn-icon-mini btn-round' href=" +
                            "/reparaciones/edit/" + x + "><i class='zmdi zmdi-edit'></i></a>" +
                            "<meta name='csrf-token' content='{{ csrf_token() }}'> " +
                            "<a  data-id=" + x + " onclick='" + "deleteConfirmation(" + x + ")'" +
                            "data-action='/reparaciones/delete/" + x + "'" +
                            "class='btn btn-default btn-icon btn-simple btn-icon-mini btn-round'><span class='zmdi zmdi-delete' aria-hidden='true'></span></a></td></tr>";
                    }
                    tbody.innerHTML = html;

                });
        });
    </script>


@endsection
