@php

require base_path('vendor/autoload.php');
// Adicione as credenciais
MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

// Cria um objeto de preferência
$preference = new MercadoPago\Preference();

//Meios de pagamento
$preference->payment_methods = array(
    "excluded_payment_types" => array(
        array("id" => "bolbradesco")
    ),
    "excluded_payment_types" => array(
        array("id" => "lottery"),
        array("id" => "ticket"),
        array("id" => "debit_card")
    ),
   
    "excluded_payment_methods" => array(
        array("id" => "visa"),
        array("id" => "master"),
        array("id" => "amex"),
        array("id" => "hipercard"),
        array("id" => "elo")
    ),
  "installments" => 1
);
$total = $valor ;
// Cria um item na preferência
$item = new MercadoPago\Item();

//$item->id = $user->id;
//$item->title = $user->cpf.' Recarga';
$item->quantity = 1;
$item->description = $valor;
$item->category_id = $valor;
$item->unit_price = $total;

$preference->back_urls = array(
    "success" => route('pay', $user->id ),
    "failure" => route('pay', $user->id ),
    "pending" => route('pay', $user->id )
);
$preference->auto_return = "approved";

$preference->items = array($item);
$preference->save();

@endphp

<x-app-layout>
    <x-slot name="header">
        @php
        $enc = new App\Classes\Enc;
        @endphp
            @if(session()->get('success'))
           <div class="container bg-green-500 flex items-center text-white text-sm font-bold px-4 py-3 relative" role="alert">
             <svg width="20" height="20" fill="currentColor" class="w-4 h-4 mr-2" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                 <path d="M1216 1344v128q0 26-19 45t-45 19h-512q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h64v-384h-64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h384q26 0 45 19t19 45v576h64q26 0 45 19t19 45zm-128-1152v192q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-192q0-26 19-45t45-19h256q26 0 45 19t19 45z">
                 </path>
             </svg>
             <p>
             {{ session()->get('success') }}
           </div>
         @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!----------->
                    <div class="p-4 w-full text-center bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Confira seus dados</h5>
                       
                       @foreach ($users as $user)
                           
                       @endforeach
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Nome: {{$user->name}}</p>
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">CPF: {{$user->cpf}}</p>
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">E-mail: {{$user->email}}</p>
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Valor:R$ {{$valor}},00</p>
                        <div class="justify-center items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                            @endforeach
                        <div class="cho-container">

                        </div>
                        </div>
                    </div>
                    <!------------>
                  </div>
              </div>
           </div>
         </div>
         <script src="https://sdk.mercadopago.com/js/v2"></script>
         <script>
            // Adicione as credenciais do SDK
              const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                    locale: 'pt-BR'
              });

              // Inicialize o checkout
              mp.checkout({
                  preference: {
                      id: '{{$preference->id}}'
                  },
                  render: {
                        container: '.cho-container', // Indique o nome da class onde será exibido o botão de pagamento
                        label: 'Pagar', // Muda o texto do botão de pagamento (opcional)
                  }
            });
            </script>
</x-app-layout>


