@extends('navbar.navbar')
@section('content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Reporte de Rutas
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);"> Ver Rutas</a></li>
                    <li class="breadcrumb-item active">Reporte de Rutas</li>
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
                     
                        <h2><strong>Reporte de Rutas</strong> </h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('imprimirRutas')}}">Generar PDF</a></li>
                                    <li><a href="{{route('excelRutas') }}">Generar Excel</a></li>

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
                                    <th>Código Ruta</th>
                                    <th data-breakpoints="xs">Descripción Ruta</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach($data as $item)
                            <tr>
                                <td>
                                    <p class="c_name">{{$item->id_ruta}}</p>
                                </td>
                                <td>
                                    <p class="c_name">{{$item->descripcionRuta}}</p>
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