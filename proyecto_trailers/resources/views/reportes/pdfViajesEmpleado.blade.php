<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Reporte de Viajes</title>
    <style>
        body {
            font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace !important;
            letter-spacing: -0.3px;
            text-align: center;
        }

        .invoice-wrapper {
            width: 700px;
            margin: auto;
        }

        .nav-sidebar .nav-header:not(:first-of-type) {
            padding: 1.7rem 0rem .5rem;
        }

        .logo {
            font-size: 50px;
        }

        .sidebar-collapse .brand-link .brand-image {
            margin-top: -33px;
        }

        .content-wrapper {
            margin: auto !important;
        }

        .billing-company-image {
            width: 50px;
        }

        .billing_name {
            text-transform: uppercase;
        }

        .billing_address {
            text-transform: capitalize;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        th {
            text-align: center;
            padding: 10px;
        }

        td {
            padding: 10px;
            vertical-align: top;
        }

        .row {
            display: block;
            clear: both;
            text-align: center;
        }

        .text-left {
            text-align: left;
            padding-left: 100px;
        }

        .text-right {
            text-align: right;
            padding-left: 770px;
        }

        .table-hover thead tr {
            background: #eee;
            text-align: center;
        }

        .table-hover tbody tr:nth-child(even) {
            background: #fbf9f9;
            text-align: center;
        }

        .information {
            background-color: white;
            color: black;
        }

        .invoice-info {
            padding-left: 630px;
            font-size: 20px;
        }

        .table-hover {
            padding-left: 50px;
        }

        @page {
            size: 90pc;
            margin-right: 25cm;
        }

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
                            Teléfono: 6046-5364
                        </td>

                    </table>
                </div>
            </div>
            <br><br>
            <div class="row invoice-info">
                <div class="col-md-12">

                    @foreach ($nombre as $item)

                        <h4 style="display: inline;">REPORTE DE VIAJES DE {{ Str::upper($item->nombre) }}</h4><br><br>

                    @endforeach

                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Fecha y Hora de Llegada</th>

                                <th data-breakpoints="xs">Fecha y Hora de Salida</th>

                                <th>Hora de Descarga</th>

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
                                        <p class="c_name">{{ $item->fechaHoraLlegada }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->fechaHoraSalida }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->tiempoDescarga }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->peajes }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->diesel }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->gananciaBruta }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->pagoEmpleado }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->descripcionViaje }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->descripcionCarga }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->gananciaNeta }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->trailer->placaTrailer }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->ruta->descripcionRuta }}</p>
                                    </td>
                                    <td>
                                        <p class="c_name">{{ $item->empleado->nombre }}</p>
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
                    &copy; {{ date('Y') }} - Todos los derechos reservados.
                </td>
            </tr>

        </table>
    </div>

</body>

</html>
