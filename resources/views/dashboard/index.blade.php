@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')

<section class="section">
    <br>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-xl-4">

                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h5>Usuarios</h5>

                                        <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$users}}</span></h2>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h5>Productos</h5>

                                        <h2 class="text-right"><i class="fa fa-store f-left"></i><span>{{$products}}</span></h2>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-pink order-card">
                                    <div class="card-block">
                                        <h5>Clientes</h5>

                                        <h2 class="text-right"><i class="fa fa-people-arrows f-left"></i><span>{{$clients}}</span></h2>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <canvas id="chart-ventas"></canvas>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <canvas id="pie-products"></canvas>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <canvas id="chart-clients"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<link href="{{ asset('/css/admin_custom.css') }}" rel="stylesheet">

@stop

@section('js')
<script>
    $(document).ready(function() {


        var cData = <?php echo json_encode($dataBar) ?>;
        
        const ctx = document.getElementById('chart-ventas').getContext('2d');

        const myChart = new Chart(ctx, {
            plugins: [ChartDataLabels],
            type: 'bar',
            data: {
                labels: cData.label,
                datasets: [{
                    label: 'Ventas por dia',
                    data: cData.data,
                    backgroundColor: [
                        '#378AFF',
                        '#378AFF',
                        '#378AFF',
                        '#378AFF',
                        '#378AFF',
                        '#378AFF',
                        '#378AFF',
                    ],
                    borderWidth: 1
                }]

            },
            options: {
                scales: {
                    y: {
                        
                        beginAtZero: true
                        
                    }
                },
                plugins: {
                    datalabels: {
                        font: {
                            weight: 'bold',
                            size: 10
                        },
                        color: 'black'
                    },
                    title: {
                        display: true,
                        text: 'Ventas por día'
                    }
                }
            }
        })
    });
</script>
<script>
    $(document).ready(function() {

        var cData = <?php echo json_encode($dataPie) ?>;

        const dataNumber = cData.data.map(str => {
            return Number(str);
        });

        const ctx = document.getElementById('pie-products').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: cData.label,
                datasets: [{
                    label: 'Producto mas vendido',
                    data: dataNumber,
                    backgroundColor: [
                        '#EC6B56',
                        '#FFC154',
                        '#47B39C',
                        '#9552EA',
                        '#FFEC21',
                    ],
                    borderWidth: 1
                }]

            },
            options: {
                tooltips: {
                    enabled: true
                },
                plugins: {
                    labels: {
                        render: 'percentage',
                        precision: 2,
                        fontStyle: 'bold',
                        fontSize: 13
                    },
                    title: {
                        display: true,
                        text: 'Productos más vendidos'
                    }
                }
            }
        })
    });
</script>
<script>
    $(document).ready(function() {
        var cData = <?php echo json_encode($dataBar2) ?>;

        const ctx = document.getElementById('chart-clients').getContext('2d');

        const myChart = new Chart(ctx, {
            plugins: [ChartDataLabels],
            type: 'bar',
            data: {
                labels: cData.label,
                datasets: [{
                    label: 'Clientes con más ventas',
                    data: cData.data,
                    backgroundColor: [
                        '#47B39C',
                        '#47B39C',
                        '#47B39C',
                    ],
                    borderWidth: 1
                }]

            },
            options: {
                scales: {
                    y: {
                        
                        beginAtZero: true
                        
                    }
                },
                plugins: {
                    datalabels: {
                        font: {
                            weight: 'bold',
                            size: 10
                        },
                        color: 'black'
                    },
                    title: {
                        display: true,
                        text: 'Clientes con más ventas'
                    }
                }
            }
        })
    });
</script>
<script src="https://account.snatchbot.me/script.js"></script><script>window.sntchChat.Init(300309)</script> 
@stop