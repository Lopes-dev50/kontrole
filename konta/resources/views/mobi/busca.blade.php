
@php
    $enc = new App\Classes\Enc;
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row ">
        <a href="{{route('controle.index')}}">
            <div class="pl-2">
            <div  class=" py-1 px-2 mr-2 bg-green-700 hover:bg-green-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">
                {{ __('Inicio') }}
            </div>
            </div>
        </a>
       
           
            <a href="{{route('busca.mes')}}">
                <div class="pl-2">
                <div  class=" py-1 px-2 mr-2 bg-yellow-500 hover:bg-yellow-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">
                    {{ __('Filtro') }}
                </div>
                </div>
            </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid xl:grid-cols-6 xl:gap-6">
                        @foreach ($filtros as $mes)
                        <div class="relative z-0 w-full mb-6 group">
                   
                    <a href="{{ route ('cada.mes', ['mes' => $enc->encriptar($mes->month), 'ano' => $enc->encriptar($mes->year) ])}}">
                       <div class="pl-1">
                        <div  class=" py-1 px-1  mr-1 bg-indigo-700 hover:bg-green-600 focus:ring-green-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-sm font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg">
                             {{ $mes->month_year }}
                        </div>
                       </div>
                    </a>
                        </div>
                @endforeach
               
           
                    </div>
                   
                 
                  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

