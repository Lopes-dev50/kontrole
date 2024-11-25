<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>KONTROLE</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
        <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    </head>
    <body class="antialiased">

            <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5  dark:bg-gray-800">
                <div class="container flex flex-wrap justify-between items-center mx-auto">
                  <a href="https://www.kontrole.com.br/" class="flex items-center">
                      <img src="{{ Vite::asset('resources/imgSite/konta.png') }}" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
                      <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">kontrole</span>
                  </a>
                  <button data-collapse-toggle="mobile-menu" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  </button>
                  <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
                    <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                        <li>
                        @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                            <li>
                                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                            </li>
                                @else
                            <li>
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Logar</a>
                            </li>
                                @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registrar</a>
                                </li>
                                    @endif
                            @endauth
                        </div>
                    @endif
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
              <div class=" relative  h-screen py-5 mx-8">
              <!--------inicio---->
              <p class="pt-4 text-justify">

                <h2 class="font-weight-light text-lg">Termos de Serviço.</h2>
                <p class="pt-4 text-justify">
              ATENÇÃO: ESTE É UM CONTRATO. LEIA ATENTAMENTE ESTES TERMOS ANTES DE USAR ESTE SITE. ESTE CONTRATO GOVERNA SEU RELACIONAMENTO COM O KONTROLE, E O USO DOS SERVIÇOS, DEFINIDO ABAIXO, FORNECIDO A VOCÊ POR KONTROLE. É SOLICITADO QUE VOCÊ ACEITE ESSES TERMOS DE SERVIÇO E PODE USAR OS SERVIÇOS DISPONÍVEIS NESTE SITE APENAS SOB A CONDIÇÃO DE QUE VOCÊ ACEITE TODOS OS TERMOS E CONDIÇÕES AQUI CONTIDOS. USAR ESTE SITE INDICA QUE VOCÊ ACEITA ESTES TERMOS. SE VOCÊ NÃO ACEITAR ESTES TERMOS, NÃO USE ESTE SITE.

      ESTES TERMOS DE SERVIÇO INCLUEM A POLÍTICA DE PRIVACIDADE DA KONTROLE INCORPORADA E FAZ PARTE DESTES TERMOS DE SERVIÇO. AO ACESSAR OU USAR ESTE SITE, VOCÊ CONCORDA COM ESTES TERMOS DE SERVIÇO, INCLUINDO A POLÍTICA DE PRIVACIDADE DA KONTROLE.</p>

      </p>

      <h3 class="pt-4  text-lg" >Aceitação dos Termos de Serviço</h3>
      <p class="pt-4 text-justify">
      Estes Termos de Serviço (o "Contrato" ou "Termos de Serviço") são um contrato legal entre você, um indivíduo ou uma entidade ("você", "seu" ou "usuário") e o KONTROLE ("KONTROLE" , "nós", "nosso" ou "nós") em relação aos Serviços, conforme definido abaixo. KONTROLE significa uma entidade descrita na seção "Parte Contratante" abaixo. A KONTROLE cria este site ( https://www.KONTROLE.com.br) e todos os outros domínios KONTROLE incluídos neste site (o "Site"), incluindo todas as informações, gráficos, documentos, texto, produtos e todos os outros elementos do site e todos os produtos oferecidos neste site e serviços operados através do site, disponíveis para seu uso, sujeito aos termos e condições estabelecidos neste documento. Ao acessar e usar este site, usar qualquer serviço da KONTROLE e / ou fazer o download ou comprar qualquer produto da KONTROLE, você concorda em cumprir e aceitar estes Termos de Serviço e todos os termos e condições contidos e / ou mencionados neste documento ou quaisquer termos e termos adicionais e condições estabelecidas neste site.

      Se você NÃO concorda com todos esses Termos de Serviço, NÃO deve usar este site. Se você NÃO concorda com quaisquer termos específicos adicionais que se aplicam a determinado conteúdo (conforme definido abaixo) ou a transações específicas concluídas através deste site, você NÃO deve usar a parte do site que contém esse conteúdo ou através da qual tais transações podem ser realizadas. concluído e você NÃO deve usar esse Conteúdo ou concluir essas transações. Além disso, quando você usa quaisquer serviços atuais ou futuros do KONTROLE ou visita os sites da KONTROLE ou de suas afiliadas ou obtém quaisquer produtos ou serviços, gratuitamente ou a pagamento, da KONTROLE ou de qualquer empresa afiliada à KONTROLE, incluída ou não no site ,

      Estes Termos de Serviço podem ser alterados pela KONTROLE a qualquer momento, mediante notificação por qualquer um dos seguintes meios: através do Site em ou após o login na sua Conta de Usuário (conforme definido abaixo), através de comunicação por e-mail para o endereço fornecido por você quando você configurou sua conta de usuário. A falha em fornecer ou manter informações de contato precisas ou atuais por você não isentará sua responsabilidade de cumprir com estes Termos de Serviço, conforme alterados de tempos em tempos. Verifique regularmente estes Termos de Serviço publicados neste site para garantir que você esteja ciente de todos os termos que regem o uso deste site. Seu uso continuado dos Serviços indica que você concorda com as alterações.

      Além disso, termos e condições específicos podem ser aplicados a conteúdos, produtos, materiais, serviços ou informações específicos gerados por não usuários, contidos ou disponíveis neste Site (o "Conteúdo") ou transações concluídas através deste Site. Tais termos específicos podem ser adicionais a estes Termos de Serviço ou, quando inconsistentes com estes Termos de Serviço, tais termos específicos substituirão estes Termos de Serviço apenas na medida em que o conteúdo ou a intenção de tais termos específicos sejam inconsistentes com estes Termos de Serviço .

      A KONTROLE se reserva o direito de fazer alterações ou atualizações em relação ao Conteúdo do site ou ao formato do site a qualquer momento, sem aviso prévio. A KONTROLE se reserva o direito de encerrar ou restringir o acesso ao site ou a qualquer parte dele por qualquer motivo, a seu exclusivo critério.
      </p>

      <h3 class="pt-4 text-lg" >Obrigações dos usuários</h3>
      <p class="pt-4 text-justify">
      Você concorda em usar o site, os aplicativos KONTROLE e os serviços apenas para os fins permitidos por estes Termos de Serviço, bem como por qualquer lei, regulamento aplicável ou práticas ou diretrizes geralmente aceitas nas jurisdições relevantes. O KONTROLE NÃO É RESPONSÁVEL POR QUALQUER VIOLAÇÃO DE LEIS, REGRAS OU REGULAMENTOS APLICÁVEIS COMETIDOS POR VOCÊ OU POR TERCEIROS A SEU MESMO. É SUA RESPONSABILIDADE GARANTIR QUE SEU USO DO WEBSITE, APLICATIVOS E SERVIÇOS KONTROLE NÃO CONTRAVENDE LEIS, REGRAS OU REGULAMENTOS APLICÁVEIS. Especificamente, você concorda e garante que, ao usar o site e os serviços, suas ações não violam as leis, regras ou regulamentos de (1) país, estado ou localidade em que reside ou (2) país, estado, ou localidade onde o KONTROLE está localizado ou opera. Isso inclui o cumprimento das restrições de exportação e importação aplicáveis, além de outras restrições.
      </p>
     ≈
      <h3 class="pt-4 text-lg" >Descrição dos Serviços</h3>
      <p class="pt-4 text-justify">
      O KONTROLE permite que você colabore em projetos usando uma plataforma social baseada na nuvem. Empresas e indivíduos podem usar a plataforma KONTROLE para compartilhar arquivos confidenciais de qualquer local em um ambiente seguro. Os gerentes podem criar tarefas para seus funcionários, fazer upload de documentos relevantes e coordenar com os colegas para concluir os projetos de maneira eficaz e eficiente. Essencialmente, o KONTROLE fornece às empresas um hub para se comunicar, colaborar e criar em um ambiente virtual seguro e acessível baseado na nuvem.
      </p>

      <h3 class="pt-4 text-lg" >Uso dos Serviços por Você</h3>
      <p class="pt-4 text-justify">
      Você concorda em usar os Serviços apenas para os fins permitidos por estes Termos de Serviço, bem como por qualquer lei, regulamento aplicável ou práticas ou diretrizes geralmente aceitas nas jurisdições relevantes. Você concorda em não acessar (ou tentar acessar) qualquer um dos Serviços por qualquer outro meio que não seja o meio fornecido pela KONTROLE ou por seus parceiros autorizados. Você concorda em não acessar ou tentar acessar qualquer um dos Serviços por meios automatizados e que não se envolverá em nenhuma atividade que interfira ou atrapalhe os Serviços (ou os servidores e redes conectados aos Serviços).
      </p>

      <h3 class="pt-4 text-lg" >Além disso, você concorda</h3>
      <p class="pt-4 text-justify">
      não interromper ou interferir no desfrute de qualquer outro usuário do site, dos serviços ou de sites afiliados ou vinculados;
      não carregar, postar ou transmitir de outra forma, através do site ou dos serviços, vírus ou outros arquivos prejudiciais, perturbadores ou destrutivos;
      não usar ou tentar usar a conta de usuário, senha ou sistema de outro usuário;
      não acessar ou tentar acessar qualquer Conteúdo ou Conteúdo do Usuário (conforme definido abaixo), que você não está autorizado a acessar nos termos deste documento;
      não interromper ou interferir na segurança ou causar danos ao site, serviços, conteúdo, conteúdo do usuário, recursos do sistema, contas, senhas, servidores ou redes conectados ou acessíveis através deste site ou de sites afiliados ou vinculados .
      Se alguém que não seja você acessar sua conta de usuário, ele poderá executar quaisquer ações disponíveis para você (a menos que seja especificamente indicado de outra forma no KONTROLE), fazer alterações em sua conta de usuário e aceitar quaisquer termos legais disponíveis nela, fazer várias representações e garantias e mais - e todas essas atividades serão consideradas como tendo ocorrido em seu nome e em seu nome.
      </p>

      <h3 class="pt-4 text-lg" >Conteúdo do Usuário</h3>
      <p class="pt-4 text-justify">
      Os titulares de contas de usuário no KONTROLE podem fazer upload de dados, informações, materiais e documentos para serem armazenados e associados às contas de usuário no site ("Conteúdo do usuário"). Sujeito a estes Termos de Serviço, o Conteúdo do Usuário pode ser usado de qualquer maneira que tenha sido autorizada por você. É de sua exclusiva responsabilidade determinar quais limitações adicionais, se houver, são impostas ao uso do Conteúdo do Usuário distribuído dentro do seu grupo de trabalho. Se você obtiver acesso não autorizado a materiais criados ou usados ​​por outras pessoas fora do seu grupo de trabalho em conjunto com o Serviço KONTROLE, você não tem o direito de usá-los de nenhuma maneira. Você também reconhece e concorda que o KONTROLE não tem qualquer tipo de responsabilidade caso os membros do seu grupo de trabalho,

      O KONTROLE não possui nenhum Conteúdo do Usuário e não monitora, edita ou divulga nenhuma informação sobre você ou sua Conta de Usuário, incluindo qualquer Conteúdo do Usuário, sem sua permissão prévia, exceto de acordo com estes Termos de Serviço ou Política de Privacidade. O KONTROLE também não analisa, inspeciona, edita ou monitora qualquer Conteúdo do Usuário armazenado por você ou por qualquer outro usuário dos Serviços, incluindo, sem limitação, vírus, worms, "Cavalos de Tróia" ou quaisquer outros recursos contaminantes ou destrutivos similares. A KONTROLE reserva-se o direito, exclusivamente a seu critério, de recusar, remover ou desativar o acesso ao Conteúdo do Usuário armazenado nos servidores da KONTROLE que a KONTROLE aprenda que pode ser ilegal ou violar os termos destes Termos de Serviço, embora não tenha obrigação de tão.

      Você é o único responsável por proteger as informações do seu computador ou de outros dispositivos, por exemplo, instalando um software antivírus, atualizando seus aplicativos, protegendo com senha seus arquivos e impedindo o acesso de terceiros ao seu computador. Você entende que os usuários dos Serviços KONTROLE podem armazenar Conteúdo do Usuário que não pode ser usado devido à corrupção de vírus, mau funcionamento do software ou outras causas. O KONTROLE não é responsável por nenhum dano que um usuário possa incorrer com o compartilhamento e o uso de tal Conteúdo do Usuário.

      Você é o único responsável em relação a qualquer um dos usos do KONTROLE que ocorram na sua conta de usuário e por qualquer conteúdo do usuário (incluindo as conseqüências do uso ou publicação do conteúdo do usuário no KONTROLE) .

      Você possui todos os direitos sobre e para qualquer conteúdo enviado por você para sua Plataforma do Usuário ("Conteúdo do Usuário"), incluindo designs, imagens, animações, vídeos, arquivos de áudio, fontes, logotipos, ilustrações, composições, obras de arte, interfaces, texto, obras literárias e quaisquer outros materiais ("Conteúdo"), ou de outra forma têm (e continuarão a ter) todo o poder, título, licenças, consentimentos e autoridade, no e para o Conteúdo do Usuário, conforme necessário para legalmente usar, publicar, transferir ou licenciar todos e quaisquer direitos e interesses sobre e para esse Conteúdo do Usuário.

      O Conteúdo do Usuário é (e continuará sendo) verdadeiro, atual, preciso, sem infringir os direitos de terceiros e de forma alguma ilegal para você possuir, publicar, transmitir ou exibir no país em que você ou seu Usuário Os visitantes e usuários da Plataforma ("Usuários Finais") residem ou para o KONTROLE e / ou seus Usuários Finais usarem ou possuirem em conexão com o KONTROLE.

      Você obteve todos os consentimentos e permissões exigidos sob todas as leis aplicáveis, com relação à publicação, transmissão e publicação de qualquer informação pessoal e / ou imagem ou semelhança de qualquer pessoa, entidade ou propriedade que faça parte do Conteúdo do Usuário, e você cumprirá todas as leis aplicáveis ​​a elas.
      </p>

      <h3 class="pt-4 text-lg" >Suas senhas e segurança da conta</h3>
      <p class="pt-4 text-justify">
      O KONTROLE exige que você crie uma conta de usuário ("Conta de Usuário") para usar seus Serviços e também pode, ocasionalmente, fornecer códigos ou senhas adicionais necessárias para acessar e usar certos outros recursos ou funções do Site. Ao criar sua conta de usuário, você concorda em enviar informações precisas, atuais e completas sobre si mesmo e mantê-las atualizadas. O KONTROLE reserva-se o direito de suspender ou encerrar contas que sejam razoavelmente suspeitas de serem usadas em contradição com os termos aqui contidos e / ou contenham informações falsas, imprecisas, não atuais ou incompletas.

      Você também pode acessar o site, os aplicativos KONTROLE e o serviço fazendo login usando uma conta de rede social autorizada de terceiros, como uma conta do Facebook ou Twitter. Ao fazer isso, você autoriza o KONTROLE a coletar seu perfil pessoal e informações de atividades dessa rede social de terceiros.

      Observe que, se você optar por usar sua conta do Facebook para acessar nosso site e / ou aplicativos KONTROLE e usar nossos serviços ou interagir com outro usuário do site, o KONTROLE poderá acessar todos os seus dados em conexão com sua conta do Facebook, incluindo, sem limitação, sua lista de amigos, fotos que você postou ou postadas no Facebook, empresas e histórias que você 'curtiu', lugares que você visitou etc.

      Essas informações fornecidas são usadas para propósitos como permitir a configuração de uma conta e um perfil de usuário que possam ser usados ​​para interagir com outros usuários por meio do Serviço, melhorar o conteúdo do Serviço, personalizar a publicidade e o conteúdo que você vê e comunicar com você sobre promoções e novos recursos. É totalmente opcional que você participe dessas atividades e / ou faça compras na KONTROLE.

      Essas informações fornecidas são usadas para propósitos como permitir a configuração de uma conta e um perfil de usuário que possam ser usados ​​para interagir com outros usuários por meio do Serviço, melhorar o conteúdo do Serviço, personalizar a publicidade e o conteúdo que você vê e comunicar com você sobre promoções e novos recursos. É totalmente opcional que você participe dessas atividades e / ou faça compras na KONTROLE.

      Você deve escolher uma senha pessoal e intransferível. As contas de usuário não podem ser "compartilhadas" ou usadas por mais de um indivíduo. Depois de aceitar estes Termos de Serviço e o registro da sua Conta de Usuário ter sido aceito pela KONTROLE, sua Conta de Usuário será estabelecida. Você é o único responsável por todas e quaisquer atividades que ocorram na sua conta de usuário, independentemente de esse uso ter sido autorizado ou não por você.

      Por favor, leia nossa Política de Privacidade, que descreve como o KONTROLE coleta, usa, divulga, gerencia e armazena suas informações de identificação pessoal ("Informações pessoais"). Você concorda e entende que é responsável por manter a confidencialidade de todos os nomes de usuário e senhas associados a qualquer conta de usuário usada para acessar os Serviços. Além disso, você não pode usar a conta de usuário de outra pessoa a qualquer momento, sem a permissão do titular da conta. O KONTROLE não se responsabiliza por nenhum dano causado ou relacionado ao roubo ou apropriação indevida de seu nome de usuário, senha, Conteúdo do Usuário, divulgação de seu nome de usuário ou senha ou autorização de qualquer outra pessoa para usar seu nome de usuário ou senha. No entanto, você pode ser responsabilizado por perdas incorridas pelo KONTROLE, outro usuário ou terceiros devido a apropriação indébita e uso da sua conta de usuário. Se você tomar conhecimento de qualquer uso não autorizado da sua conta de usuário, notifique o KONTROLE imediatamente no endereço na seção "Parte contratante" abaixo.
      </p>

      <h3 class="pt-4 text-lg" >Comunicação com outros usuários</h3>
      <p class="pt-4 text-justify">
      O site, os aplicativos KONTROLE e os serviços podem permitir que você se comunique com outros usuários por meio de um VMA de terceiros ou por outros meios. A discrição deve ser usada ao divulgar qualquer informação por esses meios, pois pode ser acessada por terceiros. O uso de qualquer informação pessoal identificável e suas opções em relação ao uso dessas informações estão sujeitas à Política de Privacidade da KONTROLE .
      </p>

      <h3 class="pt-4 text-lg" >Segurança do conteúdo do usuário</h3>
      <p class="pt-4 text-justify">
      O KONTROLE envidará todos os esforços comercialmente razoáveis ​​para restringir o acesso ao seu Conteúdo do Usuário a pessoas não autorizadas. No entanto, nenhum sistema protegido por senha de armazenamento e recuperação de dados pode ser totalmente impenetrável. Embora o Bixtrix24 se esforce para garantir que todos os dados no site sejam seguros, você reconhece e aceita que pode ser possível que um terceiro não autorizado acesse, visualize, copie, modifique e distribua os dados e arquivos que você armazena no site ou via Serviços.
      </p>
      <p class="pt-4 text-justify">
      <h3 class="pt-4 text-lg" >Suporte técnico</h3>
      O KONTROLE mantém um recurso da comunidade para todos os usuários em seu site, que contém perguntas frequentes e outras informações úteis sobre o produto e seu uso. Além disso, o KONTROLE fornecerá suporte técnico para os titulares de contas pagadoras de seus Serviços e Software (definidos abaixo). Para receber suporte técnico da KONTROLE, o usuário que busca esse suporte deve solicitá-lo, entrando em contato com a KONTROLE usando o recurso de helpdesk no site. O usuário deve descrever a natureza do problema a ser resolvido, além de fornecer informações sobre o usuário (nome, endereço, etc.). A KONTROLE envidará esforços razoáveis ​​para responder a essas solicitações em tempo hábil. O usuário cooperará com o KONTROLE ao procurar serviços de suporte técnico, fornecendo as informações necessárias para ajudá-lo ou solicitadas pelo KONTROLE ao diagnosticar ou resolver o problema. Embora o KONTROLE não possa garantir que um problema de suporte técnico seja resolvido, o KONTROLE fará esforços razoáveis ​​para executar serviços de suporte técnico de maneira profissional.
      </p>

      <h3 class="pt-4 text-lg" >Taxas e Pagamento</h3>
      <p class="pt-4 text-justify">
      Todos os direitos e privilégios aqui fornecidos a você sob estes Termos de Serviço estão sujeitos ao pagamento da taxa aplicável, se houver, ao KONTROLE, desde que, no entanto, o KONTROLE se reserve expressamente o direito de fornecer os Serviços gratuitamente durante o Prazo, e ainda mais desde que a KONTROLE, exclusivamente a seu critério e após a rescisão deste Contrato, possa optar por fornecer os mesmos serviços ou serviços similares por uma taxa.

      O pagamento pelos serviços será realizado a preços acordados entre você e a KONTROLE. O KONTROLE oferece vários planos de serviço para os usuários, com diferentes taxas e recursos de funcionalidade para cada plano ("Plano de Serviço"). O pagamento de um plano de serviço, se houver, deve ser feito antecipadamente e não é reembolsável, ou seja, não haverá reembolso total ou parcial.

      Por exemplo, se você cancelar sua assinatura do seu plano de serviço antes que ele termine, você ainda será responsável pelo pagamento de quaisquer taxas aplicáveis ​​pelo restante do período de assinatura selecionado. Todas as taxas são exclusivas de impostos, taxas ou direitos impostos pelas autoridades tributárias; você é responsável pelo pagamento de qualquer imposto aplicável.

      Você reconhece que o valor cobrado pela assinatura pode variar por razões que incluem, valores diferentes devido a ofertas promocionais, valores diferentes devido a alterações em sua conta ou alterações no valor do imposto sobre vendas aplicável e você nos autoriza a cobrar por quantidades variáveis.

      Telefonia pré-paga ou crédito de VoIP que você pode usar para chamadas telefônicas realizadas ou serviços de aluguel de números de telefone não têm valor em dinheiro, também não são reembolsáveis ​​nem transferíveis. Se sua conta ou número de telefone for encerrado ou suspenso por qualquer motivo, talvez você não consiga usar os créditos de telefonia ou VoIP restantes. Nenhum reembolso de VoIP ou crédito de telefonia não utilizado pode ser fornecido. O crédito restante também não pode ser transferido para outra conta, alocado em faturas pendentes ou usado como pagamento por outro serviço.

      Em caso de não pagamento por qualquer motivo, o KONTROLE se reserva o direito de barrar imediatamente o acesso do Usuário aos Serviços.
      </p>

      <h3 class="pt-4 text-lg" >Informações e materiais fornecidos por você</h3>
      <p class="pt-4 text-justify">
      Todos os materiais, documentos, comunicações ou informações enviadas, enviadas ou armazenadas neste site por você estarão sujeitas a estes Termos de Serviço e Política de Privacidade . A segurança de tais informações é muito importante para o KONTROLE.
      </p>

      <h3 class="pt-4 text-lg" >Prazo / Rescisão</h3>
      <p class="pt-4 text-justify">
      O termo destes Termos de Serviço ("Termo") começará quando você começar a usar este Site ou os Serviços e continuará perpetuamente, a menos que seja de outro modo rescindido pela KONTROLE ou por notificação por escrito. A KONTROLE se reserva o direito de alterar, suspender ou descontinuar os Serviços ou qualquer parte dele, a qualquer momento. Sem prejuízo de quaisquer outros direitos, estes Termos de Serviço serão rescindidos automaticamente se você não cumprir com alguma das limitações ou outros requisitos aqui descritos. Após qualquer rescisão ou expiração destes Termos de Serviço, você deve interromper imediatamente o uso deste Site e dos Serviços, incluindo, sem limitação, o uso das marcas comerciais, nomes comerciais, direitos autorais e outras propriedades intelectuais da KONTROLE.

      Após a rescisão deste contrato, você não estará mais autorizado a usar este site ou os serviços de forma alguma.
      </p>

      <h3 class="pt-4 text-lg" >Links para outros sites e materiais de terceiros</h3>
      <p class="pt-4 text-justify">
      Este site pode fornecer links para outros sites e / ou produtos e serviços de terceiros que não estão sob o controle da KONTROLE (juntos, "Materiais de terceiros"). A KONTROLE não se responsabiliza de forma alguma pelo conteúdo de tais materiais de terceiros. A KONTROLE fornece esses links apenas para a conveniência dos usuários deste Site e Serviços, e a inclusão de qualquer link para quaisquer Materiais de Terceiros não implica o endosso da KONTROLE ao conteúdo, produtos e / ou serviços desses Materiais de Terceiros. Não obstante qualquer disposição em contrário neste documento,

      Para sua conveniência e para oferecer a você as mais recentes inovações em comunicação, o KONTROLE, por meio de seus Serviços, fornece aplicativos de voz e mensagens de terceiros ("VMA"). Você reconhece e concorda que a VMA é fornecida a você por meio de terceiros e está sujeita aos termos de serviços dessa parte ( http://voximplant.com/legal/tos/ ) e à política de privacidade ( http://voximplant.com/legal / privacy / ) ao qual é fornecido aqui para sua referência.
          </p>

      <h3 class="pt-4 text-lg" >Idioma dos Termos de Serviço</h3>
      <p class="pt-4 text-justify">
      Quando a KONTROLE lhe forneceu uma tradução da versão em inglês desses Termos de Serviço para outro idioma, você concorda que a tradução é fornecida apenas para sua conveniência e que as versões em inglês desses Termos de Serviço governarão seu relacionamento com a KONTROLE . Se houver alguma contradição entre a versão em inglês desses Termos de Serviço e a tradução, a versão em inglês prevalecerá.
      </p>

      <h3 class="pt-4 text-lg" >Propriedade intelectual</h3>
      <p class="pt-4 text-justify">
      Copyright, marca registrada e todos os outros direitos de propriedade do Site, Conteúdo (incluindo, entre outros, software, serviços, áudio, vídeo, texto e fotografias) e / ou Serviços pertencem à KONTROLE e / ou seus licenciadores. A menos que seja especificamente especificado aqui ou autorizado pela KONTROLE por escrito, todos os direitos no site, conteúdo e / ou serviços não expressamente concedidos aqui são reservados. Você concorda em não copiar, republicar, enquadrar, disponibilizar para download, transmitir, modificar, alugar, arrendar, emprestar, vender, atribuir, distribuir, licenciar, sublicenciar, fazer engenharia reversa ou criar trabalhos derivados com base no Conteúdo, Site, produtos ou serviços.

      A KONTROLE renuncia a quaisquer direitos sobre marcas comerciais, marcas de serviço, nomes comerciais, logotipos, direitos autorais, patentes, nomes de domínio ou outros interesses de propriedade intelectual de terceiros. Todos os interesses de propriedade intelectual de terceiros aqui mencionados, incluindo, sem limitação, o Material de Terceiros ou de outra forma fornecido neste Site são de propriedade de seus respectivos proprietários. O KONTROLE se isenta de quaisquer interesses de propriedade dos direitos de propriedade intelectual que não sejam os seus.

      O site usa fontes licenciadas sob a licença de fonte aberta SIL e licença Apache, versão 2.0. Entre o KONTROLE e você, você deve possuir toda a propriedade intelectual referente ao seu Conteúdo do Usuário, incluindo quaisquer desenhos, imagens, animações, vídeos, arquivos de áudio, fontes, logotipos, ilustrações, composições, obras de arte, interfaces, texto, obras literárias e qualquer outros materiais criados por você. O KONTROLE não reivindica direitos de propriedade sobre o seu conteúdo. Com o único objetivo de conceder a você o serviço, você sabe e concorda que precisaremos fazer upload de seu conteúdo para nossa plataforma, incluindo serviços em nuvem e CDNs, para fazer ajustes na exibição e executar quaisquer outras ações técnicas necessárias.
      </p>

      <h3 class="pt-4 text-lg" >Termos da imagem</h3>
      <p class="pt-4 text-justify">
      Você tem permissão para usar Imagens Licenciadas no site para o qual as licencia (ou seja, um único URL do KONTROLE e a coleção de domínios apontando para ele). No entanto, a compra de uma imagem licenciada sob estes Termos da imagem não confere nenhum direito de propriedade sobre as imagens licenciadas subjacentes, e seus direitos de uso são limitados apenas ao que é descrito aqui. Se você deseja adquirir direitos de licenciamento adicionais para Imagens Licenciadas (como uso offline ou de publicidade), pode adquiri-los diretamente da Shutterstock ou de outros estoques de imagens através de seus sites.
      </p>

      <h3 class="pt-4 text-lg" >Garantias e isenções de responsabilidade</h3>
      <p class="pt-4 text-justify">
      Todo o conteúdo e / ou serviços são fornecidos "como estão" e "conforme disponíveis". A KONTROLE aqui se isenta expressamente de quaisquer representações ou garantias de qualquer tipo, expressas ou implícitas, incluindo, sem limitação, garantias de comercialização, adequação a qualquer finalidade específica, não violação ou ao funcionamento deste site, serviços ou conteúdo. O KONTROLE não garante ou faz qualquer representação quanto à segurança deste site, conteúdo ou serviços. Você reconhece que qualquer informação enviada pode ser interceptada na transmissão ou de outra forma. O KONTROLE não garante que o site, o conteúdo ou os servidores que disponibilizam este site ou as comunicações eletrônicas enviadas pelo KONTROLE estejam livres de vírus ou quaisquer outros elementos nocivos.

      O uso dos serviços ou o download ou outro uso de qualquer produto através do site é feito a seu próprio critério e risco e com o seu acordo de que você será o único responsável por qualquer dano ao sistema do seu computador, perda de dados ou outros danos que resulta de tais atividades. O KONTROLE não assume nenhuma responsabilidade por vírus de computador ou outro código de software semelhante que é baixado para o seu computador a partir do site ou em conexão com quaisquer serviços ou produtos oferecidos através do site. Nenhum conselho ou informação, oral ou escrita, obtido por você da KONTROLE ou do site, criará qualquer garantia não expressa expressamente nos termos de serviço.

      Este site pode conter referências a produtos e serviços KONTROLE específicos que podem não estar disponíveis em um país específico. Essa referência não implica ou garante que tais produtos ou serviços estejam disponíveis a qualquer momento em qualquer país em particular. Você entende e concorda que, ao usar este site e serviços nele contidos, poderá ser exposto a conteúdo que possa considerar ofensivo, indecente ou censurável e que, a esse respeito, use o site, serviços e produtos por seu próprio risco. Em nenhum caso a KONTROLE ou qualquer uma de suas afiliadas será responsável por quaisquer danos diretos, indiretos, consequenciais, punitivos, especiais ou incidentais (incluindo, sem limitação, danos por perda de negócios, contrato, receita, dados,

      Algumas jurisdições não permitem a exclusão de garantias ou limitações implícitas; portanto, as limitações acima podem não se aplicar a você.

      A KONTROLE pode, a seu exclusivo critério (no entanto, não terá obrigação de fazê-lo), rastrear, monitorar e / ou editar qualquer Plataforma do Usuário e / ou Conteúdo do Usuário, a qualquer momento e por qualquer motivo, com ou sem aviso prévio.

      Não obstante qualquer disposição em contrário, o KONTROLE não pode, em circunstância alguma, ser considerado um "publicador" de qualquer Conteúdo do Usuário, de forma alguma endossa qualquer Conteúdo do Usuário e não assume nenhuma responsabilidade por qualquer Conteúdo do Usuário carregado, publicado, publicado e publicado. / ou disponibilizado por qualquer Usuário ou qualquer outra parte nos e / ou através dos Serviços KONTROLE, para qualquer uso por qualquer parte ou por qualquer perda, exclusão ou dano ao mesmo ou a ele ou por qualquer perda, dano, custo ou despesa que você ou outros podem sofrer ou incorrer como resultado de ou em conexão com a publicação, acesso e / ou dependência de qualquer Conteúdo do Usuário. Além disso, a KONTROLE não se responsabiliza por erros, difamação, difamação, falsidade, obscenidade, pornografia,

      A KONTROLE não recomenda o uso dos Serviços KONTROLE para hospedagem de conteúdo pessoal e não deve assumir quaisquer obrigações ou riscos de segurança ou integridade em relação à violação ou dano a esse conteúdo.
      </p>

      <h3 class="pt-4 text-lg" >Suas garantias</h3>
      <p class="pt-4 text-justify">
      Você garante que: (i) todas as informações fornecidas por você à KONTROLE em conexão com o serviço são verdadeiras, precisas, corretas e atualizadas; (ii) você tem total poder e autoridade para celebrar os termos de serviço; (iii) você é maior de idade para formar um contrato vinculativo com a KONTROLE; (iv) você buscará todas as aprovações governamentais necessárias para efetivar esses termos de serviço; (v) você deve cumprir todas as suas obrigações sob estes termos de serviço, de acordo com as leis aplicáveis; e (vi) seu conteúdo editorial, de texto, gráfico, audiovisual e outro que esteja disponível para usuários finais deste site e que não seja fornecido pela KONTROLE, ou este site não (1) viole quaisquer direitos de propriedade intelectual de terceiros ,

      Todo e qualquer item baixado ou comprado deste site está sujeito aos controles de exportação dos Estados Unidos. Portanto, nenhum produto pode ser exportado ou reexportado (i) para (ou para um nacional ou residente de) Cuba, Iraque, Líbia, Coréia do Norte, Irã, Síria ou qualquer outro país para o qual os EUA embarcaram mercadorias; ou (ii) a qualquer pessoa da lista de Nacionais Especialmente Designados do Departamento do Tesouro ou da Tabela de Negação de Pedidos do Departamento de Comércio dos EUA. Ao fazer o download ou usar os Serviços da KONTROLE, você declara e garante que não está localizado, sob o controle ou nacional ou residente de um país ou de qualquer lista.
      </p>

      <h3 class="pt-4 text-lg" >Comentários</h3>
      <p class="pt-4 text-justify">
      Periodicamente, você poderá fornecer sugestões, comentários ou outros comentários à KONTROLE com relação a qualquer produto, material, software ou informação fornecida pela KONTROLE (doravante denominada "Feedback"). Você concorda que todo Feedback é e deve ser totalmente voluntário e, na ausência de acordo em separado, cria qualquer obrigação de confidencialidade para a KONTROLE. No entanto, o KONTROLE não divulgará a fonte de qualquer feedback sem aviso prévio à parte fornecedora. O KONTROLE terá a liberdade de divulgar e usar o Feedback que julgar conveniente, inteiramente sem obrigação de qualquer tipo para você. O precedente não deve, no entanto, afetar as obrigações de qualquer uma das partes abaixo com relação às informações protegidas de acordo com quaisquer Políticas de Privacidade da KONTROLE publicado neste site.
      </p>

      <h3 class="pt-4 text-lg" >Aviso e procedimento para fazer reclamações por violação de direitos autorais</h3>
      <p class="pt-4 text-justify">
      É política da KONTROLE responder a avisos de supostas violações de direitos autorais que cumpram a lei internacional de propriedade intelectual aplicável (incluindo, nos Estados Unidos, a Digital Millennium Copyright Act). Se você acredita que seu trabalho foi copiado de forma a constituir uma violação de direitos autorais, forneça ao KONTROLE Copyright Agent as informações por escrito especificadas abaixo. (Observe que este procedimento é exclusivamente para notificar o KONTROLE e suas afiliadas que seu material protegido por direitos autorais foi violado.)

      Uma assinatura eletrônica ou física do proprietário dos direitos autorais ou da pessoa autorizada a agir em nome do proprietário dos direitos autorais;
      Uma descrição do trabalho protegido por direitos autorais que você alega ter sido violado;
      Uma descrição de onde o material que você alega estar violando está localizado neste site;
      Seu endereço, número de telefone, e endereço de e-mail;
      Uma declaração sua de que você acredita de boa fé que o uso contestado não está autorizado pelo proprietário dos direitos autorais, seu agente ou pela lei;
      Uma declaração sua, feita sob pena de perjúrio, de que as informações acima em seu aviso são precisas e de que você é o proprietário dos direitos autorais ou está autorizado a agir em nome do proprietário dos direitos autorais.
      O Agente de Direitos Autorais da KONTROLE para aviso de reclamações de violação de direitos autorais neste site pode ser contatado da seguinte forma:
          </p>
      <p class="pt-4 text-justify">
      Nome: Dmitri Dubograev
      E-mail: info@legal-counsels.com
      </p>

      <h3 class="pt-4 text-lg" >Política repetida de infrator</h3>
      <p class="pt-4 text-justify">
      Em conformidade com a Lei de Direitos Autorais do Milênio Digital, é política da KONTROLE rescindir as Contas de Usuário daqueles usuários considerados pela KONTROLE, exclusivamente a seu critério, infratores repetidos. Os infratores repetidos são usuários do site da KONTROLE, dos aplicativos da KONTROLE e / ou do serviço, conhecidos por seus nomes de usuário ou outro identificador exclusivo, sobre os quais a KONTROLE recebeu mais de uma notificação de remoção da DMCA que resultou na remoção permanente desse conteúdo do usuário, postado sob a direção desse usuário, no site, no aplicativo KONTROLE e / ou serviços. Observe que o KONTROLE pode encerrar o acesso de um infrator da repetição ao site, aplicativo e serviços do KONTROLE a seu exclusivo critério. Contudo, nada neste Infringer Repetitivo deve proibir ou restringir o KONTROLE de encerrar uma Conta de Usuário ou o acesso de um usuário ao Site, Aplicativo KONTROLE ou Serviços a qualquer momento e por qualquer motivo. Você reconhece e concorda que as circunstâncias específicas que envolvem cada instância de violação reivindicada podem exigir uma resposta da KONTROLE adaptada a essa situação específica. Consequentemente, a KONTROLE reserva-se expressamente o direito de encerrar quaisquer Contas de Usuário e acessar o Site, o Aplicativo KONTROLE e os Serviços de qualquer usuário se, a seu critério e por qualquer motivo, acreditarmos que as circunstâncias relacionadas à violação de propriedade intelectual de terceiros direitos justificam tal ação ou qualquer outro motivo. ou Serviços a qualquer momento e por qualquer motivo. Você reconhece e concorda que as circunstâncias específicas que envolvem cada instância de violação reivindicada podem exigir uma resposta da KONTROLE adaptada a essa situação específica. Consequentemente, a KONTROLE reserva-se expressamente o direito de encerrar quaisquer Contas de Usuário e acessar o Site, o Aplicativo KONTROLE e os Serviços de qualquer usuário se, a seu critério e por qualquer motivo, acreditarmos que as circunstâncias relacionadas à violação de propriedade intelectual de terceiros direitos justificam tal ação ou qualquer outro motivo. ou Serviços a qualquer momento e por qualquer motivo. Você reconhece e concorda que as circunstâncias específicas que envolvem cada instância de violação reivindicada podem exigir uma resposta da KONTROLE adaptada a essa situação específica. Consequentemente, a KONTROLE reserva-se expressamente o direito de encerrar quaisquer Contas de Usuário e acessar o Site, o Aplicativo KONTROLE e os Serviços de qualquer usuário se, a seu critério e por qualquer motivo, acreditarmos que as circunstâncias relacionadas à violação de propriedade intelectual de terceiros direitos justificam tal ação ou qualquer outro motivo. Você reconhece e concorda que as circunstâncias específicas que envolvem cada instância de violação reivindicada podem exigir uma resposta da KONTROLE adaptada a essa situação específica. Consequentemente, a KONTROLE reserva-se expressamente o direito de encerrar quaisquer Contas de Usuário e acessar o Site, o Aplicativo KONTROLE e os Serviços de qualquer usuário se, a seu critério e por qualquer motivo, acreditarmos que as circunstâncias relacionadas à violação de propriedade intelectual de terceiros direitos justificam tal ação ou qualquer outro motivo. Você reconhece e concorda que as circunstâncias específicas que envolvem cada instância de violação reivindicada podem exigir uma resposta da KONTROLE adaptada a essa situação específica. Consequentemente, a KONTROLE reserva-se expressamente o direito de encerrar quaisquer Contas de Usuário e acessar o Site, o Aplicativo KONTROLE e os Serviços de qualquer usuário se, a seu critério e por qualquer motivo, acreditarmos que as circunstâncias relacionadas à violação de propriedade intelectual de terceiros direitos justificam tal ação ou qualquer outro motivo.
      </p>

      <h3 class="pt-4 text-lg" >Concursos, sorteios, leilões e promoções</h3>
      <p class="pt-4 text-justify">
      Periodicamente, a KONTROLE pode realizar promoções no ou através do site, incluindo, sem limitação, leilões, concursos e sorteios que podem estar sujeitos a termos e / ou regras adicionais.
      </p>

      <h3 class="pt-4 text-lg" >Programas</h3>
      <p class="pt-4 text-justify">
      A KONTROLE pode oferecer determinado software, para ser usado em conjunto com os Serviços, para fazer o download a partir ou através deste Site ("Software"). Esse Software será licenciado de acordo com os termos do contrato de licença de uso final aplicável. Tanto o Software quanto toda a documentação fornecida disponibilizada através deste Site são obras protegidas por direitos autorais da KONTROLE. Você deve concordar com os termos do contrato de licença de usuário final aplicável antes do uso de tal Software.

      Exceto quando especificamente especificado aqui ou no contrato de licença de usuário final aplicável ou conforme acordado por escrito pela KONTROLE, você não pode usar, copiar, republicar, enquadrar, emular, clonar, baixar, transmitir, alugar, arrendar, emprestar, emprestar, vender, atribuir, modificar, distribuir, licenciar, sublicenciar, descompilar, desmontar, criar um trabalho derivado, fazer engenharia reversa ou transferir o programa licenciado ou qualquer subconjunto do site, seus produtos ou serviços. Qualquer uso não autorizado resultará no cancelamento imediato e automático desta licença e poderá resultar em processo criminal e / ou civil.

      As garantias, se houver, com relação a esse software somente serão aplicadas conforme expressamente estabelecido no contrato de licença de usuário final aplicável. A KONTROLE nega expressamente todas as demais representações e garantias de qualquer tipo, expressas ou implícitas, incluindo garantias de comercialização, adequação a qualquer finalidade específica ou não violação com relação ao software.

      Sem limitar o exposto, a KONTROLE não garante que: os Serviços ou o Software atendam aos seus requisitos; os Serviços ou o Software serão ininterruptos, oportunos, seguros ou livres de erros; os resultados que possam ser obtidos com o uso dos Serviços ou Software serão eficazes, precisos ou confiáveis; a qualidade de qualquer serviço ou software adquirido ou acessível por você através do site atenderá às suas expectativas; quaisquer erros nos Serviços ou Software ou quaisquer defeitos no Site, Serviços ou Software serão corrigidos.
      </p>

      <h3 class="pt-4 text-lg" >Atualizações de serviço e software</h3>
      <p class="pt-4 text-justify">
      Você reconhece e concorda com a condição de que os Serviços sejam atualizados e modificados periodicamente. Essas modificações podem assumir a forma de correções de bugs, funções aprimoradas, novos módulos, alterações na interface do usuário, conformidade com novos regulamentos ou outras formas. Tais atualizações e modificações podem ser feitas sem aviso prévio.

      Se você baixar o Software, ele poderá baixar e instalar automaticamente atualizações subseqüentes para esse Software da KONTROLE. Essas atualizações foram projetadas para melhorar, aprimorar e desenvolver ainda mais o Software e podem assumir a forma de correções de bugs, funções aprimoradas, novos módulos de software e versões completamente novas. Você concorda em receber essas atualizações (e permite que a KONTROLE as entregue a você) como parte do seu uso do Software.
      </p>

      <h3 class="pt-4 text-lg" >Seções Publicadas</h3>
      <p class="pt-4 text-justify">
      Este site pode conter páginas ou seções que podem ser editadas e visíveis para todos os visitantes deste site, incluindo, entre outros, fóruns, chats, livros de visitas, comentários e galerias de imagens ("Seções editadas publicamente").

      A discrição deve ser usada para inserir informações de identificação pessoal nas Seções Publicadas, pois podem ser coletadas por terceiros. O uso de informações de identificação pessoal contidas nas Seções Publicadas e suas opções em relação ao uso dessas informações estão sujeitas à Política de Privacidade da KONTROLE publicada neste Site.

      A KONTROLE se reserva o direito de modificar e / ou excluir qualquer mensagem submetida às Seções Publicadas, a seu exclusivo critério, a qualquer momento e por qualquer motivo, incluindo, entre outros, material que, na opinião da KONTROLE:

      (A) pode constituir difamação, difamação, invasão de privacidade ou é obsceno, pornográfico, abusivo ou ameaçador;
      (B) pode violar qualquer propriedade intelectual ou outro direito de qualquer entidade ou pessoa;
      (C) pode violar qualquer lei aplicável ou defender atividades ilegais;
      (D) anuncia ou solicita fundos ou é uma solicitação de bens, serviços, anunciantes ou patrocinadores ou se envolve em atividades comerciais;
      (E) interrompe o fluxo normal de diálogo ou age de uma maneira que afeta a capacidade de outras pessoas de se envolverem em atividades em tempo real através dos sites da KONTROLE;
      (F) inclui programas que podem conter vírus, worms, cavalos de Troia ou outro código de computador, arquivos ou programas projetados para interromper, destruir ou limitar a funcionalidade de qualquer software, hardware ou telecomunicações;
      (G) viole qualquer política ou regulamento estabelecido periodicamente com relação ao uso deste site ou de quaisquer redes conectadas a este site; ou
      (H) contém links para outros sites que contêm o tipo de conteúdo que se enquadra nas descrições descritas em (A) a (G) acima.
      </p>

      <h3 class="pt-4 text-lg" >Uso Ilegal ou Proibido</h3>
      <p class="pt-4 text-justify">
      Você não pode usar este site ou serviços para qualquer finalidade que seja ilegal, proibida por estes Termos de Serviço ou de qualquer forma interfira ou tente interferir no bom funcionamento deste site. Você não pode usar este site ou serviços de qualquer maneira que possa danificar, desativar, sobrecarregar ou prejudicar este site ou serviços, ou que interfira no uso e aproveitamento por terceiros deste site ou serviços. Você concorda em não usar nenhum software de terceiros que intercepte, "minas" ou colete informações de ou através do site ou dos serviços. Você não pode obter ou tentar obter quaisquer materiais ou informações por qualquer meio não intencionalmente disponibilizado pela KONTROLE a todos os usuários deste site ou serviços. Você não deve instituir, auxiliar ou envolver-se em um ataque a nenhum servidor KONTROLE ou tentar interromper os servidores KONTROLE. Qualquer tentativa sua de danificar os servidores da KONTROLE ou minar a operação legítima da KONTROLE é uma violação das leis civis e criminais e, se tal tentativa for feita ou for fornecida assistência para tal ataque, a KONTROLE se reserva o direito de solicitar danos por qualquer usuário na extensão máxima permitida por lei.

      Você não pode enviar, transmitir ou exibir Conteúdo do Usuário ou usar Conteúdo Licenciado em um contexto que possa ser considerado difamatório, difamatório, obsceno, assediante, ameaçador, incendiário, abusivo, racista, ofensivo, enganoso ou fraudulento, incentivando criminosos ou conduta prejudicial ou que viole os direitos da KONTROLE ou de terceiros (incluindo quaisquer direitos de propriedade intelectual, direitos de privacidade, direitos contratuais ou fiduciários) ou mostre qualquer pessoa, entidade ou marca sob uma luz ruim ou depreciativa, sem a sua prévia autorização. aprovação explícita.

      Você não pode fazer upload para os Serviços KONTROLE e / ou Plataforma do Usuário ou usá-los para projetar, desenvolver, distribuir e / ou transmitir ou executar qualquer outro vírus, worm, cavalo de Tróia, bomba-relógio, bug na web, spyware, malware ou qualquer outro código, arquivo ou programa de computador que possa ou se destine a danificar ou seqüestrar a operação de qualquer hardware, software ou equipamento de telecomunicações ou qualquer outro código ou componente real ou potencialmente prejudicial, disruptivo ou invasivo

      Você não pode executar nenhuma ação que imponha uma carga desproporcional ou desproporcionalmente grande na infraestrutura dos Serviços KONTROLE ou nos sistemas ou redes da KONTROLE conectados aos Serviços KONTROLE, nem interferir ou interromper a operação de qualquer um dos Serviços KONTROLE ou dos servidores. ou redes que os hospedem ou os disponibilizem ou desobedecem a quaisquer requisitos, procedimentos, políticas ou regulamentos de tais servidores ou redes.

      Você não pode usar nenhum dos Serviços KONTROLE e / ou Plataforma do Usuário em conexão com qualquer forma de spam, correio não solicitado, fraude, fraude, phishing, "correntes", "esquemas de pirâmide" ou conduta semelhante, ou se envolver em marketing antiético ou publicidade.

      Se concluirmos que você está violando alguma dessas políticas ou adotando qualquer outro comportamento que julgarmos abusivo ou inapropriado, poderemos tomar medidas contra sua Conta ou Seus Sites. Tentamos garantir resultados justos, mas em todos os casos nos reservamos o direito de remover qualquer conteúdo ou suspender sua conta ou seus sites, sem qualquer reembolso de quaisquer quantias pagas pelos Serviços, sem aviso prévio, a qualquer momento e por qualquer motivo. Reservamo-nos o direito de impor ou não impor esta Política de Uso Aceitável, a nosso exclusivo critério.
      </p>

      <h3 class="pt-4 text-lg" >Indenização</h3>
      <p class="pt-4 text-justify">
      Você concorda em indenizar e isentar a KONTROLE, suas afiliadas, executivos, diretores, agentes e funcionários, de qualquer despesa, perda, reivindicação, dano, multa, penalidade ou responsabilidade, incluindo honorários razoáveis ​​para advogados e outros profissionais, devidos sob qualquer julgamento, veredicto, ordem judicial ou acordo, na medida em que resulte de qualquer reivindicação, demanda, ação, processo, arbitragem ou outro processo iniciado por terceiros, incluindo a avaliação, reivindicação ou demanda por uma agência ou entidade governamental, resultante da sua violação destes Termos de Serviço.
      </p>

      <h3 class="pt-4 text-lg" >Privacidade</h3>
      <p class="pt-4 text-justify">
      O KONTROLE respeita sua privacidade e o uso e proteção de suas informações pessoais. Consulte nossa Política de Privacidadepara informações e divulgações importantes relacionadas à coleta e uso de suas informações pessoais em conexão com o uso deste site. Se você é um visitante, usuário ou cliente de qualquer um de nossos usuários, leia o seguinte: O KONTROLE não tem relacionamento direto com os usuários individuais de usuários cujas informações pessoais são processadas. Se você é um visitante, usuário ou cliente de qualquer um de nossos Usuários e gostaria de fazer solicitações ou consultas sobre suas Informações Pessoais, entre em contato diretamente com esse (s) Usuário (s). Por exemplo, se você deseja acessar, corrigir, alterar ou excluir informações imprecisas processadas pela KONTROLE em nome de seus Usuários, encaminhe sua consulta ao Usuário relevante (que é o "Controlador" de tais dados).
      </p>

      <h3 class="pt-4 text-lg" >Link para este site</h3>
      <p class="pt-4 text-justify">
      É permitido o link para este site, desde que você cumpra as seguintes regras. Você pode criar um link para a página inicial deste site ou para qualquer outra página deste site. No entanto, você não tem permissão para usar links in-line (ou hot -links) ou molduras. Você não deve sugerir que o KONTROLE endossa ou patrocina o vinculador ou seu site, produtos ou serviços. Você não deve usar a propriedade intelectual da KONTROLE, incluindo, sem limitação, marcas comerciais, nomes comerciais e direitos autorais sem a permissão prévia por escrito da KONTROLE. Além disso, você concorda em remover o link a qualquer momento, mediante solicitação da KONTROLE.
      </p>

      <h3 class="pt-4 text-lg" >Terminando seu relacionamento com o KONTROLE</h3>
      <p class="pt-4 text-justify">
      Estes Termos de Serviço continuarão em vigor até serem rescindidos por você ou pela KONTROLE, conforme estabelecido abaixo. Se você quiser rescindir este contrato legal com a KONTROLE (ou seja, estes Termos de Serviço), poderá fazê-lo (a) notificando a KONTROLE a qualquer momento por escrito, no endereço fornecido na seção "Parte Contratante" abaixo e (b) fechando o seu Conta de usuário. A KONTROLE se reserva o direito de rescindir estes Termos de Serviço com você, a seu critério, a qualquer momento, mediante aviso prévio e sem qualquer responsabilidade perante a KONTROLE.

      Você é o único responsável por cancelar sua conta de usuário. Você pode cancelar sua conta de usuário selecionando a opção apropriada na interface da conta de usuário. Após o encerramento da sua conta de usuário, o seu conteúdo será excluído do site e dos serviços.
      </p>

      <h3 class="pt-4 text-lg" >Exclusão de conta</h3>
      <p class="pt-4 text-justify">
      Os planos pagos passam para o plano gratuito de acordo com o processo descrito acima. Se uma instância do KONTROLE em um plano gratuito (convertida em um plano gratuito ou originalmente em um plano gratuito) estiver completamente inativa ao longo de 30 dias, ela será 'arquivada' e poderá ser recuperada apenas por uma conta de administrador ( você ou um usuário na instância com direitos de administrador). Para recuperar a conta, um administrador simplesmente precisa fazer login.

      Se nenhum administrador efetuar login por mais 15 dias após a instância ter sido 'arquivada', a instância do KONTROLE será excluída.
      </p>

      <h3 class="pt-4 text-lg" >Tarefa</h3>
      <p class="pt-4 text-justify">
      A KONTROLE pode atribuir ou delegar estes Termos de Serviço, no todo ou em parte, a qualquer pessoa ou entidade a qualquer momento, com ou sem o seu consentimento. Você, no entanto, não pode ceder ou delegar quaisquer direitos ou obrigações sob estes Termos de Serviço sem o consentimento prévio por escrito da KONTROLE, e qualquer atribuição e delegação não autorizada por você é nula e ineficaz.
      </p>

      <h3 class="pt-4 text-lg" >Acesso ao Serviço</h3>
      <p class="pt-4 text-justify">
      Se este site não estiver disponível por um período ou a qualquer momento, a KONTROLE não será responsável. O KONTROLE não oferece garantias quanto à acessibilidade, desempenho ou disponibilidade do Site ou Serviços. A suspensão temporária do acesso a este site ou serviços pode ocorrer sem aviso prévio, a nosso critério, incluindo, sem limitação, no caso de reparo, manutenção, falha do sistema ou por razões fora do nosso controle. A KONTROLE se reserva o direito de suspender a operação dos Serviços, deste Site ou de qualquer parte dele. Você concorda que nem a KONTROLE nem seus fornecedores terceirizados serão responsáveis ​​perante você de qualquer forma pelo término, suspensão, interrupção, atraso de qualquer um dos serviços e produtos neste site.
      </p>

      <h3 class="pt-4 text-lg" >Força maior</h3>
      <p class="pt-4 text-justify">
      O KONTROLE não se responsabiliza por qualquer não desempenho, atraso, erro, perda de dados ou outras perdas causadas por eventos ou condições que estejam além do controle razoável do KONTROLE.
      </p>

      <h3 class="pt-4 text-lg" >Acordo para Negociar Eletronicamente</h3>
      <p class="pt-4 text-justify">
      Todas as transações com ou através deste site ou da KONTROLE podem, a nosso critério, ser conduzidas e executadas eletronicamente. Podemos manter registros de qualquer tipo de comunicação realizada através deste site. Todos os registros eletrônicos são considerados enviados quando endereçados adequadamente ao destinatário e o registro entra em um sistema de processamento de informações fora do controle do remetente ou o registro entra em uma região de um sistema de processamento de informações sob o controle do destinatário. Todos os registros eletrônicos são recebidos quando o registro entra em um sistema de processamento de informações que o destinatário designou ou usa para fins de recebimento de registros ou informações eletrônicas do tipo enviado, em uma forma capaz de ser processada por esse sistema,
      </p>

      <h3 class="pt-4 text-lg" >Alívio injuntivo</h3>
      <p class="pt-4 text-justify">
      Você reconhece e concorda que qualquer violação ou violação destes Termos de Serviço pode causar danos e danos imediatos e irreparáveis ​​ao KONTROLE. Como resultado, a KONTROLE tem o direito de, e pode, a seu critério, obter imediatamente uma medida cautelar preliminar (incluindo, sem limitação, ordens de restrição temporárias) e buscar uma medida cautelar permanente em relação a qualquer violação ou violação destes Termos de Serviço. Além de todos e quaisquer outros recursos disponíveis para a KONTROLE por lei ou por patrimônio, a KONTROLE pode buscar desempenho específico de qualquer termo nestes Termos de Serviço.
      </p>

      <h3 class="pt-4 text-lg" >Divisibilidade</h3>
      <p class="pt-4 text-justify">
      Estes Termos de Serviço serão aplicados na extensão máxima permitida pela lei aplicável. Se, por qualquer motivo, qualquer disposição destes Termos de Serviço for considerada inválida ou inexequível nos termos da lei aplicável, em qualquer medida, (a) tal disposição será interpretada, interpretada ou reformada na extensão razoavelmente necessária para tornar a mesma aplicação válida e executável e consistente com a intenção original subjacente a essa provisão e (b) tal invalidez ou inaplicabilidade não afetará nenhuma outra provisão deste Contrato.
      </p>

      <h3 class="pt-4 text-lg" >Lei aplicável</h3>
      <p class="pt-4 text-justify">
      Estes Termos de Serviço serão regidos e interpretados de acordo com as leis da Commonwealth of Virginia, sem levar em consideração suas regras de conflito de leis. Você concorda com a jurisdição exclusiva dos tribunais da Commonwealth of Virginia por qualquer reclamação ou causa de ação decorrente de, ou relacionada a ou relacionada a estes Termos de serviço ou a este site, desde que essa exclusividade não se aplique a ações legais iniciado ou trazido pela KONTROLE.
      </p>
      <p class="pt-4 text-justify">
      O KONTROLE não assume nenhuma responsabilidade nem assume riscos se, por qualquer motivo, um produto ou serviço disponibilizado neste site violar as leis nacionais de qualquer país. Aqueles que acessam este site o fazem por sua própria iniciativa e são responsáveis ​​pelo cumprimento de suas leis nacionais.

      As perguntas podem ser enviadas no site . Por favor, leia também nossa Política de Privacidade .
      </p>

      <h3 class="pt-4 text-lg" >Parte Contratante</h3>
      <p class="pt-4 text-justify">
      A entidade KONTROLE que celebra este Contrato e o endereço para notificações do usuário dependem do seu país e, a menos que especificado de outra forma na fatura do usuário, deve ser definido de acordo com o seguinte:</h4>
    <br>
    <br>
    </div>






                <!-----------fim-------->


    </body>
</html>
