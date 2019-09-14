@extends('layouts.master', ['titre' => 'Dashboard', 
                            'nomPage' => 'Dashboard',
                            'titrePage' => 'Dashboard' ])

@section('content')
 <div class="row">
  <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$a}}</h3>
                <p>Lots enregistée</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('achats.index')}}" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$v}}</h3>

                <p>Vente enregistrée</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('ventes.index')}}" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$p}}</h3>

                <p>Pharmacien enregistrée</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('pharmacien.index')}}" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$f}}</h3>

                <p>Fournisseur enregistrée</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('fournisseur.index')}}" class="small-box-footer">Plus info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
<div class="col-lg-12">
        <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Nombre de vente pour chaque jour ({{$subMonthName}})</h3>
                  <a href="{{route('ventes.index')}}">Voir en détail</a>
                </div>
              </div>
              <div class="card-body">
                    <canvas id="myChart" style=" width:100%;height:350px"></canvas>
              </div>
            </div>
</div>
<div class="col-lg-12">
        <div class="card">
          <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Chiffre d'ffaire des ventes ({{$annee}})</h3>
                </div>
              </div>
        <div class="card-body">
            <canvas id="chart1"></canvas>
         </div>

  
  <div class="form-group col-sm-12 form-inline" style="left: 8%">
       <label for="">Chart Type:</label>&nbsp;
     <select class="form-control custom-select" id="type">
      <option value="line">Line</option>
      <option value="bar">Bar</option>
    </select>&nbsp;&nbsp;
    <button id="update" class="btn btn-sm btn-primary">Modifier</button>
  </div>
</div>
</div>

@stop

@section('css')
<style type="text/css">
  canvas {
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
    }
</style>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="{{ asset('js/chart/chart.js')}}"></script>

<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
	<script type="text/javascript">
		function menuApp(){

      document.getElementById("top").className = "nav-item has-treeview";

      document.getElementById("dash").className = "nav-link active";
      document.getElementById("management").className = "nav-link ";
      document.getElementById("medicaments").className = "nav-link ";
      document.getElementById("fournisseur").className = "nav-link ";
      document.getElementById("pharmacien").className = "nav-link ";
      document.getElementById("achats").className = "nav-link ";
      document.getElementById("ventes").className = "nav-link";
      document.getElementById("profile").className = "nav-link";
      document.getElementById("off").className = "nav-link";
    }

    //chart 
    var ctxx = document.getElementById('myChart');
var myChart = new Chart(ctxx, {
    type: 'bar',
    data: {
        labels: {!!json_encode($list)!!},
        datasets: [{
            label: 'Nombre de vente: ',
            data: {{json_encode($l)}},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
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
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                 'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});




    

    var ctx = document.getElementById('chart1').getContext('2d');
    ctx.canvas.width = 1000;
    ctx.canvas.height = 300;

    var color = Chart.helpers.color;
    var cfg = {
      type: 'bar',
      data: {
        labels: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'],
        datasets: [{
          label: 'Chiffre d affaire des ventes',
          backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
          borderColor: window.chartColors.red,
          data: {{json_encode($ll)}},
          type: 'line',
          pointRadius: 0,
          fill: false,
          lineTension: 0,
          borderWidth: 2
        }]
      },
      options: {
        scales: {
          xAxes: [{
            distribution: 'series',
            ticks: {
              source: 'data',
              autoSkip: true
            }
          }],
          yAxes: [{
            scaleLabel: {
              display: true,
              labelString: 'Chiffre d affaire des ventes (DA)'
            }
          }]
        },
        tooltips: {
          intersect: false,
          mode: 'index',
          callbacks: {
            label: function(tooltipItem, myData) {
              var label = myData.datasets[tooltipItem.datasetIndex].label || '';
              if (label) {
                label += ': ';
              }
              label += parseFloat(tooltipItem.value).toFixed(2);
              return label;
            }
          }
        }
      }
    };

    var chart = new Chart(ctx, cfg);

    document.getElementById('update').addEventListener('click', function() {
      var type = document.getElementById('type').value;
      chart.config.data.datasets[0].type = type;
      chart.update();
    });
    
    
	</script>
@stop

@section('css')

@stop