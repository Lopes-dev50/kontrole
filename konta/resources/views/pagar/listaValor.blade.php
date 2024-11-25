@php
    require base_path('vendor/autoload.php');
    // Adicione as credenciais
    MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

    // Cria um objeto de preferência
    $preference = new MercadoPago\Preference();

    // Meios de pagamento
    $preference->payment_methods = array(
        "excluded_payment_types" => array(
            array("id" => "bolbradesco"),
            array("id" => "ticket" )
        ),
        "excluded_payment_methods" => array(
            array("id" => "amex"),
            array("id" => "hipercard"),
            array("id" => "elo")
        ),
        "installments" => 4
    );

    $total = $valor;

    // Cria um item na preferência
    $item = new MercadoPago\Item();
    $item->id = Auth::user()->id;
    $item->title = 'Plano Gold';
    $item->quantity = 1;
    $item->description = $valor;
    $item->category_id = $valor;
    $item->unit_price = $total;

    $preference->back_urls = array(
        "success" => route('pay', Auth::user()->id),
        "failure" => route('pay', Auth::user()->id),
        "pending" => route('pay', Auth::user()->id)
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
      

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Financeiro') }}
    </h2>
</x-slot>
<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex flex-wrap">
                    <div class="w-full md:flex">
                        <div class="w-full md:w-1/2">
                           
                            <div class="flex flex-col justify-center px-8 pt-8 md:pt-0 md:px-24 lg:px-32">
                                <h1 class="text-4xl text-center font-bold mb-8">Confira os dados.</h1>
                                @foreach ($usuario as $user)
                                    <div class="mb-4">

                                        <div class="flex flex-col mb-2">
                                            <div class="relative">
                                                <input type="text" id="create-account-pseudo" class="rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="{{$user->name}}"/>
                                            </div>
                                        </div>
                                        <div class="flex flex-col mb-2">
                                            <div class="relative">
                                                <input type="text" id="create-account-pseudo" class="rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="{{$user->email}}"/>
                                            </div>
                                        </div>
                                        <div class="flex gap-4 mb-2">
                                            <div class="relative">
                                                <input type="text" id="create-account-first-name" class="rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="Plano Gold"/>
                                            </div>
                                            <div class="relative">
                                                <input type="text" id="create-account-last-name" class="rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="Valor: R$ {{$valor}},00"/>
                                            </div>
                                        </div>
                                        <div class="flex flex-col mb-2">
                                            @endforeach
                                            <div class="flex w-full my-4 ">
                                             
                                                    <form action="{{ $preference->sandbox_init_point }}" method="POST">
                                                        @csrf
                                                     
                                                        <script
                                                            src="https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js"
                                                            data-preference-id="{{ $preference->id }}"
                                                            data-button-label="{{ __('REALIZAR PAGAMENTO') }}">
                                                        </script>
                                                      
                                                    </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <div class="w-full md:w-1/2">
                                        <img class="object-contain max-w-full h-auto" src="{{ Vite::asset('resources/imgSite/telaspix.png') }}" alt="Imagem do Pix">
                                    </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </x-app-layout>

