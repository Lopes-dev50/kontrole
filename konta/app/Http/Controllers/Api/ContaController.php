<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Moviment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\SupportResource;
use App\Services\SupportService;
use App\Classes\Enc;
use App\Classes\Logger;
use App\Http\Requests\DinheiroRequest;
use Carbon\Carbon;

class ContaController extends Controller
{
    private $Enc;
    private $Logger;
  
    public function __construct()
    {
      $this->middleware('auth');
      $this->Enc = new Enc();
      $this->Logger = new Logger();
    }
   
   //==================================API do APP =================================
 public function ListaConta($id, Request $request) {

    if (User::where('id', $id)->exists()) {
        $conta = Moviment::where([['user_id', '=', $id]])->get()->toJson(JSON_PRETTY_PRINT);
        return response($conta, 200);
      } else {
        return response()->json([
          "message" => "Conta não encontrato"
        ], 404);
      }
    }


    //===============================================
    public function addConta(DinheiroRequest $request, $id){


        if (User::where('id', $id)->exists()) {
        $user_id = $id;
        $this->Logger->log('info', 'Cadastrou um registro');
      
      switch ($request->get('etiqueta')) {
        case 'Renda':
            $tipo = 'E';
            break;
        case 'Renda Extra':
            $tipo = 'E';
            break;
        case 'Venda':
            $tipo = 'E';
            break;
        case 'Investimento':
            $tipo = 'M';
            break;    
        default:
        $tipo = 'S';
            break;
    }


    if($tipo == 'S'){
        $pago = 'N';
      }else{
        $pago = 'S';
      };

      $mesAtual = $request->input('omes');
      $anoAtual = $request->input('oano');
      $dataAtual = Carbon::now(); // Obtém a data atual
      $dia = strip_tags($request->dia ?? '1'); // Define o valor do novo dia
      
      $dataAtual->day($dia); // Define o dia da data atual como o valor de $dia
      $dataAtual->month($mesAtual); // Define o mês da data atual como o valor de $mesAtual
      $dataAtual->year($anoAtual); // Define o ano atual
      
      
      if($tipo == 'M'){
        $valor = $request->input('valor');
        $valorNumerico = preg_replace('/[\.,]/', '', $valor); // Remove pontos e vírgulas

      }else{
        $valor = $request->input('valor');
        $valorSemPontos = preg_replace('/[\.,]/', '', $valor); // Remove pontos e vírgulas
        $valorNumerico = (float) str_replace(',', '.', $valorSemPontos); // Converte para um número de ponto flutuante

      }

     $p = intval(strip_tags($request->parcelas ?? '0'));
        for ($i = 0; $i < $p; $i++) {
    $dinheiro = new Moviment();
    //..pega os dados vindos do form e seta no model
    $dinheiro->user_id = $user_id;
    $dinheiro->etiqueta = ucfirst(strip_tags($request->get('etiqueta') ?? 'Não Informado'));
    $dinheiro->motivo = ucfirst(strip_tags($request->get('motivo') ?? 'Não Informado'));
                 
    $dinheiro->valor =  $valorNumerico;
    $dinheiro->tipo = $tipo;
    $dinheiro->dia = strip_tags($request->dia ?? '1');
    $dinheiro->pago = $pago;
    $dinheiro->data = $dataAtual->format('Y-m-d');
    //..persiste o model na base de dados
    $dinheiro->save();
    // Adiciona 30 dias à data atual

    $dataAtual->addMonth();
}
     $user = User::find($user_id);
     $user->registro =  $user->registro + 1;
     $user->save();

    } else {
        // Retorna uma resposta JSON indicando que o usuário não foi encontrado
        return response()->json([
            "message" => "Cadastro com sucesso"
        ], 404);
    }
    }



    public function editConta()
    {
      # code...
    }


    public function delConta(){

    }

    public function listaMes(){

      
    }


