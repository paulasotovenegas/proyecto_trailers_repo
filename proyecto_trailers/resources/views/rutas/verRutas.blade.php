
@extends('navbar.navbar')
@section('content')

 


    <div class="block-header">
        
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Ver Rutas
                
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio </a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Ver Rutas</a></li>
                    <li class="breadcrumb-item active">Rutas</li>
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
                                <a href="{{route('ingresarRutas')}}" type="button" class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round hidden-sm-down">
                                    <i class="zmdi zmdi-plus-circle"></i>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-1 col-2" style="text-align: left">
                                <p> Nueva Ruta
                                </p>
                            </div>
                            <div class="col-lg-5 col-md-5 col-6">
                                <form id="buscarForm" method="post">
                                <div class="input-group search">
                                    @csrf
                                    <input id="buscar" type="text" name="buscar"  class="form-control" placeholder="Ingrese la Ruta a Buscar">
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
                                    <th data-breakpoints="xs">Descripción de la Ruta</th>
                                    @if(Auth::user()->id_rol == 1)
                                        <th data-breakpoints="xs">Acciones</th>
                                    @endif
                                </tr>
                            </thead>
                                <tbody id="tbody">
                                    @foreach($data as $item)
                                <tr>
                                    
                                    <td>
                                        <p class="c_name">{{$item->descripcionRuta}}</p>
                                    </td>
                                    @if (Auth::user()->id_rol == 1)
                                    <td>
                                        <a class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round" href="{{route('ruta.edit', $item->id_ruta)}}"><i class="zmdi zmdi-edit"></i></a>
                                       <meta name="csrf-token" content="{{ csrf_token() }}"> 
                                        <a  data-id="{{ $item->id_ruta }}" onclick="deleteConfirmation({{$item->id_ruta}})" data-action="{{route('rutas.destroy', $item->id_ruta)}}" class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round"><span class="zmdi zmdi-delete" aria-hidden="true"></span></a>
                                        
                                      
                                    
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
            }).then(function (e) {
    
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
                    $.ajax({
                        type: 'POST',
                        url: "{{url('/rutas/delete')}}/" + id,
                        data: {_token: CSRF_TOKEN},
                        dataType: 'JSON',
                        success: function (results) {
    
                            if (results.success === true) {
                                swal("Eliminado", results.message, "success");
                            } else {
                                swal("Error al Eliminar", results.message, "error");
                            }
                        }
                    });

                    window.setTimeout(function(){ } ,2000);
                    location.reload();

    
                } else {
                    e.dismiss;
                }
    
            }, function (dismiss) {
                return false;
            })
        }
    </script>


   
      
    <script>
        var buscar = document.querySelector("#buscar");
    
        buscar.addEventListener('input', () => {
            let fd = new FormData( document.querySelector("#buscarForm"));
   
            fetch('/rutas/verRutas', {
                method: 'POST',
                body: fd
            }).then(res => res.json())
            .then(res => {
                var html = "";
                var tbody = document.querySelector("#tbody");
    
                for(var i in res["data"]){
                    x = res["data"][i]["id_ruta"];
                html += `<tr>
               
                    <td>
                            <p class="c_name">${res["data"][i]["descripcionRuta"]} </p>
                        </td>`;

                        html += "<td>" +
                            "<a class='btn btn-default btn-icon btn-simple btn-icon-mini btn-round' href=" +
                            "/rutas/edit/" + x + "><i class='zmdi zmdi-edit'></i></a>" +
                            "<meta name='csrf-token' content='{{ csrf_token() }}'> " +
                            "<a  data-id=" + x + " onclick='" + "deleteConfirmation(" + x + ")'" +
                            "data-action='/rutas/delete/" + x + "'" +
                            "class='btn btn-default btn-icon btn-simple btn-icon-mini btn-round'><span class='zmdi zmdi-delete' aria-hidden='true'></span></a></td></tr>";
                    }
                    tbody.innerHTML = html;
    
            });
        });
    
    </script>



@endsection
