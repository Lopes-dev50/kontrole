@php
    $enc = new App\Classes\Enc;
use Carbon\Carbon;
@endphp

<x-app-layout>
  <x-slot name="header">
      <div class="flex flex-row ">
         
          <a href="{{route('controle.index')}}">
              <div class="pl-2">
              <div  class=" py-1 px-2 mr-2 bg-indigo-700 hover:bg-indigo-600 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">
                  {{ __('Voltar') }}
              </div>
              </div>
          </a>
      </div>
  </x-slot>

  
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                     <!----------inicio------>

                  
                      @foreach ($dinheiros as $item)
                     
                     
                      <form action="{{ route('controle.update',['id' =>$enc->encriptar($item->id), 'mes' => $enc->encriptar(\Carbon\Carbon::parse($item->data)->format('m')), 'ano' => $enc->encriptar(\Carbon\Carbon::parse($item->data)->format('Y'))] ) }} " method="post"
                        enctype="multipart/form-data">
                        @csrf
                      <div class="grid xl:grid-cols-7 xl:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                          <label for="name-with-label" class="text-gray-700">
                            Dia
                        </label>
                          <select id="countries" name="dia"
                                        class="bg-gray-200 border  bg-gray-200 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>{{$item->dia ?? 'Selecionar'}}</option>
                                        @php
                                          for ($i = 1; $i <= 31; $i++) {
                                            echo "<option value='$i'>Dia $i </option>";
                                          }
                                        @endphp
                                      </select>
                      </div>


                      <div class="relative z-0 w-full mb-6 group">
                        <label for="name-with-label" class="text-gray-700">
                          Mes
                      </label>
                        <select id="countries" name="omes" class="bg-gray-200 border  bg-gray-200 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                          <option value="{{ date('m', strtotime($item->data ?? 'last day of this month')) ?? ''}}" selected>{{ date('m', strtotime($item->data ?? 'last day of this month')) ?? 'Selecionar' }}</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            
                            </select>
                      </div>
                      <div class="relative z-0 w-full mb-6 group">
                        <label for="name-with-label" class="text-gray-700">
                          Ano
                      </label>
                        <select name="oano" id="selectAno" class="bg-gray-200 border  bg-gray-200 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                          <option value="{{$item->data ?? ''}}" selected>{{ date('Y', strtotime($item->data ?? '')) ?? 'Selecionar' }}</option>
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
                          <label for="name-with-label" class="text-gray-700">
                            Etiqueta
                        </label>
                          <select id="countries" name="etiqueta"
                          class="bg-gray-200 border  bg-gray-200 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                         
                          <option selected>{{$item->etiqueta ?? 'Selecionar'}}</option>
                                    <option value="Pessoal">Despesas: Pessoal</option>
                                    <option value="Saúde">Despesas: Saúde</option>
                                    <option value="Carro">Despesas: Carro</option>
                                    <option value="Educação">Despesas: Educação</option>
                                    <option value="Casa">Despesas: Casa</option>
                                    <option value="Lazer">Despesas: Lazer</option>
                                    <option value="Cartão">Despesas: Cartão</option>
                                    <option value="Empresa">Despesas: Empresa</option>
                                    <option value="Salário">Receita: Sálario</option>
                                    <option value="Renda Extra">Receita: Renda Extra</option>
                                    <option value="Venda">Receita: Venda</option>
                                    <option value="Investimento">Investimento</option>
                          </select>
                        
                      </div>
                      
                       <div class="relative z-0 w-full mb-6 group">
                        <label for="name-with-label" class="text-gray-700">
                          Motivo
                      </label>
                         <input type="text" id="motivo" name="motivo" class="shadow-sm  bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  value= "{{$item->motivo }}">
                       </div>
                    <div class="relative z-0 w-full mb-6 group">
                      <label for="name-with-label" class="text-gray-700">
                        Valor
                    </label>
                        <input type="text" id="valor" name="valor" size="12" onKeyUp="mascaraMoeda(this, event)" class="shadow-sm  bg-gray-200  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value= "{{number_format($item->valor/100, 2, ',', '.') }}">
                    </div>
                   
                    
                   <div class="relative z-0 w-full mb-6 group">
                    <label for="name-with-label" class="text-gray-700">
                      Status
                  </label>
                    <select id="countries" name="pago"
                    class="bg-{{ $item->pago == 'N' ? 'red' : 'green' }}-500 border  bg-gray-200 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>{{ $item->pago == 'N' ? 'Pagar' : 'Pago' }}</option>
                    <option value="S">Pago</option>
                    <option value="N">Pagar</option>
                    </select>
                  
                </div>
                   <div class="relative z-0 w-full mb-6 group">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ATUALIZAR
                    </button>
                   </div>
                </form>
                      
                       <div class="relative z-0 w-full mb-6 group">
                        <a href="{{ route ('destroy', ['id' =>$enc->encriptar($item->id), 'mes' => $enc->encriptar(\Carbon\Carbon::parse($item->data)->format('m')), 'ano' => $enc->encriptar(\Carbon\Carbon::parse($item->data)->format('Y'))])}}">
                        <p  class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">EXCLUIR
                        </p>
                        </a>
                       </div>
                    </div>
               
                      @endforeach
                        
                       
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
  
   
</x-app-layout>