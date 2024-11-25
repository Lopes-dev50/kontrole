<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Moviment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Bonus;
use Illuminate\Support\Facades\DB;


class EdminController extends Controller
{
    public function index(){

       $cliente = User::orderByDesc('updated_at')->paginate(15);
       //$cliente = User::paginate(15);
      //  $cliente = User::where(['plano', '=', 'Glod'] )->orderBy('name')->paginate(15);


      $users = DB::table('users')
      ->select(DB::raw('YEAR(created_at) as ano'), DB::raw('MONTH(created_at) as mes'), DB::raw('COUNT(*) as total'))
      ->groupBy('ano', 'mes')
      ->orderBy('ano', 'asc')
      ->orderBy('mes', 'asc')
      ->get();
  
  $dataUsuarios = [
      'labels' => $users->map(function ($item) {
          $monthName = Carbon::createFromFormat('!m', $item->mes)->format('F');
          return $monthName;
      })->toArray(),
      'datasets' => [
          [
              'label' => 'Novos Usuários',
              'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
              'borderColor' => 'rgba(54, 162, 235, 1)',
              'data' => $users->pluck('total')->toArray(),
          ],
      ],
  ];


  //=========================plano 
  $ano = date('Y');

  $totalGold = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('plano', 'Gold')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $totalFree = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('plano', 'Free')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $totalBonus = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('plano', 'Gold+Bônus')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $data = [
      'labels' => ['Gold', 'Gold+bônus', 'Free'],
      'datasets' => [
          [
              'data' => [
                  $totalGold->total,
                  $totalBonus->total,
                  $totalFree->total,
              ],
              'backgroundColor' => [
                  'rgba(255, 206, 86, 0.7)',
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(54, 102, 235, 0.6)',
              ],
          ],
      ],
  ];



  //=========================Origem
  $ano = date('Y');

  $totalIndicado = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'Indicado')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $totalPesquisando = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'Pesquisando')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $totalYouTube = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'YouTube')
      ->whereYear('created_at', '=', $ano)
      ->first();

      $totalFaceBook = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'FaceBook')
      ->whereYear('created_at', '=', $ano)
      ->first();

      $totalInstagram = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'Instagram')
      ->whereYear('created_at', '=', $ano)
      ->first();

      $totalTikTok = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'TikTok')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $dataOrigem = [
      'labels' => ['Indicado', 'Pesquisando', 'YouTube', 'FaceBook', 'Instagram', 'TikTok'],
      'datasets' => [
          [
              'data' => [
                $totalIndicado->total,
                $totalPesquisando->total,
                $totalYouTube->total,
                $totalFaceBook->total,
                $totalInstagram->total,
                $totalTikTok->total,
              ],
              'backgroundColor' => [
                  'rgba(255, 206, 86, 0.7)',
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(54, 102, 235, 0.6)',
                  'rgba(154, 102, 235, 0.6)',
                  'rgba(54, 102, 35, 0.6)',
                  'rgba(254, 102, 235, 0.6)',
              ],
          ],
      ],
  ];


  
  // Resto do código para exibir o gráfico em pizza
  
  

       return view('/edmin/lista', ['data' => $data, 'dataOrigem' => $dataOrigem, 'dataUsuarios' => $dataUsuarios, 'usuarios' => $cliente]);

    }

    //==========================bonus 365 dias 

    public function bonus($id){


        $user_id = $id;
        $valor = '00.00';
        $inicio_date = Carbon::now();

        $dataAtual = Carbon::now();

        $fim_date = $dataAtual->add(90, 'days')->format('Y-m-d');
            
        $dia = date('d'); 
      
        $status = 'ativo';

        User::where('id',$user_id)->update(array( 'status'=> $status));
        User::where('id',$user_id)->update(array( 'plano'=> 'Gold+Bônus'));
        User::where('id',$user_id)->update(array( 'bonus'=> 'SIM'));
        User::where('id',$user_id)->update(array( 'inicio_date' =>$inicio_date ));
        User::where('id',$user_id)->update(array( 'fim_date' => $fim_date ));
        Moviment::create([ 'etiqueta' => 'Kontrole', 'motivo'=> 'Bônus', 'dia' => $dia, 'valor' =>$valor, 'data' =>$inicio_date, 'tipo'=>'S', 'pago' => 'S', 'user_id' => $user_id,  ]);

       
        $cliente = User::paginate(15);

        $usuario = DB::table('users')->where('id', $user_id)->first();

        $mailData = [
       
            'title' => 'Ola! '.$usuario->name . ', um presente para você!',
            'body1' => ' É com grande prazer que anunciamos uma ótima notícia para você! Como parte do nosso compromisso em ajudar nossos clientes a se organizarem financeiramente, temos o prazer de informar que você ganhou um bônus exclusivo da empresa. A partir de agora, você terá acesso GRATUITO ao nosso sistema Kontrole por TRÊS MESES!',
            'body2' => 'Na Kontrole, acreditamos que a organização financeira é fundamental para alcançar a estabilidade e o sucesso financeiro. Nosso sistema foi projetado com esse objetivo em mente, e oferece uma ampla gama de recursos e ferramentas para ajudá-lo a gerenciar suas finanças de forma eficiente e inteligente.',
            'body3' => 'Compartilhe a oportunidade de uma melhor organização financeira com seus amigos, familiares e colegas! Convide-os para conhecer a plataforma Kontrole em www.kontrole.com.br e aproveitar o mesmo bônus exclusivo que você recebeu. Juntos, podemos alcançar estabilidade financeira e ajudar mais pessoas a gerenciar suas finanças de forma eficiente.',
            'body4' => 'Parabéns novamente pelo bônus e aproveite os benefícios do Kontrole!'
            
          ];
        
          Mail::to($usuario->email)->send(new Bonus($mailData));
          


  //=========================plano 
  $users = DB::table('users')
  ->select(DB::raw('YEAR(created_at) as ano'), DB::raw('MONTH(created_at) as mes'), DB::raw('COUNT(*) as total'))
  ->groupBy('ano', 'mes')
  ->orderBy('ano', 'asc')
  ->orderBy('mes', 'asc')
  ->get();

  $dataUsuarios = [
    'labels' => $users->map(function ($item) {
        $monthName = Carbon::createFromFormat('!m', $item->mes)->format('F');
        return $monthName;
    })->toArray(),
    'datasets' => [
        [
            'label' => 'Novos Usuários',
            'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
            'borderColor' => 'rgba(54, 162, 235, 1)',
            'data' => $users->pluck('total')->toArray(),
        ],
    ],
];
  $ano = date('Y');

  $totalGold = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('plano', 'Gold')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $totalFree = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('plano', 'Free')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $totalBonus = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('plano', 'Gold+Bônus')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $data = [
      'labels' => ['Gold', 'Gold+bônus', 'Free'],
      'datasets' => [
          [
              'data' => [
                  $totalGold->total,
                  $totalBonus->total,
                  $totalFree->total,
              ],
              'backgroundColor' => [
                  'rgba(255, 206, 86, 0.7)',
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(54, 102, 235, 0.6)',
              ],
          ],
      ],
  ];



  //=========================Origem
  $ano = date('Y');

  $totalIndicado = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'Indicado')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $totalPesquisando = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'Pesquisando')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $totalYouTube = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'YouTube')
      ->whereYear('created_at', '=', $ano)
      ->first();

      $totalFaceBook = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'FaceBook')
      ->whereYear('created_at', '=', $ano)
      ->first();

      $totalInstagram = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'Instagram')
      ->whereYear('created_at', '=', $ano)
      ->first();

      $totalTikTok = DB::table('users')
      ->select(DB::raw('COUNT(*) as total'))
      ->where('origem', 'TikTok')
      ->whereYear('created_at', '=', $ano)
      ->first();
  
  $dataOrigem = [
      'labels' => ['Indicado', 'Pesquisando', 'YouTube', 'FaceBook', 'Instagram', 'TikTok'],
      'datasets' => [
          [
              'data' => [
                $totalIndicado->total,
                $totalPesquisando->total,
                $totalYouTube->total,
                $totalFaceBook->total,
                $totalInstagram->total,
                $totalTikTok->total,
              ],
              'backgroundColor' => [
                  'rgba(255, 206, 86, 0.7)',
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(54, 102, 235, 0.6)',
                  'rgba(154, 102, 235, 0.6)',
                  'rgba(54, 102, 35, 0.6)',
                  'rgba(254, 102, 235, 0.6)',
              ],
          ],
      ],
  ];


        
       return view('/edmin/lista', ['data' => $data, 'dataOrigem' => $dataOrigem, 'dataUsuarios' => $dataUsuarios, 'usuarios' => $cliente]);

    }
  
  
   public function adminEmail($id){

        $user_id = $id;

      
        $usuario = DB::table('users')->where('id', $user_id)->first();

        //====inscreveu e ainda não usou
        $mailData = [
       
            'title' => 'Ola! '.$usuario->name . '',
            'body1' => 'Espero que esta mensagem o encontre bem. Sou Bruno e faço parte da equipe da plataforma Kontrole. Gostaríamos de agradecer por se cadastrar em nossa plataforma e expressar nosso entusiasmo em tê-lo como parte de nossa comunidade.',
            'body2' => 'Entendemos que você recentemente criou uma conta conosco, e estamos aqui para ajudá-lo a começar a gerenciar suas finanças com facilidade. A plataforma Kontrole oferece uma variedade de recursos e ferramentas para ajudá-lo a organizar suas finanças pessoais, definir metas, acompanhar despesas e muito mais.',
            'body3' => 'Caso ainda não tenha começado a usar a plataforma, gostaríamos de encorajá-lo a fazer isso o mais rápido possível. Acreditamos que você encontrará valor em nossos recursos e que eles podem ajudá-lo a tomar decisões financeiras informadas.',
            'body4' => 'Se tiver alguma dúvida sobre como começar ou precisar de assistência em qualquer etapa do processo, não hesite em entrar em contato conosco (51) 99960-6937 . Nossa equipe de suporte estará disponível para ajudá-lo a aproveitar ao máximo a plataforma Kontrole.'
            
          ];
        
          Mail::to($usuario->email)->send(new Bonus($mailData));

          User::where('id',$user_id)->update(array( 'acho'=> 'Email'));

          return redirect()->back()->with('success',"Email com sucesso");




    }
  
  
  
  
}
