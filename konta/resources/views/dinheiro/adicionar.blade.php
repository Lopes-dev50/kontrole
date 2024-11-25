@php
   $enc = new App\Classes\Enc; 
use Carbon\Carbon;
@endphp
<x-app-layout>
 
    <x-slot name="header">
              
        <div class="flex flex-wrap ">
           
          
          
       

        <div class="pl-2">
            @php
            $total_entrada = DB::table('moviments')->where([['tipo', '=', 'E'],['user_id', '=', Auth::user()->id ]] )->sum('valor');
            $total_saida = DB::table('moviments')->where([['tipo', '=', 'S'],['user_id', '=', Auth::user()->id ]])->sum('valor');

            $saldo = $total_entrada - $total_saida;

           
        @endphp
        
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
  

                        <div class="py-4">
                            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        <p class=" items-center px-3 py-2 border border-transparent text-xl leading-4 font-medium rounded-md text-gray-500 bg-white">
                                            Formulário para cadastro de despesas e receitas.
                                            </p>
                                        <form action="{{ route('controle.store') }}" method="post">
 
                      
                                            @csrf
                
                                            <div class="grid xl:grid-cols-8 xl:gap-6">
                                                <div class="relative z-0 w-full mb-6 group">
                                                    <select id="countries" name="etiqueta" class="bg-gray-200 border  bg-gray-200 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                  
                                                    <option selected value="Não Selecionado">Selecionar</option>
                                                    <option value="Pessoal">Despesas: Pessoal</option>
                                                    <option value="Saúde">Despesas: Saúde</option>
                                                    <option value="Carro">Despesas: Carro</option>
                                                    <option value="Educação">Despesas: Educação</option>
                                                    <option value="Casa">Despesas: Casa</option>
                                                    <option value="Lazer">Despesas: Lazer</option>
                                                    <option value="Cartão">Despesas: Cartão</option>
                                                    <option value="Empresa">Despesas: Empresa</option>
                                                    <option value="Renda">Receita: Renda</option>
                                                    <option value="Renda Extra">Receita: Renda Extra</option>
                                                    <option value="Venda">Receita: Venda</option>
                                                    <option value="Investimento">Meta: Investimento</option>
                                                    </select>
                                                  
                                                </div>
                                                <div class="relative z-0 w-full mb-6 group">
                                                <input type="text" id="motivo" name="motivo" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"   placeholder= "Motivo" value="{{old('motivo')}}">
                                                <x-input-error :messages="$errors->get('motivo')" class="mt-2" />
                                            </div>
                                               <div class="relative z-0 w-full mb-6 group">
                                            
                                                    <input type="text" id="valor" name="valor" size="12" onKeyUp="mascaraMoeda(this, event)" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder= "Valor" value="{{old('valor')}}">
                                                    <x-input-error :messages="$errors->get('valor')" class="mt-2" />
                                                </div>
                                               
                                                <div class="relative z-0 w-full mb-6 group">
                                                    <select id="countries" name="dia"
                                                      class="bg-gray-200 border  bg-gray-200 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                     
                                                      <option selected value="{{date('d')}}">Hoje</option>
                                                       
                                                      <option value="1">Dia 1</option>
                                                      <option value="2">Dia 2</option>
                                                      <option value="3">Dia 3</option>
                                                      <option value="4">Dia 4</option>
                                                      <option value="5">Dia 5</option>
                                                      <option value="6">Dia 6</option>
                                                      <option value="7">Dia 7</option>
                                                      <option value="8">Dia 8</option>
                                                      <option value="9">Dia 9</option>
                                                      <option value="10">Dia 10</option>
                                                      <option value="11">Dia 11</option>
                                                      <option value="12">Dia 12</option>
                                                      <option value="13">Dia 13</option>
                                                      <option value="14">Dia 14</option>
                                                      <option value="15">Dia 15</option>
                                                      <option value="16">Dia 16</option>
                                                      <option value="17">Dia 17</option>
                                                      <option value="18">Dia 18</option>
                                                      <option value="19">Dia 19</option>
                                                      <option value="20">Dia 20</option>
                                                      <option value="21">Dia 21</option>
                                                      <option value="22">Dia 22</option>
                                                      <option value="23">Dia 23</option>
                                                      <option value="24">Dia 24</option>
                                                      <option value="25">Dia 25</option>
                                                      <option value="26">Dia 26</option>
                                                      <option value="27">Dia 27</option>
                                                      <option value="28">Dia 28</option>
                                                      <option value="29">Dia 29</option>
                                                      <option value="30">Dia 30</option>
                                                      <option value="31">Dia 31</option>
                
                                                       
                                                        
                                                        </select>
                                                  </div>
                                                  <div class="relative z-0 w-full mb-6 group">
                                                    <select id="countries" name="omes" class="bg-gray-200 border  bg-gray-200 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                  
                                                        <option selected value="{{date('m')}}">Mês Atual</option>
                                                        <option value="1">Janeiro</option>
                                                        <option value="2">Fevereiro</option>
                                                        <option value="3">Março</option>
                                                        <option value="4">Abril</option>
                                                        <option value="5">Maio</option>
                                                        <option value="6">Junho</option>
                                                        <option value="7">Julho</option>
                                                        <option value="8">Agosto</option>
                                                        <option value="9">Setembro</option>
                                                        <option value="10">Outubro</option>
                                                        <option value="11">Novembro</option>
                                                        <option value="12">Dezembro</option>
                                                        
                                                        </select>
                                                  </div>
                                                  <div class="relative z-0 w-full mb-6 group">
                                                    <select name="oano" id="selectAno" class="bg-gray-200 border  bg-gray-200 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <?php
                                                        // Obtenha o ano atual
                                                        $anoAtual = date("Y");
                                                    
                                                        // Loop para adicionar as opções de ano ao elemento <select>
                                                        for ($ano = $anoAtual; $ano <= $anoAtual + 5; $ano++) {
                                                            echo "<option value='$ano'>$ano</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                  </div>
                                                <div class="relative z-0 w-full mb-6 group">
                
                                                   <input type="Number" id="parcelas" name="parcelas" maxlength="3" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder= "Numero Vezes" value="{{ old('parcelas') }}">
                                                   <x-input-error :messages="$errors->get('parcelas')" class="mt-2" />
                                                </div>
                                               
                                                <div class="relative z-0 w-full mb-6 group">
                                                @if(isset($dinheiro))
                
                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ATUALIZAR</button>
                                                @else
                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">CADASTRAR
                                                </button>
                                                @endif
                                                </div>
                                            </div>
                                                                  
                                        </form>
                                     <br>
                       
                             
                         <!-----------fim-------->
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

 <!-- Inclua a biblioteca Chart.js -->
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 


 



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
