

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-nowrap">
        <a href="{{route('controle.index')}}">
            <div class="basis-1/4">
            <div  class=" py-1 px-2 mr-2 bg-green-700 hover:bg-green-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">
                {{ __('Inicio') }}
            </div>
            </div>
        </a>
        <div class="basis-1/4"></div>
        <a href="{{route('logs')}}">
            <div class="basis-1/4">
            <div  class=" py-1 px-2 mr-2 bg-indigo-700 hover:bg-indigo-600 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">
                {{ __('Logs') }}
            </div>
            </div>
        </a>
        </div>
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                    <div class="flex flex-nowrap">
                        <div class="basis-1/4"><canvas id="myChartPlano"></canvas></div>
                        <div class="basis-1/2"> <canvas id="myChart"></canvas></div>
                        <div class="basis-1/4"><canvas id="myChartOrigem"></canvas></div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  
<div class="container max-w-8xl px-4 mx-auto sm:px-8">
    <div class="py-8">
        <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                           
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Criado
                             </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Login
                             </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Nome Completo
                             </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Plano
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Inicio
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Fim
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Registros
                             </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                status
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Bonus
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Ação
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($usuarios as $item)
                                
                          
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <div class="flex items-center">
                                   
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            @switch($h = \Carbon\Carbon::parse ($item->created_at)->diffInDays(date("Y-m-d H:i:s")))
                                            @case(0)
                                            Hoje   
                                                @break

                                            @case(1)
                                            Ontem  
                                                @break

                                            @default
                                          {{$h}} Dias
                                         @endswitch
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <div class="flex items-center">
                                   
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            @switch($h = \Carbon\Carbon::parse ($item->updated_at)->diffInDays(date("Y-m-d H:i:s")))
                                            @case(0)
                                            Hoje   
                                                @break

                                            @case(1)
                                            Ontem  
                                                @break

                                            @default
                                          {{$h}} Dias
                                         @endswitch
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$item->id}}-{{$item->name}}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$item->plano}}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                  {{  $data_br = date("d/m/Y", strtotime($item->inicio_date));}}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$data_br = date("d/m/Y", strtotime($item->fim_date));}}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$item->registro}}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                    <span aria-hidden="true" class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                    </span>
                                    <span class="relative">
                                        {{$item->status}}
                                    </span>
                                </span>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <a href="{{route ('admin.bonus', ['id' => $item->id])}}" class="text-indigo-600 hover:text-indigo-900">
                                 {{$item->bonus}}
                                </a>
                            </td>
                           <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <a href="{{route ('admin.email', ['id' => $item->id])}}" class="text-indigo-600 hover:text-indigo-900">
                               Ação   {{$item->acho}}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                           

                           
                    </tbody>
                </table>
                <div class="flex flex-col items-center px-5 py-5 bg-white xs:flex-row xs:justify-between">
                    <div class="flex items-center">
                        {{ $usuarios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>

   


<!-- Adicione o código JavaScript para criar o gráfico -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Obtendo o contexto do canvas
    var ctx = document.getElementById('myChartPlano').getContext('2d');

    // Criando o gráfico em pizza
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($data['labels']); ?>,
            datasets: <?php echo json_encode($data['datasets']); ?>
        },
        options: {
            title: {
                display: true,
                text: 'Distribuição de Usuários por Plano'
            }
        }
    });
</script>

<script>
    // Obtendo o contexto do canvas
    var ctx = document.getElementById('myChart').getContext('2d');

    // Criando o gráfico de barras
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($dataUsuarios['labels']); ?>,
            datasets: <?php echo json_encode($dataUsuarios['datasets']); ?>
        },
        options: {
            title: {
                display: true,
                text: 'Quantidade de Novos Usuários por Mês'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }]
            }
        }
    });
</script>

<script>
    
    var ctx = document.getElementById('myChartOrigem').getContext('2d');

    // Criando o gráfico em pizza
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($dataOrigem['labels']); ?>,
            datasets: <?php echo json_encode($dataOrigem['datasets']); ?>
        },
        options: {
            title: {
                display: true,
                text: 'Distribuição de Usuários por Origem'
            }
        }
    });
</script>

</x-app-layout>

