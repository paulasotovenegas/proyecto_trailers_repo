<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Reporte de Trailers</title>
    <style>
        body{
            font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace !important;
            letter-spacing: -0.3px;
        }
        .invoice-wrapper{ width: 700px; margin: auto; }
        .nav-sidebar .nav-header:not(:first-of-type){ padding: 1.7rem 0rem .5rem; }
        .logo{ font-size: 50px; }
        .sidebar-collapse .brand-link .brand-image{ margin-top: -33px; }
        .content-wrapper{ margin: auto !important; }
        .billing-company-image { width: 50px; }
        .billing_name { text-transform: uppercase; }
        .billing_address { text-transform: capitalize; }
        .table{ width: 100%; border-collapse: collapse; text-align: center;}
        th{ text-align: center; padding: 10px; }
        td{ padding: 10px; vertical-align: top; }
        .row{ display: block; clear: both; }
        .text-left{ text-align: left; }
        .text-right{text-align: right; }
        .table-hover thead tr{ background: #eee; }
        .table-hover tbody tr:nth-child(even){ background: #fbf9f9; }
        .information { background-color: white; color: black; }
    </style>
</head>
<body>
    <div class="row invoice-wrapper">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        
                            <td class="text-left">
                              <img src="assets/images/zumbadoLogo.jpg" width="200"><span class="m-l-10"></span></a>
                            </td>
                        
                            <td class="text-right">
                            <strong>Fecha: {{ date('d/m/Y') }}</strong><br>
                              Encargado: Walter Zumbado<br>
                              Email: walter@zumbado.com<br>
                              Tel??fono: 6046-5364
                            </td>

                    </table>
                </div>
            </div>
            <br><br>
            <div class="row invoice-info">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="">
                                        <strong>REPORTE DE TRAILERS</strong><br><br>
                                        
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                          <tr>
                            <th>Placa Tr??iler</th>
                                    <th data-breakpoints="xs">Tarjeta Pesos y Dimensiones</th>
                                    <th data-breakpoints="xs">Riteve</th>
                                    <th data-breakpoints="xs">Marchamo</th>
                                    <th data-breakpoints="xs">Tarjeta Transporte Peligroso</th>
                                    <th>C??digo Transportista</th>
                         
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $item)
                          <tr>
    
                            <td>
                                <p class="c_name">{{$item->placaTrailer}} </p>
                            </td>
                            <td>
                             
                                <p class="c_name">{{$item->tarjetaPesosDimensiones}} </p>
                            </td>
                            <td>
                                <p class="c_name">{{$item->marchamo}}</p>
                            </td>
                            <td>
                                <p class="c_name">{{$item->riteve}}</p>
                            </td>
                            
                            <td>
                                <p class="c_name">{{$item->tarjetaTransportePeligroso}}</p>
                            </td>    
                            <td>
                                <p class="c_name">{{$item->codigoTransportista}}</p>
                            </td>
                          
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <br><br><br>
        </div>
    </div> 
    <div class="information" style="position: absolute; bottom: 0;">
      <table width="100%">
          <tr>
              <td align="center" style="width: 50%;">
                  &copy; {{ date('Y') }}  - Todos los derechos reservados.
              </td>
          </tr>
  
      </table>
  </div>
</body>
</html>