@php
    $enc = new App\Classes\Enc;
use Carbon\Carbon;
@endphp
<x-app-layout>
    <x-slot name="header">
       
        
        <div class="flex flex-wrap pr-2">
            <a href="{{route('mbcontrole.index')}}">
                <div class="pl-2 pb-2">
                <div  class=" py-1 px-2 mr-2 bg-green-700 hover:bg-green-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">
                    {{ __('Inicio') }}
                </div>
                </div>
            </a>

            
            
            @foreach ($data3['filtro'] as $mes)
            <a href="{{ route('mbcada.mes', ['mes' => $enc->encriptar($mes->month), 'ano' => $enc->encriptar($mes->year)]) }}">
                <div class="pl-2 pb-2">
                    @foreach ($dataAtual['filtro'] as $atualmes)
                        @if($atualmes->month_year == $mes->month_year)   
                            <div class="py-1 px-1 mr-2 bg-yellow-400 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                                {{ $atualmes->month_year }}
                            </div>
                            @else
                            <div class="py-1 px-1 mr-2 bg-indigo-700 hover:bg-yellow-400 focus:ring-yellow-400 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                                {{ $mes->month_year }}
                            </div>
                            @endif
                    @endforeach
                    
                </div>
            </a>
        @endforeach
            @php
            $meses = []; // array vazio para armazenar os meses
            foreach ($dinheiros as $item){
                $mes = \Carbon\Carbon::parse($item->data)->format('m');
                $meses[$mes] = true; // armazena o mês no array
            }
            $saldos = []; // array vazio para armazenar os saldos de cada mês
            foreach ($meses as $mes => $flag){
                $total_entrada_por_mes = DB::table('moviments')
                    ->select(DB::raw('SUM(CONVERT(valor, DECIMAL(10,2))) as total'))
                    ->where([['tipo', '=', 'E'],['user_id', '=', Auth::user()->id ]])
                    ->whereRaw('MONTH(data) = ?', [$mes])
                    ->first();
        
                $total_saida_por_mes = DB::table('moviments')
                    ->select(DB::raw('SUM(CONVERT(valor, DECIMAL(10,2))) as total'))
                    ->where([['tipo', '=', 'S'],['user_id', '=', Auth::user()->id ]])
                    ->whereRaw('MONTH(data) = ?', [$mes])
                    ->first();
        
                $total_entrada = floatval($total_entrada_por_mes->total ?? 0);
                $total_saida = floatval($total_saida_por_mes->total ?? 0);
                $saldo = $total_entrada - $total_saida;
        
                $saldos[$mes] = $saldo; // armazena o saldo desse mês no array
            }
        @endphp

        @if(Auth::user()->status == 'ativo')
        <div class="pl-2 pb-2">
            
            @if( $saldos[$mes] > 0  )
            <div class="py-1 px-2 mr-2 bg-green-600 hover:bg-green-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
              R$  {{$formatted = number_format($saldos[$mes]/100, 2, ',', '.')  }} 
              @php
                $mesSelecionado = isset($_GET['mes']) ? $_GET['mes'] : null;
                @endphp
            </div>
            @else
            <div class="py-1 px-2 mr-2 bg-red-500 hover:bg-red-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                R$ {{$formatted = number_format($saldos[$mes]/100, 2, ',', '.')  }} 
                @php
                  $mesSelecionado = isset($_GET['mes']) ? $_GET['mes'] : null;
                  @endphp
              </div>
              @endif
           
        </div>
        @endif
           
    </x-slot>
         @if(session()->has('success'))
    <div class="py-4">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
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
   <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                     <!----------inicio------>
                  
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
                        <div class="flex flex-wrap">
                            @if(Auth::user()->status == 'ativo')
                            <div class="basis-1/5">  <canvas id="myChartano"></canvas></div>
                           @endif
                            <div class="basis-1/2"><canvas id="myChart"></canvas></div>
                            @if(Auth::user()->status == 'ativo')
                            <div class="basis-1/5"><canvas id="myChartp"></canvas></div>
                            @endif
                          </div>
                  
                      
                         <!-----------fim-------->
                </div>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  
        
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-900 uppercase bg-red-700 ">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="py-1 px-2 mr-2 bg-red-700 hover:bg-red-700 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                       Data
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="py-1 px-2 mr-2 bg-red-700 hover:bg-red-700 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                       Descrição
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="py-1 px-2 mr-2 bg-red-700 hover:bg-red-700 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                       Valor
                                        </div>
                                    </th>
                                  
                                    <th scope="col" class="px-6 py-3">
                                        <div class="py-1 px-2 mr-2 bg-red-700 hover:bg-red-700 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                        Estado
                                        </div>
                                     </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="py-1 px-2 mr-2 bg-red-700 hover:bg-red-700 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                        Ação
                                        </div>
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dinheiros as $item)
                                @if($item->pago == 'N')
                                <tr class="bg-black border-b dark:bg-black ">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="py-1 px-2 mr-2 bg-black hover:bg-black focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                         {{$item->dia  }}-{{ \Carbon\Carbon::parse($item->data)->format('m-Y') }}
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        <div class="py-1 px-2 mr-2 bg-black hover:bg-gray-900 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                         {{$item->etiqueta }} {{$item->motivo }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="py-1 px-2 mr-2 bg-black hover:bg-gray-900 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                     R$  {{$formatted = number_format($item->valor/100, 2, ',', '.')  }} 
                                        </div>
                                    </td>
                                    @if(Auth::user()->status == 'ativo')
                                    <td class="px-6 py-4">
                                        <a href="{{ route ('mbcontrole.pagar', ['id' =>$enc->encriptar($item->id), 'mes' =>$enc->encriptar( \Carbon\Carbon::parse($item->data)->format('m')),'ano' =>$enc->encriptar( \Carbon\Carbon::parse($item->data)->format('Y')) ])}}">
                                            <div  class=" py-1 px-2 mr-2 bg-green-700 hover:bg-green-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg" style="width: 100px; height: 30px;">
                                         {{ $item->pago == 'N' ? 'Pagar' : 'Pagar' }} 
                                            </div>
                                        </a>
                                    </td>
                                    @else
                                    <td class="px-6 py-4">
                                        <div class="py-1 px-2 mr-2 bg-black hover:bg-gray-900 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                            {{ $item->pago == 'N' ? 'Pagar' : 'Pagar' }} 
                                        </div>
                                    </td>

                                    @endif
                                    <td class="px-6 py-4">
                                        <div class="py-1 px-2 mr-2 bg-indigo-800 hover:bg-indigo-600 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                            <a href="{{ route ('mbcontrole.edit', ['id' =>$enc->encriptar($item->id), 'mes' => $enc->encriptar(\Carbon\Carbon::parse($item->data)->format('m'))])}}" >Editar</a>
                                          </div>
                                          
                                    </td>
                                   
                                </tr>
                                @endif
                                @endforeach
