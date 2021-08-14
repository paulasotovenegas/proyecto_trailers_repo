@extends('navbar.navbar')
@section('content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Reporte de Viajes
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ route('navbar') }}"><i class="zmdi zmdi-home"></i> Inicio</a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);"> Ver Reportes</a></li>
                    <li class="breadcrumb-item active">Reporte de Viajes</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                    
                        <h2><strong>Reporte de Viajes</strong> </h2>
                        <br>
                        <form id="viajes" method="POST" action="{{ route('viajes.fecha') }}">
                            @csrf
                            <label style="font-weight: normal;">Desde: <input class="form-control" type="date"
                                    name="bd_desde" /></label>
                            <label style="font-weight: normal;">Hasta: <input class="form-control" type="date"
                                    name="bd_hasta" /></label>
                            <button type="submit" class="btn-sm btn-primary">Buscar</button>
                        </form>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                    data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i
                                        class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ route('imprimirViajes') }}">Generar PDF</a></li>
                                    <li><a href="{{ route('excelViajes') }}">Generar Excel</a></li>
                                </ul>
                            </li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-striped m-b-0">
                            <thead>
                                <tr>

                                    <th data-breakpoints="xs">Fecha y Hora de Salida</th>
                                    <th>Fecha y Hora de Llegada</th>
                                    <th>Tiempo de Descarga</th>
                                    <th>Peajes</th>
                                    <th>Diesel</th>
                                    <th>Ganancia Bruta</th>
                                    <th>Pago de Empleado</th>
                                    <th>Descripcion del Viaje</th>
                                    <th>Descripcion de la Carga</th>
                                    <th>Ganancia Neta</th>
                                    <th>Trailer Encargado</th>
                                    <th>Ruta</th>
                                    <th>Empleado</th>
                                </tr>
                            </thead>
                            <tbody>
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


@endsection
