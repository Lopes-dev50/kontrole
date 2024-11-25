<!DOCTYPE html>
@php
$enc = new App\Classes\Enc;
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Kontole</title>
    <meta name="description" content="Aproveite a oportunidade de melhorar sua organização financeira com a plataforma Kontrole. Gerencie suas finanças de forma eficiente, aproveitando nosso bônus exclusivo. Compartilhe com amigos e familiares em www.kontrole.com.br e juntos alcançaremos estabilidade financeira e sucesso." />
    <meta name="keywords" content="organização financeira, gerenciamento financeiro, plataforma Kontrole, bônus exclusivo, estabilidade financeira, sucesso, www.kontrole.com.br">
    <meta name="author" content="Equipe Kontrole" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <!--Replace with your tailwind.css once created-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <style>
    .gradient {
        background: linear-gradient(90deg, #041b76 0%, #375d9f 100%);
    }
    </style>
</head>

<body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">
    <!--Nav-->
    <nav id="header" class="fixed w-full z-30 top-0 text-white">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
            <div
                class="pl-4  flex items-center  toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl">
                <img src="{{ Vite::asset('resources/imgSite/logo_crm.png') }}" class="w-10 h-10 fill-current text-gray-500 mr-4" /> 
                Kontrole
            </div>
            <div class="block lg:hidden pr-4">
                <button id="nav-toggle"
                    class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20"
                id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                   

                </ul>

                @if (Route::has('login'))

                @auth
                <a href="{{ url('/dashboard') }}">

                    <button id="navAction"
                        class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                        Dashboard
                    </button>
                </a>
                @else
                <a href="{{ route('login') }}">
                    <button id="navAction"
                        class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                        Logar
                    </button>
                </a>
                @endauth
                @endif


            </div>
        </div>
        <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
    </nav>
    <!--Hero-->
    <div class="pt-24">
        <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
          <!--Left Col-->
          <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
            <p class="uppercase tracking-loose w-full">Para quem serve esta plataforma?</p>
            <h1 class="my-4 text-5xl font-bold leading-tight">
             Tenha controle total de suas contas!
            </h1>
            <p class="leading-normal text-2xl mb-12">
              Comece hoje mesmo criando sua conta no plano GRATUITO.
            </p>
           
          </div>
          <!--Right Col-->
          <div class="w-full md:w-3/5 py-6 text-center">
            <img class="w-full md:w-4/5 z-50 rounded-lg" src="{{ Vite::asset('resources/imgSite/tela.png') }}" />
          </div>
        </div>
      </div>


    <!---------------------------------------->
    <section class="container mx-auto text-center py-6 mb-12">
    </a>
     
      <div class="w-full mb-4">
        <div class="h-1 mx-auto bg-white w-1/2 opacity-25 my-0 py-0 rounded-t"></div>
      </div>
      <h3 class="my-4 text-1xl leading-tight">
        Se você está cansado de se sentir sobrecarregado com suas finanças e está procurando uma maneira mais fácil de gerenciar suas contas e manter sua vida financeira organizada, você veio ao lugar certo! Com o gerenciamento financeiro, pode ajudá-lo a manter suas finanças sob controle e garantir que você esteja sempre no controle de suas contas.
        <p>
        Você pode monitorar todas as suas contas em um só lugar, acompanhar suas despesas e receitas, oferece recursos de segurança avançados para garantir que suas informações financeiras sejam mantidas em segurança.
        </p>
        <p>
        Ao contratar meu serviço, você receberá alertas automáticos para garantir que nunca perca um pagamento importante ou exceda o limite do seu orçamento.
       </h3>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white w-1/4 opacity-25 my-0 py-0 rounded-t"></div>
          </div>
          <h3 class="my-4 text-2xl leading-tight">
        Não deixe que suas finanças fiquem fora de controle. Contrate plataforma de gerenciamento financeiro hoje e comece a viver uma vida financeira mais organizada e sem estresse! 
      </h3>
      <a href="{{ route('register') }}">
        <button class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
          CRIAR SUA CONTA AGORA GENHA 30 DIAS NO PLANO GOLD!
        </button>
      </a>
    </section>
    <!----------------novatela---------->





    <!--------------fimnovatela---------->
   


                </div>
                <!--Footer-->
                <footer class="p-4 bg-white  shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-900">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a
                            href="https://clientecorretor.com.br/" class="hover:underline">ClienteCorretor™</a>. All
                        Rights Reserved. - Frederico Dhill 1001 Alvorada - RS
                    </span>
                    <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">

                        <li>
                            <a href="{{ url('/privacidade') }}" class="mr-4 hover:underline md:mr-6">Politica de
                                privacidade</a>
                        </li>
                        <li>
                            <a href="{{ url('/termo') }}" class="mr-4 hover:underline md:mr-6">Termo uso</a>
                        </li>

                    </ul>
                </footer>
                <link rel="stylesheet" type="text/css"
                    href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
                <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
                <script>
                window.addEventListener("load", function() {
                    window.cookieconsent.initialise({
                        "palette": {
                            "popup": {
                                "background": "#000"
                            },
                            "button": {
                                "background": "#FFC601",
                                "text": "#000000",
                                "border": "#FFC601"
                            }
                        },
                        "position": "bottom-left",
                        "content": {
                            "message": "Usamos cookies para garantir que você obtenha a melhor experiência no nosso site.Ao continuar a usar nosso site, você aceita nossa política de cookies.",
                            "dismiss": "Entendi!",
                            "link": "Leia Mais.",
                            "href": "https://www.clientecorretor.com.br/privacidade"
                        }
                    })
                });
                </script>

                <!-- jQuery if you need it
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  -->
                <script>
                var scrollpos = window.scrollY;
                var header = document.getElementById("header");
                var navcontent = document.getElementById("nav-content");
                var navaction = document.getElementById("navAction");
                var brandname = document.getElementById("brandname");
                var toToggle = document.querySelectorAll(".toggleColour");

                document.addEventListener("scroll", function() {
                    /*Apply classes for slide in bar*/
                    scrollpos = window.scrollY;

                    if (scrollpos > 10) {
                        header.classList.add("bg-white");
                        navaction.classList.remove("bg-white");
                        navaction.classList.add("gradient");
                        navaction.classList.remove("text-gray-800");
                        navaction.classList.add("text-white");
                        //Use to switch toggleColour colours
                        for (var i = 0; i < toToggle.length; i++) {
                            toToggle[i].classList.add("text-gray-800");
                            toToggle[i].classList.remove("text-white");
                        }
                        header.classList.add("shadow");
                        navcontent.classList.remove("bg-gray-100");
                        navcontent.classList.add("bg-white");
                    } else {
                        header.classList.remove("bg-white");
                        navaction.classList.remove("gradient");
                        navaction.classList.add("bg-white");
                        navaction.classList.remove("text-white");
                        navaction.classList.add("text-gray-800");
                        //Use to switch toggleColour colours
                        for (var i = 0; i < toToggle.length; i++) {
                            toToggle[i].classList.add("text-white");
                            toToggle[i].classList.remove("text-gray-800");
                        }

                        header.classList.remove("shadow");
                        navcontent.classList.remove("bg-white");
                        navcontent.classList.add("bg-gray-100");
                    }
                });
                </script>
                <script>
                /*Toggle dropdown list*/
                /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

                var navMenuDiv = document.getElementById("nav-content");
                var navMenu = document.getElementById("nav-toggle");

                document.onclick = check;

                function check(e) {
                    var target = (e && e.target) || (event && event.srcElement);

                    //Nav Menu
                    if (!checkParent(target, navMenuDiv)) {
                        // click NOT on the menu
                        if (checkParent(target, navMenu)) {
                            // click on the link
                            if (navMenuDiv.classList.contains("hidden")) {
                                navMenuDiv.classList.remove("hidden");
                            } else {
                                navMenuDiv.classList.add("hidden");
                            }
                        } else {
                            // click both outside link and outside menu, hide menu
                            navMenuDiv.classList.add("hidden");
                        }
                    }
                }

                function checkParent(t, elm) {
                    while (t.parentNode) {
                        if (t == elm) {
                            return true;
                        }
                        t = t.parentNode;
                    }
                    return false;
                }
                </script>


</body>

</html>