    public function EntradasaidaPorAno($id, Request $request)
    {
        // Verifica se o usuário com o ID fornecido existe
        if (User::where('id', $id)->exists()) {
            // Aqui começa a adaptação dos códigos anteriores
            $user_id = $id;
            $ano = date('Y');
            $mes = date('m');
    //=====================================================================
            $totalEntradaPorAno = DB::table('moviments')
            ->selectRaw('YEAR(data) as ano, SUM(valor) as total')
            ->whereYear('data', '=', $ano)->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'E']])
            ->groupBy('ano')
            ->get();
        
        $totalSaidaPorAno = DB::table('moviments')
            ->selectRaw('YEAR(data) as ano, SUM(valor) as total')
            ->whereYear('data', '=', $ano)->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'S']])
            ->groupBy('ano')
            ->get();
        
        $data1 = $totalEntradaPorAno; // Defina os dados corretos para $data1
        $datasets = $totalSaidaPorAno; // Defina os dados corretos para $datasets
      //===============================================================================
        
        // Retorna os dados do gráfico em formato JSON
        return response()->json([
            'data1' => $data1,
            'data2' => $datasets,
           
        ]);
        } else {
            // Retorna uma resposta JSON indicando que o usuário não foi encontrado
            return response()->json([
                "message" => "Usuário não encontrado"
            ], 404);
        }
    }

    public function EntradaPorAno($id, Request $request)
    {
        // Verifica se o usuário com o ID fornecido existe
        if (User::where('id', $id)->exists()) {
            // Aqui começa a adaptação dos códigos anteriores
            $user_id = $id;
            $ano = date('Y');
            $mes = date('m');
    //=====================================================================
                //========================================================anual entredas
                $emoviments = DB::table('moviments')
                ->select(DB::raw('YEAR(data) as ano'), 'etiqueta', DB::raw('SUM(valor) as total'))
                ->whereYear('data', '=', $ano)
                ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'E']])
                ->groupBy('ano', 'etiqueta')
                ->orderBy('ano')
                ->get();
             
             $datae = [
              'labels' => $emoviments->pluck('mes')->unique()->toArray(),
              'datasets' => [],
             ];
             
             foreach ($emoviments->pluck('etiqueta')->unique() as $etiqueta) {
              $movimentsetiqueta = $emoviments->where('etiqueta', $etiqueta);
             
              $datae['datasets'][] = [
                  'label' => "Controle de valores da categoria " . $etiqueta,
                  'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
                  'data' => $movimentsetiqueta->pluck('total')->toArray(),
              ];
             }
             
             $labelse = $emoviments->pluck('etiqueta')->unique();
             $datae = $emoviments->pluck('total')->unique();
             
      //===============================================================================
        
        // Retorna os dados do gráfico em formato JSON
        return response()->json([
            'data3' => $datae,
            'data4' => $labelse,
           
        ]);
        } else {
            // Retorna uma resposta JSON indicando que o usuário não foi encontrado
            return response()->json([
                "message" => "Usuário não encontrado"
            ], 404);
        }
    }


    public function SaidaPorAno($id, Request $request)
    {
        // Verifica se o usuário com o ID fornecido existe
        if (User::where('id', $id)->exists()) {
            // Aqui começa a adaptação dos códigos anteriores
            $user_id = $id;
            $ano = date('Y');
            $mes = date('m');
    //=====================================================================
                //========================================================anual entredas
                $emoviments = DB::table('moviments')
                ->select(DB::raw('YEAR(data) as ano'), 'etiqueta', DB::raw('SUM(valor) as total'))
                ->whereYear('data', '=', $ano)
                ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'S']])
                ->groupBy('ano', 'etiqueta')
                ->orderBy('ano')
                ->get();
             
             $datae = [
              'labels' => $emoviments->pluck('mes')->unique()->toArray(),
              'datasets' => [],
             ];
             
             foreach ($emoviments->pluck('etiqueta')->unique() as $etiqueta) {
              $movimentsetiqueta = $emoviments->where('etiqueta', $etiqueta);
             
              $datae['datasets'][] = [
                  'label' => "Controle de valores da categoria " . $etiqueta,
                  'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
                  'data' => $movimentsetiqueta->pluck('total')->toArray(),
              ];
             }
             
             $labelse = $emoviments->pluck('etiqueta')->unique();
             $datae = $emoviments->pluck('total')->unique();
             
      //===============================================================================
        
        // Retorna os dados do gráfico em formato JSON
        return response()->json([
            'data5' => $datae,
            'data6' => $labelse,
           
        ]);
        } else {
            // Retorna uma resposta JSON indicando que o usuário não foi encontrado
            return response()->json([
                "message" => "Usuário não encontrado"
            ], 404);
        }
    }


    public function GeralAno($id, Request $request)
    {
        // Verifica se o usuário com o ID fornecido existe
        if (User::where('id', $id)->exists()) {
            // Aqui começa a adaptação dos códigos anteriores
            $user_id = $id;
            $ano = date('Y');
            $mes = date('m');
    //=====================================================================entreda e saida 
    $totalEntradaPorAno = DB::table('moviments')
    ->selectRaw('YEAR(data) as ano, SUM(valor) as total')
    ->whereYear('data', '=', $ano)
    ->where([
        ['user_id', '=', $user_id],
        ['tipo', '=', 'E']
    ])
    ->groupBy('ano')
    ->get();

    $totalSaidaPorAno = DB::table('moviments')
    ->selectRaw('YEAR(data) as ano, SUM(valor) as total')
    ->whereYear('data', '=', $ano)
    ->where([
        ['user_id', '=', $user_id],
        ['tipo', '=', 'S']
    ])
    ->groupBy('ano')
    ->get();

    $data1 = $totalEntradaPorAno->pluck('total')->toArray();
    $data2 = $totalSaidaPorAno->pluck('total')->toArray();
    $years = $totalEntradaPorAno->pluck('ano')->toArray();
    
    $datasets = ['Entrada', 'Saída'];
    
    $dataa = [
       
        'datasets' => [],
    ];
    
    foreach ($datasets as $index => $label) {
        $dataa['datasets'][] = [
            'label' => $label,
            'data' => ($index == 0) ? $data1 : $data2,
        ];
    }
         //========================================================anual entredas
         $emoviments = DB::table('moviments')
         ->select(DB::raw('YEAR(data) as ano'), 'etiqueta', DB::raw('SUM(valor) as total'))
         ->whereYear('data', '=', $ano)
         ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'E']])
         ->groupBy('ano', 'etiqueta')
         ->orderBy('ano')
         ->get();
      
      $datae = [
       'labels' => $emoviments->pluck('mes')->unique()->toArray(),
       'datasets' => [],
      ];
      
      foreach ($emoviments->pluck('etiqueta')->unique() as $etiqueta) {
       $movimentsetiqueta = $emoviments->where('etiqueta', $etiqueta);
      
       $datae['datasets'][] = [
           'label' => "Controle de valores da categoria " . $etiqueta,
           'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
           'data' => $movimentsetiqueta->pluck('total')->toArray(),
       ];
      }
      
      $labelse = $emoviments->pluck('etiqueta')->unique();
      $datae = $emoviments->pluck('total')->unique();


                //========================================================anual entredas
                $emoviments = DB::table('moviments')
                ->select(DB::raw('YEAR(data) as ano'), 'etiqueta', DB::raw('SUM(valor) as total'))
                ->whereYear('data', '=', $ano)
                ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'S']])
                ->groupBy('ano', 'etiqueta')
                ->orderBy('ano')
                ->get();
             
             $datae2 = [
              'labels' => $emoviments->pluck('mes')->unique()->toArray(),
              'datasets' => [],
             ];
             
             foreach ($emoviments->pluck('etiqueta')->unique() as $etiqueta) {
              $movimentsetiqueta = $emoviments->where('etiqueta', $etiqueta);
             
              $datae2['datasets'][] = [
                  'label' => "Controle de valores da categoria " . $etiqueta,
                  'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
                  'data' => $movimentsetiqueta->pluck('total')->toArray(),
              ];
             }
             
             $labelsd = $emoviments->pluck('etiqueta')->unique();
             $datae2 = $emoviments->pluck('total')->unique();
             
      //===============================================================================
        
        // Retorna os dados do gráfico em formato JSON
        return response()->json([
            
            'data3' => $datae,
            'data4' => $labelse,
            'data5' => $datae2,
            'data6' => $labelsd,
           
        ]);
        } else {
            // Retorna uma resposta JSON indicando que o usuário não foi encontrado
            return response()->json([
                "message" => "Usuário não encontrado"
            ], 404);
        }
    }





     //===================================etiquetas==========
     public function AppListaEtiqueta($id, Request $request) {

        if (User::where('id', $id)->exists()) {
            $corretor = Moviment::distinct()->where([ ['user_id', '=', $id] ])->orderBy('etiqueta')->get(['etiqueta']);
            return response($corretor, 200);
          } else {
            return response()->json([
              "message" => "Corretor não encontrato"
            ], 404);
          }
        }


         //===================================etiquetas==========
     public function filtro($id, Request $request) {

        if (User::where('id', $id)->exists()) {
       
            $corretor = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
            ->orderBy(DB::raw('YEAR(data)'), 'asc')
            ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $id)
            ->take(12)
            ->get();
    
           // $filtros['filtros'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
           // ->orderBy(DB::raw('YEAR(data)'), 'asc')
           // ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $id)
       //
           // ->get();

        
        
        
           return response($corretor, 200);
        } else {
            return response()->json([
              "message" => "Corretor não encontrato"
            ], 404);
          }
        }

