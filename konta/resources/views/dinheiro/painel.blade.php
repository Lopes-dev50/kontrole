@php
   $enc = new App\Classes\Enc; 
use Carbon\Carbon;
@endphp
<x-app-layout>
 
    <x-slot name="header">
              
        <div class="flex flex-wrap  mx-auto ">
            <a href="{{route('controle.adicionar')}}">
                <div class="pl-2">
                    <div class="flex  items-center justify-center py-1 px-2 mr-2 bg-green-700 hover:bg-green-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-16 h-16 transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-full">
                     {{ __('+') }}
                </div>
                </div>
            </a>
            @foreach ($data3['filtro'] as $mes)
            <a href="{{ route ('cada.mes', ['mes' => $enc->encriptar($mes->month), 'ano' => $enc->encriptar($mes->year) ])}}">
               <div class="pl-1">
                <div class="flex items-center justify-center py-1 px-2 mr-2 bg-green-700 hover:bg-green-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-16 h-16 transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-full">
                    
                           {{ $mes->month_year }}
                </div>
               </div>
            </a>
           @endforeach
           <a href="{{route('controle.index')}}">
            <div class="pl-1">
                <div class="flex items-center justify-center py-1 px-2 mr-2 bg-yellow-500 hover:bg-yellow-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-16 h-16 transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-full">
                     {{ __('Total') }}
            </div>
            </div>
           </a>

        <div class="pl-2">
            @php
            $ano = date('Y');
            $total_entrada = DB::table('moviments')->where([['tipo', '=', 'E'],['user_id', '=', Auth::user()->id ]] )->whereYear('data', '=', $ano)->sum('valor');
            $total_saida = DB::table('moviments')->where([['tipo', '=', 'S'],['user_id', '=', Auth::user()->id ]])->whereYear('data', '=', $ano)->sum('valor');
            $saldo = $total_entrada - $total_saida;
         
            $meta = Auth::user()->meta;
                                          $totalmeta = DB::table('moviments')->where([
                                              ['tipo', '=', 'M'],
                                              ['user_id', '=', Auth::user()->id]
                                          ])->whereYear('data', '=', $ano)->sum('valor');
                                          
                                          // Ajuste para tratar o valor cadastrado no banco
                                          $totalmeta = $totalmeta / 100;
         
         @endphp
        
        </div>
        @if(Auth::user()->status == 'ativo')
        <a href="{{route('busca.mes')}}">
            <div class="pl-2">
                <div class="flex items-center justify-center py-1 px-2 mr-2 bg-green-700 hover:bg-green-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-16 h-16 transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-full">
                      {{ __('Filtro') }}
            </div>
            </div>
        </a>
        @endif
    </x-slot>
    @if(session()->has('success'))
    <div class="py-4">
        <div class="max-w-8xl mx-auto sm:px-8 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
    <div class="container bg-green-500 flex items-center text-white text-sm font-bold px-4 py-3 relative" role="alert">
        <svg width="20" height="20" fill="currentColor" class="w-4 h-4 mr-2" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
            <path d="M1216 1344v128q0 26-19 45t-45 19h-512q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h64v-384h-64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h384q26 0 45 19t19 45v576h64q26 0 45 19t19 45zm-128-1152v192q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-192q0-26 19-45t45-19h256q26 0 45 19t19 45z"></path>
        </svg>
        <p>
            {{ session('success') }}
        </p>
    </div>
                </div></div></div></div>
@endif

