@extends('navbar.navbar')
@section('content')

    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Bitácora de Acciones
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);"> Ver Bitácora</a></li>
                    <li class="breadcrumb-item active">Bitácora de Acciones</li>
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
                        <h2><strong>Bitácora de Acciones</strong> </h2>
                        <br>
                       
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('imprimirBitacora')}}">Generar PDF</a></li>
                                    <li><a href="{{ route('excelBitacora') }}">Generar Excel</a></li>

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
                                    <th>Acción</th>
                                    <th data-breakpoints="xs">Usuario</th>
                                    <th data-breakpoints="xs">Fecha </th>
                             

                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach($data as $item)
                            <tr>
                                <td>
                                    <p class="c_name">{{$item->accion}}</p>
                                </td>
                                <td>
                                    <p class="c_name">{{$item->usuario}}</p>
                                </td>
                                <td>
                                    <p class="c_name">{{$item->fecha}}</p>
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
