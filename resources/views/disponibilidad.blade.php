@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reporte: frecuencia de citas</h3>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div id="container"></div>
        </div>
    </div>

    <input type="text" id="fech" value="{{$date1}}">
@endsection
@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        const dataset = {
            "xData": [

          // fecha = new Date($('#fech').val()),
          // dias = 30 // Número de días a agregar


            ],
          };
          todo = fecha.setDate(fecha.getDate() + dias);
          console.log(todo);
          const processedData = dataset.data.map((dataEl, i) => {
            return [new Date(dataset.xData[i]).getTime(), dataEl] // x, y format
          });

          Highcharts.chart('container', {
            chart: {
              marginLeft: 40
            },
            title: {
              text: ''
            },
            xAxis: {
              type: 'datetime',
              labels: {
                format: '{value:%d-%m-%Y}'
              }
            },
            yAxis: {
              title: {
                text: null
              }
            },
            series: [{
              data: todo
            }]
          });

    </script>
@endsection
