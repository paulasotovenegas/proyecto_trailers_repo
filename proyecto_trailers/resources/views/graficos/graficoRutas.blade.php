@extends('navbar.navbar')
@section('content')

<div class="block-header">
    <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
            <h2>Gráfica de Rutas

            </h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio </a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Ver Gráficas</a></li>
                <li class="breadcrumb-item active">Gráfica de Rutas</li>
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

                            <div class="container">
                                <div class="row">
                                    <div class="col-6">

                                        <canvas id="pieRutas" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                // $(document).ready(function() {

                                //     //Autocomplete

                                //     $(function() {

                                //         rutas = [];

                                //         cantidad = [];

                                //         $.ajax({

                                //             type: 'GET',

                                //             url: '/report/rutas',

                                //             success: function(response) {

                                //                 var registros = response;

                                //                 for (var i = 0; i < registros.length; i++) {

                                //                     rutas[i] = registros[i].Ruta;

                                //                     cantidad[i] = registros[i].Cantidad;

                                //                 }

                                //                 setTimeout(function() {

                                //                     generarPieRutas();

                                //                 }, 200)

                                //             }

                                //         });

                                //     });

                                // });

                                // function generarPieRutas() {

                                //     var ctx = document.getElementById('pieRutas').getContext('2d');

                                //     var myChart = new Chart(ctx, {

                                //         type: 'pie',

                                //         data: {

                                //             labels: rutas,

                                //             datasets: [{

                                //                 label: 'Gráfico de Rutas',

                                //                 backgroundColor: "#FFCC00",

                                //                 data: cantidad,

                                //                 backgroundColor: [

                                //                     'rgba(255, 99, 132, 0.2)',

                                //                     'rgba(54, 162, 235, 0.2)',

                                //                     'rgba(255, 206, 86, 0.2)',

                                //                     'rgba(75, 192, 192, 0.2)',

                                //                     'rgba(153, 102, 255, 0.2)',

                                //                     'rgba(255, 159, 64, 0.2)'

                                //                 ],

                                //                 borderColor: [

                                //                     'rgba(255, 99, 132, 1)',

                                //                     'rgba(54, 162, 235, 1)',

                                //                     'rgba(255, 206, 86, 1)',

                                //                     'rgba(75, 192, 192, 1)',

                                //                     'rgba(153, 102, 255, 1)',

                                //                     'rgba(255, 159, 64, 1)'

                                //                 ],

                                //                 borderWidth: 1

                                //             }]

                                //         },

                                //         options: {

                                //             display: true,

                                //             responsive: true,

                                //         }

                                //     });

                                // }

                                window.onload = () => {


                                    //Autocomplete

                                    rutas = [];

                                    cantidad = [];

                                    $.ajax({

                                        type: 'GET',

                                        url: '/report/rutas',

                                        success: function(response) {

                                              response = Object.values(response);

                                                

                                                var registros = response;

                                                rutas = response.map(function(e) {
                                                    return e.Ruta;
                                                });

                                                cantidad = response.map(function(e) {
                                                    return e.Cantidad;
                                                });



                                            setTimeout(function() {

                                                generarPieRutas();

                                            }, 200)

                                        }

                                    });

                                }

                                function generarPieRutas() {

                                    var ctx = document.getElementById('pieRutas').getContext('2d');

                                    var myChart = new Chart(ctx, {

                                        type: 'pie',

                                        data: {

                                            labels: rutas,

                                            datasets: [{

                                                label: 'Gráfico de Rutas',

                                                backgroundColor: "#FFCC00",

                                                data: cantidad,

                                                backgroundColor: [

                                                    'rgba(255, 99, 132, 0.2)',

                                                    'rgba(54, 162, 235, 0.2)',

                                                    'rgba(255, 206, 86, 0.2)',

                                                    'rgba(75, 192, 192, 0.2)',

                                                    'rgba(153, 102, 255, 0.2)',

                                                    'rgba(255, 159, 64, 0.2)'

                                                ],

                                                borderColor: [

                                                    'rgba(255, 99, 132, 1)',

                                                    'rgba(54, 162, 235, 1)',

                                                    'rgba(255, 206, 86, 1)',

                                                    'rgba(75, 192, 192, 1)',

                                                    'rgba(153, 102, 255, 1)',

                                                    'rgba(255, 159, 64, 1)'

                                                ],

                                                borderWidth: 1

                                            }]

                                        },

                                        options: {

                                            display: true,

                                            responsive: true,

                                        }

                                    });

                                }


                                /*from w w w . j a va2 s .c om*/
                                /** Watch carefully,
                                If you set one 'undefined' values on any of the dataset, it will result in the labels being crossed (or strikethrough). This means that if you only use one dataset, and you don't want the labels being shown in the chart and getting the labels crossed you want to set the values to 'undefined'.
                                Null values will get you same result *without* the labels being crossed.
                                So you want to use 'undefined' values if you would like to cross the label and hide the data, and you want to use 'null' values if you would like to just hide the data without getting the labels crossed.
                                Try to play around with it and use it as you like.
                                */
                                //     var ctx = document.getElementById("pieRutas").getContext("2d");
                                //     var myChart = new Chart(ctx, {
                                //         type: 'doughnut',
                                //         data: {
                                //             labels: ["Red", "Green", "Blue"],
                                //             datasets: [{
                                //                 label: '# of Votes',
                                //                 data: [12, 3, undefined],
                                //                 // Play around with null and undefined values and see the difference on how the Chart reacts.
                                //                 backgroundColor: [
                                //                     '#f87979',
                                //                     '#79f879',
                                //                     '#7979f8'
                                //                 ],
                                //                 borderWidth: 5
                                //             }, {
                                //                 label: '# of Votes',
                                //                 data: [0, 19, undefined],
                                //                 // Play around with null and undefined values and see the difference on how the Chart reacts.
                                //                 backgroundColor: [
                                //                     '#f87979',
                                //                     '#79f879',
                                //                     '#7979f8'
                                //                 ]
                                //             }]
                                //         },
                                //         options: {
                                //             tooltips: {
                                //                 mode: null
                                //             },
                                //             plugins: {
                                //                 datalabels: {
                                //                     borderWidth: 5,
                                //                     borderColor: "white",
                                //                     borderRadius: 8,
                                //                     // color: 0,
                                //                     font: {
                                //                         weight: "bold"
                                //                     },
                                //                     backgroundColor: "lightgray"
                                //                 }
                                //             }
                                //         }
                                //     });
                                // }
                            </script>
                        </body>

                        </html>


                    </div>
                </div>
            </div>
        </div>

    </div>


    @endsection
