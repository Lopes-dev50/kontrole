

<x-app-layout>
    <x-slot name="header">
        <p class="pl-2 items-center px-3 py-2 border border-transparent text-xl leading-4 font-medium rounded-md text-gray-500 bg-white">{{ __('Suporte: whatsapp:  (51) 99960-6937 ') }}</p>
    </x-slot>
    @if(Auth::user()->plano == 'Gold+Bônus')
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                
                 <div class="bg-white  rounded-lg">
    <div class="text-center w-full mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 z-20">
        <h2 class="text-2xl font-extrabold text-black  sm:text-4xl">
            <span class="block">
                É com grande prazer que anunciamos uma ótima notícia para você!
            </span>
            <span class="block text-indigo-500 text-1xl">
                A partir de agora, você terá acesso GRATUITO ao nosso sistema Kontrole por TRÊS MESES!
            </span>
        </h2>
        <p class="text-xl mt-4 max-w-md mx-auto text-gray-400">
            Compartilhe a oportunidade de uma melhor organização financeira com seus amigos, familiares e colegas! 
            Convide-os para conhecer a plataforma Kontrole e aproveitar o mesmo bônus exclusivo que você recebeu.

        </p>
        <div class="lg:mt-0 lg:flex-shrink-0">
            <div class="mt-12 inline-flex rounded-md shadow">
                <p class="py-4 px-6  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                    Parabéns novamente pelo bônus e aproveite os benefícios do Kontrole!
                </p>
            </div>
        </div>
    </div>
</div>
                  
                 
                </div>
            </div>
        </div>
    </div>
    @endif
  
   
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <!----------inicio---->
                  @switch($h = \Carbon\Carbon::parse (Auth::user()->created_at)->diffInDays(date("Y-m-d H:i:s")))
                  @case(0)
                  <div class="bg-white dark:bg-gray-800 rounded-lg ">
                    <div class="text-center w-full mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 z-20">
                        <h2 class="text-2xl font-extrabold text-black dark:text-white sm:text-4xl">
                            <span class="block">
                                ATENÇÃO
                            </span>
                            <span class="block text-gray-400">
                                <p>Enviamos um e-mail importante para você e gostaríamos de pedir que verifique sua pasta de spam</p>
                                Pode ser que nossa mensagem tenha sido redirecionada incorretamente.
                                Adicione nosso e-mail a sua lista de contatos: aviso@kontrole.com.br para garantir que vai receber todas as notificações.
                            </span>
                        </h2>
                        <div class="lg:mt-0 lg:flex-shrink-0">
                            <div class="mt-12 inline-flex rounded-md shadow">
                                <a href="https://www.youtube.com/watch?v=liwy_FaK884" target="_blank">
                                <button type="button" class="py-4 px-6 pt-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                   VEJA O VÍDEO COMO FUNCIONA 
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @break

                @case(1)
                <div class="bg-white dark:bg-gray-800 rounded-lg ">
                    <div class="text-center w-full mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 z-20">
                        <h2 class="text-2xl font-extrabold text-black dark:text-white sm:text-4xl">
                            <span class="block">
                                Você Sabia?
                            </span>
                            <span class="block text-gray-400">
                                <p>Que vai receber um e-mail sempre no dia do vencimento de suas contas.</p>
                              
                            </span>
                        </h2>
                        <div class="lg:mt-0 lg:flex-shrink-0">
                            <div class="mt-12 inline-flex rounded-md shadow">
                                <a href="https://www.youtube.com/watch?v=liwy_FaK884" target="_blank">
                                <button type="submit" class="py-4 px-6 pt-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                   VEJA O VÍDEO COMO FUNCIONA 
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @break

                @default
                <div class="bg-white dark:bg-gray-800 rounded-lg ">
                    <div class="text-center w-full mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 z-20">
                        <h2 class="text-2xl font-extrabold text-black dark:text-white sm:text-4xl">
                            <span class="block">
                                Compartilhe!
                            </span>
                            <span class="block text-gray-400">
                                <p> A oportunidade de uma melhor organização financeira com seus amigos, familiares e colegas!  </p>
                              
                            </span>
                        </h2>
                        <div class="lg:mt-0 lg:flex-shrink-0">
                            <div class="mt-12 inline-flex rounded-md shadow">
                                <a href="https://www.youtube.com/watch?v=liwy_FaK884" target="_blank">
                                    <button type="button" class="py-4 px-6 pt-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                       VEJA O VÍDEO COMO FUNCIONA 
                                    </button>
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
                 @endswitch
                 <!------fim------->
                </div>
            </div>
        </div>
    </div>



</x-app-layout>

