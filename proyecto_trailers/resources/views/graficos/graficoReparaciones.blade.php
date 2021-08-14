﻿@extends('navbar.navbar')
@section('content')

<div class="block-header">
  <div class="row">
    <div class="col-lg-7 col-md-6 col-sm-12">
      <h2>Gráfica de Reparaciones

      </h2>
    </div>
    <div class="col-lg-5 col-md-6 col-sm-12">
      <ul class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{route('navbar')}}"><i class="zmdi zmdi-home"></i> Inicio </a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Ver Gráficas</a></li>
        <li class="breadcrumb-item active">Gráfica de Reparaciones</li>
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

                    <canvas id="pieReparacion" width="400" height="400"></canvas>
                  </div>
                </div>
              </div>
              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
              <script>
                window.onload = () => {
                  fetch('/report/reparaciones').then(res => res.json())
                    .then(res => {
                      var labels = [];
                      var data = [];
                      for (i in res) {
                        labels[i] = res[i]["Viaje"];
                        data[i] = res[i]["Cantidad"];
                      }

                      var ctx = document.getElementById("pieReparacion").getContext("2d");
                      var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                          labels: labels,
                          datasets: [{
                            label: 'Cantidad de Reparaciones',
                            data: data,
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
                          responsive: true,
                          scales: {
                            y: {
                              min: 0,
                              max: 50,
                            }
                          }
                        }
                      });
                    })
                }
              </script>
            </body>

            </html>


          </div>
        </div>
      </div>
    </div>

  </div>


  @endsection