<!---------------------------pagos------------------------->

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-900 uppercase bg-blue-50 dark:bg-blue-700 dark:text-gray-200">
                               
                            </thead>
                            <tbody>
                                @foreach ($dinheiros as $item)
                                @if($item->pago == 'S' && $item->tipo != 'E')
                                <tr class=" border-b bg-gray-800 ">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        <div class="py-1 px-2 mr-2 bg-gray-800 hover:bg-gray-800 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                        {{$item->dia  }}-{{ \Carbon\Carbon::parse($item->data)->format('m-Y') }}
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        <div class="py-1 px-2 mr-2 bg-gray-800 hover:bg-gray-800 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                            {{$item->etiqueta }} {{$item->motivo }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="py-1 px-2 mr-2 bg-gray-800 hover:bg-gray-800 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                      R$  {{$formatted = number_format($item->valor/100, 2, ',', '.')  }} 
                                        </div>
                                    </td>
                                   
                                    <td class="px-6 py-4">
                                        <div class="py-1 px-2 mr-2 bg-gray-800 hover:bg-gray-800 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                       {{ $item->pago == 'S' ? 'Pago' : 'Pago' }} 
                                        </div>
                                    </td>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="py-1 px-2 mr-2 bg-indigo-800 hover:bg-indigo-600 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                                        <a href="{{ route ('mbcontrole.edit', ['id' =>$enc->encriptar($item->id), 'mes' => $enc->encriptar(\Carbon\Carbon::parse($item->data)->format('m'))])}}" >Editar</a>
                                      </div>
                                      
                                </td>
                               
                                </tr>
                                @endif
                                @endforeach
                    