//======================================================================
        public function mostracadames($id, $mes, $ano){

   
            if (User::where('id', $id)->exists()) {

                $corretor = DB::table('moviments')
                ->whereYear('data', '=', $ano)->whereMonth('data', '=', $mes)->where('user_id', '=', $id)->orderBy('id', 'desc')->get();

           
                // dd($mes);
               //========================================================mensal saidas 
          //       $corretor = DB::table('moviments')
          //    ->select(DB::raw('MONTH(data) as mes'), 'etiqueta', DB::raw('SUM(valor) as total'))
          //    ->whereYear('data', '=', $ano)->whereMonth('data', '=', $mes)
          //    ->groupBy('mes', 'etiqueta')->where([['user_id', '=',  $id], [ 'tipo', '=', 'S']])
          //    ->orderBy('mes')
          //    ->get();

            return response($corretor, 200);
        } else {
            return response()->json([
              "message" => "Corretor não encontrato"
            ], 404);
          }
        }

         //=============================================Editar cliente=============================
         public function EdtConta($id, Request $request) {
            $cliente = Moviment::find($id);
            if (!$cliente) {
                return response()->json([
                    "message" => "Corretor não encontrado"
                ], 404);
            }
            $valor = $request->input('valor');
            $valorNumerico = preg_replace('/[\.,]/', '', $valor); // Remove pontos e vírgulas
    
           
             if($request->get('pago') == 'S'){
                $pago = 'S';
              }else{
                $pago = 'N';
              };
    
              $mesAtual = $request->get('omes');
              $anoAtual = $request->get('oano');
              $diaAtual = $request->get('dia');
              $dataAtual = Carbon::now(); // Obtém a data atual
             
              
              $dataAtual->day($diaAtual); // Define o dia da data atual como o valor de $dia
              $dataAtual->month($mesAtual); // Define o mês da data atual como o valor de $mesAtual
              $dataAtual->year($anoAtual); // Define o ano atual
          
              
    
             $dinheiro = Moviment::find($id);
    
            
             //..atualiza os atributos do objeto recuperado com os dados do objeto Request
             $dinheiro->etiqueta = ucfirst(strip_tags($request->get('etiqueta')));
             $dinheiro->motivo = ucfirst(strip_tags($request->get('motivo')));
             $dinheiro->valor = $valorNumerico;
             $dinheiro->data = $dataAtual->format('Y-m-d');
             $dinheiro->dia = $request->get('dia');
             $dinheiro->pago = $pago;
            // $dinheiro->data = $request->input('data');
             //..persite as alterações na base de dados
             $dinheiro->save();
             //..retorna a view index com uma mensagem
             $dinheiros = Moviment::all();
        
            return response()->json([
                "status" => 1,
                "msg" => "Atualizado"
            ]);
        }
        
    //===========================================================

        public function ContaUnico($id, $userid, Request $request) {

            if (User::where('id', $id)->exists()) {
                $corretor = Moviment::where([['id', '=', $userid],])->get()->toJson(JSON_PRETTY_PRINT);
                return response($corretor, 200);
              } else {
                return response()->json([
                  "message" => "Corretor não encontrato"
                ], 404);
              }
            }

     //============================================================================
    public function deletarCliente($id){
        $user_id = auth()->user()->id; //capturamos el ID del usuario
        if( Moviment::where( ["id" => $id, "user_id" => $user_id ])->exists() ){
            $blog = Moviment::where( ["id" => $id, "user_id" => $user_id ])->first();
            $blog->delete();
            //responde la API
            return response()->json([
                "status" => 1,
                "msg" => "El blog fue eliminado correctamente."
            ]);
        }else{
             //responde la API
             return response()->json([
                "status" => 0,
                "msg" => "No de encontró el Blog"
            ], 404);
        }
    }





}    
   

  