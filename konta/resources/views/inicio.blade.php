<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
     Kontrole
    </title>
    <meta name="description" content="Aproveite a oportunidade de melhorar sua organização financeira com a plataforma Kontrole. Gerencie suas finanças de forma eficiente, aproveitando nosso bônus exclusivo. Compartilhe com amigos e familiares em www.kontrole.com.br e juntos alcançaremos estabilidade financeira e sucesso." />
    <meta name="keywords" content="organização financeira, gerenciamento financeiro, plataforma Kontrole, bônus exclusivo, estabilidade financeira, sucesso, www.kontrole.com.br">
    <meta name="author" content="Equipe Kontrole" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <!--Replace with your tailwind.css once created-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
    <style>
      .gradient {
        background: linear-gradient(90deg, #026824 0%, #296c02 100%);
      }
    </style>
  </head>
  <body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">
    <!--Nav-->
    <nav id="header" class="fixed w-full z-30 top-0 text-white">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
        <div class="pl-4 flex items-center">
        <img src="{{ Vite::asset('resources/imgSite/konta.png') }}" class="w-10 h-10 fill-current text-gray-500 mr-4" /> 
            
               </div>
               <h3 class="text-green-600 text-3xl "> Kontrole </h3>
        <div class="block lg:hidden pr-4">
          <button id="nav-toggle" class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
          <ul class="list-reset lg:flex justify-end flex-1 items-center">
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
          </ul>
         
        </div>
      </div>
   
    </nav>
    <!--Hero-->
    <div class="pt-32 bg-cover bg-no-repeat bg-center " style="background-image: url({{ Vite::asset('resources/imgSite/ela.jpg') }})">
        <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
          <!--Left Col-->
          <div class="flex flex-col w-full md:w-1/2 justify-center items-start text-center md:text-left md:order-last">
            <p class="uppercase tracking-loose">Você cuida bem do seu dinheiro?</p>
            <h1 class="my-4 text-5xl font-bold leading-tight">
                Controle seus gastos, evite dívidas!
            </h1>
            <p class="leading-normal text-2xl mb-8">
                Organizar as finanças é crucial para alcançar objetivos a longo prazo!
            </p>
            <a href="{{ route('register') }}">
            <button class="mx-auto lg:mx-0 hover:underline bg-white text-green-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                CRIAR SUA CONTA AGORA GENHE 60 DIAS NO PLANO GOLD!
            </button>
            </a>
          </div>
          <!--Right Col-->
          <div class="w-full md:w-1/2 py-6 md:py-0 md:pl-16">
            <!-- Add your content here -->
          </div>
        </div>
      </div>
   
    <section class="bg-white border-b py-8">
        <div class="align-middle">
        <h3 class="py-2 pl-8 text-3xl text-green-800 font-bold leading-none mb-3">
            Está procurando uma maneira mais fácil de gerenciar suas contas?
          </h3>
        </div>
        <div class="pl-4 w-full sm:w p-6 mt-6">
            <img class="w-full md:w  rounded-lg" src="{{ Vite::asset('resources/imgSite/tela.png') }}" />
          </div>
     
    </section>
    <section class="container mx-auto text-center py-6 mb-12">
      <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">
        Você veio ao lugar certo!
      </h2>
      <div class="w-full mb-4">
        <div class="h-1 mx-auto bg-white w-1/2 opacity-25 my-0 py-0 rounded-t"></div>
      </div>
      <h3 class="my-4 text-2xl leading-tight">
        <P>
            Como o gerenciamento financeiro, pode ajudá-lo a manter suas finanças sob controle.
             </p>
             <p>
             Você pode monitorar todas as suas contas em um só lugar, acompanhar suas despesas e receitas, oferece recursos de segurança avançados para garantir que suas informações financeiras sejam mantidas em segurança.
             </p>
             <p>
             Ao contratar o serviço, você receberá alertas automáticos para garantir que nunca perca um pagamento importante.
             </p>  
      </h3>
      <h3 class="my-4 text-2xl leading-tight">
        <P>
            Receba notificações por e-mail sobre contas a pagar.
             </p>
           
      </h3>
     
      <a href="{{ route('register') }}">
      <button class="mx-auto lg:mx-0 hover:underline bg-white text-green-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
        CRIAR SUA CONTA AGORA, GANHE 60 DIAS NO PLANO GOLD!
      </button>
      </a>
     <br>
      <br>
       <a href="https://www.youtube.com/watch?v=liwy_FaK884" target="_blank">
      <button class="mx-auto lg:mx-0 hover:underline bg-white text-green-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
       VEJA COMO FUNCIONA A PLATAFORMA
      </button>
      </a>
    </section>
    <!--Footer-->
    <!------fim------->

    <footer class="px-3 py-8 text-gray-500 transition-colors duration-200 bg-black dark:bg-gray-800 text-2 dark:text-gray-200">
      <div class="flex flex-col">
          <div class="h-px mx-auto rounded-full md:hidden mt-7 w-11">
          </div>
          <div class="flex flex-col mt-4 md:mt-0 md:flex-row">
              <nav class="flex flex-col items-center justify-center flex-1 border-gray-100 md:items-end md:border-r md:pr-5">
                  <a aria-current="page" href="{{ url('/planos') }}" class="hover:text-gray-700 dark:hover:text-white">
                      Planos e preços
                      
                  </a>
                  <a aria-current="page" href="{{ url('/privacidade') }}" class="hover:text-gray-700 dark:hover:text-white">
                      Politica de privacidade
                  </a>
                  <a aria-current="page" href="{{ url('/termo') }}" class="hover:text-gray-700 dark:hover:text-white">
                      Termo uso
                  </a>
              </nav>
              <div class="h-px mx-auto mt-4 rounded-full md:hidden w-11">
              </div>
              <div class="flex items-center justify-center flex-1 mt-4 border-gray-100 md:mt-0 md:border-r">
                whatsapp:  (51) 99960-6937 
               
                 
              </div>
              <div class="h-px mx-auto mt-4 rounded-full md:hidden w-11 ">
              </div>
              <div class="flex flex-col items-center justify-center flex-1 mt-7 md:mt-0 md:items-start md:pl-5">
                  <span class="">
                      © {{$ano = date('Y');}}
                  </span> <a  href="https://kontrole.com.br/" class="hover:underline">Kontrole™</a>
                  <span class="mt-7 md:mt-1">
                     All
                  Rights Reserved. - Frederico Dhill 1001 Alvorada - RS
                  </span>
              </div>
          </div>
      </div>
  </footer>
  
  
  
  
     <!-------fimfim---->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
    <script>
    window.addEventListener("load", function(){
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
        "link":"Leia Mais.",
          "href": "https://www.kontrole.com.br/privacidade"
          }
    })});
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

      document.addEventListener("scroll", function () {
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