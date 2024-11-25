<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex flex-wrap">
                        <div class="w-full md:flex">
                            <div class="w-full md:w-1/2">
                                <div class="flex justify-center md:justify-start md:pl-12">
                                   
                                </div>
                                <div class="flex flex-col justify-center px-8 pt-8 md:pt-0 md:px-24 lg:px-32">
                                    <h1 class="text-3xl text-center">Confira os dados</h1>
                                  
                                    
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <img class="object-cover w-full h-auto md:h-screen" src="{{ Vite::asset('resources/imgSite/telaspix.png') }}" alt="Imagem do Pix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script></script
</x-app-layout>