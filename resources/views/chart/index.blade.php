@extends('layouts.app')

@section('content')




<head>
    <title>MDH</title>
    <script src="http://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script>
    <script src="http://www.chartjs.org/samples/latest/utils.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
</head>


<body>
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script>
        var chartdata = {
            type: 'line',
            data: {


                datasets: [{
                        data: <?php echo $timesheet ?>,
                        label: 'Timesheet',
                        backgroundColor: '#26B99A',
                        borderWidth: 1,
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                        },
                        fill: false,
                        borderColor: '#26B99A',
                        tension: 0.1,




                    },
                    {

                        data: <?php echo $leave ?>,
                        label: 'Leave',
                        backgroundColor: '#3e95cd',
                        borderWidth: 1,
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                        },
                        fill: false,
                        borderColor: '#3e95cd',
                        tension: 0.1,
                    }
                ],

                // #ff0000

                labels: <?php echo json_encode($month); ?>,


            },
            plugins: [ChartDataLabels],
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        }


        var ctx = document.getElementById('canvas').getContext('2d');
        new Chart(ctx, chartdata);
    </script>
</body>




@endsection