<!----------------recebidos---------------------->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-green-700 uppercase bg-green-50 dark:bg-green-700 dark:text-gray-400">
           
        </thead>
        <tbody>
            @foreach ($dinheiros as $item)
            @if($item->tipo == 'E')
            <tr class=" border-b bg-gray-700 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <div class="py-1 px-2 mr-2 bg-gray-700 hover:bg-gray-700 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                    {{$item->dia  }}-{{ \Carbon\Carbon::parse($item->data)->format('m-Y') }}
                    </div>
                </th>
                <td class="px-6 py-4">
                    <div class="py-1 px-2 mr-2 bg-gray-700 hover:bg-gray-700 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                        {{$item->etiqueta }} {{$item->motivo }}
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="py-1 px-2 mr-2 bg-gray-700 hover:bg-gray-700 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                R$  {{$formatted = number_format($item->valor/100, 2, ',', '.')  }} 
                    </div>
                </td>
               
                <td class="px-6 py-4">
                    <a href="{{ route ('mbcontrole.pagar', ['id' =>$enc->encriptar($item->id), 'mes' =>$enc->encriptar( \Carbon\Carbon::parse($item->data)->format('m')),'ano' =>$enc->encriptar( \Carbon\Carbon::parse($item->data)->format('Y')) ])}}">
                        <div  class=" py-1 px-2 mr-2 bg-gray-700 hover:bg-gray-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg" style="width: 100px; height: 30px;">
                            {{ $item->pago == 'N' ? 'A receber' : 'Recebido' }} 
                        </div>
                    </a>
                   
                      
                </td>
                <td class="px-6 py-4">
                    <div class="py-1 px-2 mr-2 bg-indigo-700 hover:bg-indigo-600 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg" style="width: 100px; height: 30px;">
                        <a href="{{ route ('mbcontrole.edit', ['id' =>$enc->encriptar($item->id), 'mes' => $enc->encriptar(\Carbon\Carbon::parse($item->data)->format('m'))])}}" >Editar</a>
                      </div>
                      
                </td>
               
            </tr>
            @endif
            @endforeach
            
               
        </tbody>
    </table>
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

                   
                        
                       
                         <!-----------fim-------->
                </div>
            </div>
        </div>
    </div>
 <!-- Inclua a biblioteca Chart.js -->
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 


 
 <script>
    var ctx = document.getElementById('myChartp').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labelse); ?>,
            datasets: [{
                label: 'Gastos por mes',
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
                text: 'Gastos do mês'
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
                label: 'Total mensal',
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




<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('myChartano').getContext('2d');
        var totalEntrada = 0;
        var totalSaida = 0;

        <?php if (!empty($totalEntradaPorMes) && isset($totalEntradaPorMes[0])) : ?>
            totalEntrada = <?php echo number_format($totalEntradaPorMes[0]->total / 100, 2, '.', ''); ?>;
        <?php endif; ?>

        <?php if (!empty($totalSaidaPorMes) && isset($totalSaidaPorMes[0])) : ?>
            totalSaida = <?php echo number_format($totalSaidaPorMes[0]->total / 100, 2, '.', ''); ?>;
        <?php endif; ?>

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Entrada', 'Saída'],
                datasets: [{
                    label: 'Entrada e saídas deste Mes',
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
