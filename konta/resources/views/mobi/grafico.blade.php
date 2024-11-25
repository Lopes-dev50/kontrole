

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row ">
           
            <a href="{{route('mbcontrole.index')}}">
                <div class="pl-2">
                <div  class=" py-1 px-2 mr-2 bg-indigo-700 hover:bg-indigo-600 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">
                    {{ __('Voltar') }}
                </div>
                </div>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
                <div class="p-6 text-gray-900">
                    <div class="flex flex-wrap">
                        <div class="basis-1/4 p-8">
                             @foreach ($etiqueta as $item)
              
                      
                            <div  class=" py-1 p-8 mr-2 bg-orange-400 hover:bg-orange-500 focus:ring-orange-600 focus:ring-offset-orange-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">
                                <a href="{{route('mbgrafico.index', ['etiqueta' => $item->etiqueta ])}}">
                                {{ $item->etiqueta }}
                            </a>
                            </div>
                            <div class="p-1"></div>
                            
                            @endforeach
                        </div>
                    <div class="basis-1/2"><canvas id="myChart"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              
                <div class="flex flex-row ">
                    <canvas id="myChartano"></canvas>
                </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>



    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('myChartano').getContext('2d');
    
            var labels = [];
            var entradaData = [];
            var saidaData = [];
    
            <?php foreach ($entradaPorAno as $entrada) : ?>
                var mesEntrada = moment('<?php echo $entrada->mes; ?>', 'MM').format('MMMM');
                labels.push(mesEntrada);
                entradaData.push(<?php echo number_format($entrada->total / 100, 2, '.', ''); ?>);
            <?php endforeach; ?>
    
            <?php foreach ($saidaPorAno as $saida) : ?>
                var mesSaida = moment('<?php echo $saida->mes; ?>', 'MM').format('MMMM');
                saidaData.push(<?php echo number_format($saida->total / 100, 2, '.', ''); ?>);
            <?php endforeach; ?>
    
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Entrada',
                            data: entradaData,
                            backgroundColor: 'rgba(0, 128, 0, 0.5)',
                            borderColor: 'rgba(0, 128, 0, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Saída',
                            data: saidaData,
                            backgroundColor: 'rgba(255, 69, 0, 0.5)',
                            borderColor: 'rgba(255, 69, 0, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
  <!-- Inclua a biblioteca Chart.js -->
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Código do gráfico -->
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labelse); ?>,
            datasets: [{
                label: 'Total por Descrição',
                data: <?php echo json_encode(array_map(function($value) {
                    return number_format($value / 100, 2, '.', '');
                }, $datae->toArray())); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(205, 93, 82, 0.6)',
                    'rgba(105, 99, 132, 0.6)',
                    'rgba(255, 199, 132, 0.6)',
                    'rgba(255, 199, 12, 0.6)',
                    'rgba(255, 199, 182, 0.6)',
                    'rgba(255, 19, 132, 0.6)'
                ]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Gastos do mês'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, values) {
                            return value.replace('.', ',');
                        }
                    }
                }]
            }
        }
    });
</script>


</x-app-layout>

