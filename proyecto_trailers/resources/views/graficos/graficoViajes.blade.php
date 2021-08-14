@extends('navbar.navbar')
@section('content')

<div class="block-header">
    <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
            <h2>Gráfica de Viajes

            </h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio </a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Ver Gráficas</a></li>
                <li class="breadcrumb-item active">Gráfica de Viajes</li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">

                <div class="card">
                    <div class="body">
                        <html>

                        <head>
                        </head>

                        <body>

                           
                                
                            <div class="col-lg-5 col-md-5 col-6">
                                <label style="font-weight: normal;">Desde: <input type="date" id="dateStart" type="text" name="buscar" class="form-control"></label>
                                <label style="font-weight: normal;">Hasta:  <input type="date" id="dateEnd" type="text" name="buscar" class="form-control"></label>
                            <button class="btn-sm btn-primary" id="Buscar">Buscar</button>
                        
                        <h2 class="card-inside-title" id="total"></h2>
                            <div style="width: 1000px; height: 1000px">
                                <canvas id="chart"></canvas>
                            </div>



                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script type="text/javascript">
                                var Buscar = document.querySelector("#Buscar");
                                var fd = new FormData();
                                window.CSRF_TOKEN = '{{ csrf_token() }}';

                                Buscar.addEventListener('click', () => {
                                    var dateStart = document.querySelector("#dateStart").value;
                                    var dateEnd = document.querySelector("#dateEnd").value;
                                    fd.append('param1', dateStart);
                                    fd.append('param2', dateEnd);
                                    fetch('/report/viajes', {
                                            method: 'post',
                                            headers: {
                                                'X-CSRF-TOKEN': window.CSRF_TOKEN
                                            },
                                            body: fd,
                                        }).then(res => res.json())
                                        .then(res => {
                                            var total = 0;
                                            var labels = res.map(function(e) {
                                                return e.Viaje;
                                            });

                                            var data = res.map(function(e) {
                                                return e.Ganancia;
                                            });

                                            for(i in data){
                                                total = total + data[i];
                                            }

                                            document.querySelector("#total").innerHTML = `<h5>Total de Ganancias: ₡${total}</h5>`;
                                            var ctx = document.getElementById("chart").getContext('2d');

                                            var myChart = new Chart(ctx, {

                                                type: 'line',

                                                data: {

                                                    labels: labels,

                                                    datasets: [{

                                                        label: 'Ganancia',

                                                        data: data,

                                                        borderColor: 'rgba(75, 192, 192, 1)',

                                                        backgroundColor: 'rgba(75, 192, 192, 0.3)',

                                                        borderWidth: 1,

                                                    }]

                                                },

                                                options: {

                                                    scales: {

                                                        yAxes: [{

                                                            ticks: {

                                                                beginAtZero: true

                                                            }

                                                        }]

                                                    },

                                                    title: {

                                                        display: true,

                                                        text: ""

                                                    },

                                                }

                                            });

                                        })
                                });
                            </script>
                        </body>

                        </html>


                        @endsection