<!----------------------------novo-------------->
<div class="flex flex-row">
    <div class="basis-1/2">
        <div class="py-4">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Primeira linha de cards -->
                        <div class="flex flex-row">
                            <div class="w-1/2 pr-4 pb-4 pt-2"> <!-- Dividindo a largura pela metade para 2 cards em cima -->
                                <div class="max-w-sm p-6 bg-indigo-600 border border-indigo-200 rounded-lg shadow">
                                    <h5 class="mb-2 text-1xl font-semibold tracking-tight text-gray-900">INVESTIMENTO ANUAL</h5>
                                    <p class="mb-3 font-normal text-1xl text-gray-100">R$ {{$formatted = number_format($totalmeta/100, 2, ',', '.')}}</p>
                                </div>
                            </div>
                            <div class="w-1/2 pr-4 pt-2"> <!-- Dividindo a largura pela metade para 2 cards em cima -->
                                <div class="max-w-sm p-6 bg-red-600 border border-red-200 rounded-lg shadow">
                                    <h5 class="mb-2 text-1xl font-semibold tracking-tight text-gray-900">DESPESAS ANUAL</h5>
                                    <p class="mb-3 font-normal text-1xl text-gray-100">R$ {{$formatted = number_format($total_saida/100, 2, ',', '.')}}</p>
                                </div>
                            </div>
                        </div>
        
                        <!-- Segunda linha de cards -->
                        <div class="flex flex-row">
                            <div class="w-1/2 pr-4 pb-4 pt-2"> <!-- Dividindo a largura pela metade para 2 cards embaixo -->
                                <div class="max-w-sm p-6 bg-green-600 border border-green-200 rounded-lg shadow">
                                    <h5 class="mb-2 text-1xl font-semibold tracking-tight text-gray-900">RECEITAS ANUAL</h5>
                                    <p class="mb-3 font-normal text-1xl text-gray-100">R$ {{$formatted = number_format($total_entrada/100, 2, ',', '.')}}</p>
                                </div>
                            </div>
                            <div class="w-1/2 pr-4 pt-2"> <!-- Dividindo a largura pela metade para 2 cards embaixo -->
                                <div class="max-w-sm p-6 bg-yellow-500 border border-blue-200 rounded-lg shadow">
                                    <h5 class="mb-2 text-1xl font-semibold tracking-tight text-gray-900">CAIXA ANUAL</h5>
                                    @if($saldo > 0)
                                    <p class="mb-3 font-normal text-1xl text-gray-100">R$ {{$formatted = number_format($saldo/100, 2, ',', '.')}}</p>
                                    @else
                                    <p class="mb-3 font-normal text-1xl text-red-400">R$ {{$formatted = number_format($saldo/100, 2, ',', '.')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
    
        <div class="basis-1/2 py-4 pr-4"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> <canvas id="myChartano"></canvas></div></div>
       
      </div>

  <!------------------finnovo----------------------->

  <div class="py-4">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
         
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-12">
              <div class="items-center">
                <div class="flex flex-wrap ">
                    @foreach ($labels1 as $index => $label) 
                    <div class="p-2">
                        <div class="bg-red-600 rounded-lg shadow-lg p-2">
                            <a href="{{route('grafico.index', ['etiqueta' => $label  ])}}">
                            <h2 class="text-lg font-semibold">{{ $label }}</h2>
                            <p class="text-red-100 text-sm">
                                R$ {{ number_format($data1[$index] / 100, 2, ',', '.') }} 
                            </p>
                            </a>
                        </div>
                    </div>
                @endforeach
                </div>
               </div>
          </div>
    
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-12">
                  <div class="items-center">
                    <div class="flex flex-wrap ">
                        @foreach ($labelse as $index => $label) 
                            <div class="p-2 ">
                                <div class="bg-green-600 rounded-lg shadow-lg p-2">
                                    <a href="{{route('grafico.index', ['etiqueta' => $label  ])}}">
                                    <h2 class="text-lg font-semibold">{{ $label }}</h2>
                                    <p class="text-green-100 text-sm">
                                        R$ {{ number_format($datae[$index] / 100, 2, ',', '.') }} 
                                    </p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                   </div>
              </div>
        </div>
        </div>
    </div>
  </div>

        
   <!-----------------fim------------>
                    </div>
                </div>
            </div>
        </div>
<script>
    String.prototype.reverse = function () {
      return this.split('').reverse().join('');
    };
    
    function mascaraMoeda(campo, evento) {
      var tecla = (!evento) ? window.event.keyCode : evento.which;
      var valor = campo.value.replace(/[^\d]+/gi, '').reverse();
      var resultado = "";
      var mascara = "##.###.###,##".reverse();
      for (var x = 0, y = 0; x < mascara.length && y < valor.length;) {
        if (mascara.charAt(x) != '#') {
          resultado += mascara.charAt(x);
          x++;
        } else {
          resultado += valor.charAt(y);
          y++;
          x++;
        }
      }
      campo.value = resultado.reverse();
    }
    
    
    /* Máscaras ER */
    function mascara(o, f) {
      v_obj = o
      v_fun = f
      setTimeout("execmascara()", 1)
    }
    function execmascara() {
      v_obj.value = v_fun(v_obj.value)
    }
    function mtel(v) {
      v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
      v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
      v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
      return v;
    }
    function id(el) {
      return document.getElementById(el);
    }
    window.onload = function () {
      id('telefone').onkeyup = function () {
        mascara(this, mtel);
      }
    }
    </script>

<!-------------------------->
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
 
 <script>
    var ctx = document.getElementById('myChartp').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labelse); ?>,
            datasets: [{
                label: 'Receitas ',
                data: <?php echo json_encode(array_map(function($value) {
                    return number_format($value / 100, 2, '.', '');
                }, $datae->toArray())); ?>,
                backgroundColor: [
                    'rgba(110, 128, 10, 1.4)',
                    'rgba(115, 216, 10, 0.6)',
                    'rgba(75, 126, 10, 0.6)',
                    'rgba(153, 211, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(105, 99, 132, 0.6)',
                    'rgba(255, 199, 132, 0.6)',
                    'rgba(255, 199, 12, 0.6)',
                    'rgba(205, 199, 12, 0.3)',
                    'rgba(255, 19, 132, 0.6)'
                ]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Gastos por ano'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, valuee) {
                            return value.replace('.', ',');
                        }
                    }
                }]
            }
        }
    });
</script>

<!-- Código do gráfico -->
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels1); ?>,
            datasets: [{
                label: 'Despesas',
                data: <?php echo json_encode(array_map(function($value) {
                    return number_format($value / 100, 2, '.', '');
                }, $data1->toArray())); ?>,
                backgroundColor: [
                   
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(205, 93, 82, 0.6)',
                    'rgba(105, 99, 132, 0.6)',
                    'rgba(255, 199, 132, 0.9)',
                    'rgba(255, 199, 12, 0.6)',
                    'rgba(255, 199, 182, 0.6)'
                   
                ]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Gastos por Ano'
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('myChartano').getContext('2d');
        var totalEntrada = 0;
        var totalSaida = 0;

        <?php if (!empty($totalEntradaPorAno) && isset($totalEntradaPorAno[0])) : ?>
            totalEntrada = <?php echo number_format($totalEntradaPorAno[0]->total / 100, 2, '.', ''); ?>;
        <?php endif; ?>

        <?php if (!empty($totalSaidaPorAno) && isset($totalSaidaPorAno[0])) : ?>
            totalSaida = <?php echo number_format($totalSaidaPorAno[0]->total / 100, 2, '.', ''); ?>;
        <?php endif; ?>

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Entrada', 'Saída'],
                datasets: [{
                    label: 'Entrada e saídas deste ano',
                    data: [totalEntrada, totalSaida],
                    backgroundColor: [
                        'rgba(0, 128, 0, 1)',
                        'rgba(255, 69, 0, 1)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce(function(previousValue, currentValue) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                            return dataset.label + ': ' + currentValue.toLocaleString('pt-BR') + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        });
    });
</script>

</x-app-layout>
