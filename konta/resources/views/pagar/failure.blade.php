<x-app-layout>
    <x-slot name="header">
        <p class="font-sans font-light text-xl text-red-500">Falha!</p>
   </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <!----------inicio------>
                   <p class="font-sans font-light text-2xl text-red-500"> Pagamento não realizado.</p> 
               
                   <x-dropdown-link :href="route('dashboard')">
                    <x-secondary-button class="ml-3">
                        {{ __('Voltar') }}
                    </x-secondary-button>
                </x-dropdown-link>
                   <!-----------fim-------->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

