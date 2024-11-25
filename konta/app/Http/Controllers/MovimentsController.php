<?php

namespace App\Http\Controllers;

use App\Models\Moviment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Classes\Enc;
use App\Classes\Logger;
use App\Http\Requests\DinheiroRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class MovimentsController extends Controller
{
   
    private $Enc;
    private $Logger;
  
    public function __construct()
    {
      $this->middleware('auth');
      $this->Enc = new Enc();
      $this->Logger = new Logger();
    }

    
    public function index() // mostra a página inicial do recurso, normalmente uma listagem de recursos cadastrados;
    {
               

        $usuario = DB::table('users')->where('id', Auth::user()->id)->first();

        $dataAtual = Carbon::now();

        User::where('id',Auth::user()->id)->update(array( 'updated_at' => $dataAtual ));
        $fim_date = Carbon::parse($usuario->fim_date);
        
        if ($usuario->status == 'ativo' && $fim_date->gte($dataAtual)) {
            // usuário ainda está ativo, não faz nada
            $ano = date('Y');
            $mes = date('m');
            $mesAtual = Carbon::now()->month;
            $user_id = Auth::user()->id;
           
                        $dinheiros = DB::table('moviments')
                        ->whereYear('data', '=', $ano)->whereMonth('data', '=', $mes)->where('user_id', '=',  $user_id)->orderBy('id', 'desc')->get();
                 
                       
                      
                        $totalMeta = DB::table('moviments')
                        ->selectRaw('YEAR(data) as ano, SUM(valor) as total')
                        ->whereYear('data', '=', $ano)->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'M']])
                        ->groupBy('ano')
                        ->get();

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
            
               
                        $totalEntradaPorMes = DB::table('moviments')
            ->selectRaw('MONTH(data) as mes, SUM(valor) as total')
            ->whereYear('data', '=', $ano)
            ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'E']])
            ->whereMonth('data', '=', $mes)
            ->groupBy('mes')
            ->get();
        
        $totalSaidaPorMes = DB::table('moviments')
            ->selectRaw('MONTH(data) as mes, SUM(valor) as total')
            ->whereYear('data', '=', $ano)
            ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'S']])
            ->whereMonth('data', '=', $mes)
            ->groupBy('mes')
            ->get();
        
        //==================grafico==============
        $entrada = 0;
        $saida = 0;
        
        foreach ($totalEntradaPorAno as $entradaMes) {
            $entrada = $entradaMes->total;
        }
        
        foreach ($totalSaidaPorAno as $saidaMes) {
            $saida = $saidaMes->total;
        }
        
        $dadosPizza = [
            'Entradas' => $entrada,
            'Saídas' => $saida,
        ];
             //====================================anual 
             
            
             $moviments = DB::table('moviments')
            ->select('etiqueta', DB::raw('YEAR(data) as year'), DB::raw('SUM(valor) as total'))
            ->groupBy('etiqueta', 'year')->where('user_id', '=',  $user_id)
            ->get();
        
        $labels = $moviments->pluck('etiqueta')->toArray();
        
        $datasets = [];
        foreach ($moviments->unique('year') as $yearData) {
            $year = $yearData->year;
            $totals = $moviments->where('year', $year)->pluck('total')->toArray();
            $datasets[] = [
                'label' => 'Valores do ano de '.$year,
                'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
                'data' => $totals,
            ];
        }
        
        $data2 = [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
        
            //========================================================anual
            $mesmoviments = DB::table('moviments')
           ->select(DB::raw('YEAR(data) as ano'), 'etiqueta', DB::raw('SUM(valor) as total'))
           ->whereYear('data', '=', $ano)
           ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'S']])
           ->groupBy('ano', 'etiqueta')
           ->orderBy('ano')
           ->get();
        
        $data1 = [
            'labels' => $mesmoviments->pluck('mes')->unique()->toArray(),
            'datasets' => [],
        ];
        
        foreach ($mesmoviments->pluck('etiqueta')->unique() as $etiqueta) {
            $movimentsetiqueta = $mesmoviments->where('etiqueta', $etiqueta);
        
            $data1['datasets'][] = [
                'label' => "Controle de valores da categoria " . $etiqueta,
                'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
                'data' => $movimentsetiqueta->pluck('total')->toArray(),
            ];
        }
        
        $labels1 = $mesmoviments->pluck('etiqueta')->unique();
        $data1 = $mesmoviments->pluck('total')->unique();
        
        
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
        
        
        if(Auth::user()->status == 'ativo'){
        //========filtra ano ==========
        $data3['filtro'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
        ->orderBy(DB::raw('YEAR(data)'), 'asc')
        ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)->whereYear('data', '=', $ano)
        ->take(12)
        ->get();

        $filtros['filtros'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
    ->orderBy(DB::raw('YEAR(data)'), 'asc')
    ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)
   
    ->get();
        

        }else{
            $data3['filtro'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
            ->orderBy(DB::raw('YEAR(data)'), 'asc')
            ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)
            ->take(3)
            ->get();

            $filtros['filtros'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
            ->orderBy(DB::raw('YEAR(data)'), 'asc')
            ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)
            ->get();

        }
         
        $etiquetas_distintas = Moviment::distinct('etiqueta')
        ->where('user_id', $user_id)
        ->orderBy('etiqueta')
        ->get(['etiqueta']);
         
        $EntradaPorAno = DB::table('moviments')
        ->selectRaw('YEAR(data) as ano, MONTH(data) as mes, SUM(valor) as total')
        ->whereYear('data', '=', $ano)
        ->where([
            ['user_id', '=', $user_id],
            ['tipo', '=', 'E']
        ])
        ->groupBy('ano', 'mes')
        ->get();
    
       $SaidaPorAno = DB::table('moviments')
        ->selectRaw('YEAR(data) as ano, MONTH(data) as mes, SUM(valor) as total')
        ->whereYear('data', '=', $ano)
        ->where([
            ['user_id', '=', $user_id],
            ['tipo', '=', 'S']
        ])
        ->groupBy('ano', 'mes')
        ->get();
           return view('/dinheiro/painel', ['entradaPorAno' =>$EntradaPorAno, 'saidaPorAno'=>$SaidaPorAno, 'etiqueta' =>$etiquetas_distintas , 'totalmeta' => $totalMeta, 'filtros' => $filtros, 'datae' => $datae, 'data3' => $data3,  'data1' => $data1, 'labelse' => $labelse, 'labels1' => $labels1, 'moviments' => $moviments, 'dinheiros' => $dinheiros, 'totalEntradaPorAno' => $totalEntradaPorAno, 'totalSaidaPorAno' => $totalSaidaPorAno, 'totalEntradaPorMes' => $totalEntradaPorMes, 'totalSaidaPorMes' => $totalSaidaPorMes, 'dadosPizza' => $dadosPizza, 'labels' => $labels, 'data2' => $data2]);

        } else {
            // usuário expirou ou já está desativado
            $usuario->status = 'desativado';
            $usuario->fim_date = $fim_date->gte($dataAtual) ? $fim_date : $dataAtual->addDays(30);
            DB::table('users')->where('id', Auth::user()->id)->update([
                'status' => $usuario->status,
                'fim_date' => $usuario->fim_date,
                'plano' => 'Free',
                'updated_at' => Carbon::now()

            ]);

            //===================valor
            $valormes = Auth::user()->valorpormes;  
            $valorano = Auth::user()->valorporano;
           
            return view('dinheiro/renovar', [ 'valormes' => $valormes, 'valorano' => $valorano]);
        }
        
                      
             }



//======================================================================
    public function adicionar(){
         // usuário ainda está ativo, não faz nada
           return view('/dinheiro/adicionar');
    }


    
    public function create() //  mostra a página que contém o formulário para a criação de um novo recurso;
    {
       //..mostrando o formulário de cadastro
   return view('dinheiros.create');
    }

    //===================================================================cadastro

    public function store(DinheiroRequest $request) //persiste um novo recurso na base de dados. O parâmetro de entrada é um objeto Request, contendo os dados vindos do cliente;
    {
       
        $user_id = Auth::user()->id;
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
   

      
               // return view('/dinheiro/painel', ['etiqueta' => $etiquetas_distintas,'totalmeta' => $totalMeta, 'filtros' => $filtros,  'datae' => $datae, 'data3' => $data3,  'data1' => $data1, 'labelse' => $labelse, 'labels1' => $labels1, 'moviments' => $moviments, 'dinheiros' => $dinheiros, 'totalEntradaPorAno' => $totalEntradaPorAno, 'totalSaidaPorAno' => $totalSaidaPorAno, 'totalEntradaPorMes' => $totalEntradaPorMes, 'totalSaidaPorMes' => $totalSaidaPorMes, 'dadosPizza' => $dadosPizza, 'labels' => $labels, 'data2' => $data2])->with('success', 'Cadastrado com sucesso!');
                return redirect()->back()->with('success',"Cadastro realizado com sucesso");
   
            }





    //===========================================================================
    public function show(string $id) // mostra um recurso mediante o $id informado;
    {
      
       //..recupera o veículo da base de dados
    $dinheiro = Moviment::find($id);
    //..se encontrar o veículo, retorna a view com o objeto correspondente
    if ($dinheiro) {
        return view('dinheiros.show')->with('dinheiro', $dinheiro);
    } else {
        //..senão, retorna a view com uma mensagem que será exibida.
        return view('dinheiros.show')->with('msg', 'Veículo não encontrado!');
    }
    }

   //==============================================================
    public function edit($id)
    {

        $id = $this->Enc->desencriptar($id);

        $dinheiros = Moviment::find($id);

        $dinheiros = DB::table('moviments')
        ->where('id', '=', $id)->get();
 
        
        if (!$dinheiros) {
            // handle the case where the record is not found
            return redirect()->back()->withErrors(['message' => 'Record not found']);
        }
        
        return view('/dinheiro/editar', ['dinheiros' => $dinheiros]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, $mes, $ano,  Request $request) //atualiza um recurso informado mediante o parâmetro $id com os dados vindos do cliente, presentes no objeto Request;
    {
        $id = $this->Enc->desencriptar($id);
        $mes = $this->Enc->desencriptar($mes);
        $ano = $this->Enc->desencriptar($ano);
       
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

         $this->Logger->log('info', 'Atualizou um registro');

         $mes = $this->Enc->encriptar($mes);
         $ano = $this->Enc->encriptar($ano);
         return redirect()->route('cada.mes', ['mes' => $mes, 'ano' => $ano])->with('success', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, $mes, $ano) //exclui um recurso da base dados, mediante o parâmetro $id.
    {
        $id = $this->Enc->desencriptar($id);
        $mes = $this->Enc->desencriptar($mes);
        $ano = $this->Enc->desencriptar($ano);
       
    $dinheiro = Moviment::find($id);
    //..exclui o recurso
    $dinheiro->delete();
    //..retorna à view index.

    $total = DB::table('moviments')
    ->selectRaw('MONTH(data) as mes, SUM(valor) as total')
    ->where([['user_id', '=',  Auth::user()->id]])
    ->whereMonth('data', '=', $mes)
    ->groupBy('mes')
    ->get();

    $this->Logger->log('info', 'Deletou um registro');
     
     if($total->isEmpty() ){

       return redirect()->route('controle.index')->with('success', 'Deletado com sucesso!');
     }else{
        $mes = $this->Enc->encriptar($mes);
        $ano = $this->Enc->encriptar($ano);
        return redirect()->route('cada.mes', ['mes' => $mes, 'ano' => $ano])->with('success', 'Deletado com sucesso!');
     }



   
    }

    /*
        index(): mostra a página inicial do recurso, normalmente uma listagem de recursos cadastrados;
        create(): mostra a página que contém o formulário para a criação de um novo recurso;
        store(Request $request): persiste um novo recurso na base de dados. O parâmetro de entrada é um objeto Request, contendo os dados vindos do cliente;
        show($id): mostra um recurso mediante o $id informado;
        edit($id): mostra a página que contém o formulário para edição de um recurso recuperado mediante o parâmetro $id;
        update(Request $request, $id): atualiza um recurso informado mediante o parâmetro $id com os dados vindos do cliente, presentes no objeto Request;
        destroy($id): exclui um recurso da base dados, mediante o parâmetro $id.
    */

   public function cadames($mes, $ano){

   

    $user_id = Auth::user()->id;
    $ano = $this->Enc->desencriptar($ano);
    $mes = $this->Enc->desencriptar($mes);
   // dd($mes);
       //========================================================mensal saidas 
    $mesmoviments = DB::table('moviments')
    ->select(DB::raw('MONTH(data) as mes'), 'etiqueta', DB::raw('SUM(valor) as total'))
    ->whereYear('data', '=', $ano)->whereMonth('data', '=', $mes)
    ->groupBy('mes', 'etiqueta')->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'S']])
    ->orderBy('mes')
    ->get();

$data1 = [
    'labels' => $mesmoviments->pluck('mes')->unique()->toArray(),
    'datasets' => [],
];

foreach ($mesmoviments->pluck('etiqueta')->unique() as $etiqueta) {
    $movimentsetiqueta = $mesmoviments->where('etiqueta', $etiqueta);

    $data1['datasets'][] = [
        'label' => "Controle de valores da categoria " . $etiqueta,
        'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
        'data' => $movimentsetiqueta->pluck('total')->toArray(),
    ];
}

$labels1 = $mesmoviments->pluck('etiqueta')->unique();
$data1 = $mesmoviments->pluck('total')->unique();

    //========================================================mensal entredas
    $emoviments = DB::table('moviments')
    ->select(DB::raw('MONTH(data) as mes'), 'etiqueta', DB::raw('SUM(valor) as total'))
    ->whereYear('data', '=', $ano)->whereMonth('data', '=', $mes)
    ->groupBy('mes', 'etiqueta')->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'E']])
    ->orderBy('mes')
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


if(Auth::user()->status == 'ativo'){
    //========filtra ano ==========
    $data3['filtro'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
    ->orderBy(DB::raw('YEAR(data)'), 'asc')
    ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)->whereYear('data', '=', $ano)
    ->take(12)
    ->get();

    $filtros['filtros'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
    ->orderBy(DB::raw('YEAR(data)'), 'asc')
    ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)
    ->get();

    $dataAtual['filtro'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
    ->orderBy(DB::raw('YEAR(data)'), 'asc')
    ->orderBy(DB::raw('MONTH(data)'), 'asc')
    ->where('user_id', '=', $user_id)
    ->whereRaw("MONTH(data) = ?", [$mes]) // Filtrar pelo mês desejado
    ->take(3)
    ->get();

    }else{
        $data3['filtro'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
        ->orderBy(DB::raw('YEAR(data)'), 'asc')
        ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)
        ->take(3)
        ->get();


        $dataAtual['filtro'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
        ->orderBy(DB::raw('YEAR(data)'), 'asc')
        ->orderBy(DB::raw('MONTH(data)'), 'asc')
        ->where('user_id', '=', $user_id)
        ->whereRaw("MONTH(data) = ?", [$mes]) // Filtrar pelo mês desejado
        ->take(3)
        ->get();

        $filtros['filtros'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
        ->orderBy(DB::raw('YEAR(data)'), 'asc')
        ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)
        ->get();

    }

    //=================entrada e saida por mes ======

    $totalEntradaPorMes = DB::table('moviments')
    ->selectRaw('MONTH(data) as mes, SUM(valor) as total')
    ->whereYear('data', '=', $ano)
    ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'E']])
    ->whereMonth('data', '=', $mes)
    ->groupBy('mes')
    ->get();

    $totalSaidaPorMes = DB::table('moviments')
    ->selectRaw('MONTH(data) as mes, SUM(valor) as total')
    ->whereYear('data', '=', $ano)
    ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'S']])
    ->whereMonth('data', '=', $mes)
    ->groupBy('mes')
    ->get();

//==================grafico==============
$entrada = 0;
$saida = 0;

foreach ($totalEntradaPorMes as $entradaMes) {
    $entrada = $entradaMes->total;
}

foreach ($totalSaidaPorMes as $saidaMes) {
    $saida = $saidaMes->total;
}

$dadosPizza = [
    'Entradas' => $entrada,
    'Saídas' => $saida,
];

$dinheiros = DB::table('moviments')
->whereYear('data', '=', $ano)->whereMonth('data', '=', $mes)->where('user_id', '=', $user_id)->orderBy('id', 'desc')->get();


                return view('/dinheiro/cadames', ['dataAtual' => $dataAtual, 'filtros' => $filtros, 'dinheiros' => $dinheiros,'datae' => $datae, 'data3' => $data3,  'data1' => $data1, 'labels1' => $labels1, 'labelse' => $labelse, 'totalEntradaPorMes' => $totalEntradaPorMes, 'totalSaidaPorMes' => $totalSaidaPorMes, 'dadosPizza' => $dadosPizza,]);
    }
   


    public function pagar($id, $mes, $ano, Request $request) //atualiza um recurso informado mediante o parâmetro $id com os dados vindos do cliente, presentes no objeto Request;
    {
      
        $id = $this->Enc->desencriptar($id);
        $mes = $this->Enc->desencriptar($mes);
        $ano = $this->Enc->desencriptar($ano);

         $pago = 'S';
         
         $dinheiro = Moviment::find($id);

         $dinheiro->pago = $pago;
       
         $dinheiro->save();
         //..retorna a view index com uma mensagem
         $dinheiros = Moviment::all();

         $mes = $this->Enc->encriptar($mes);
         $ano = $this->Enc->encriptar($ano);

         $this->Logger->log('info', 'Marcou como pago');
         return redirect()->route('cada.mes', ['mes' => $mes, 'ano' => $ano])->with('success', 'Atualizado com sucesso!');
    }


     //============free

     public function freeindex() // mostra a página inicial do recurso, normalmente uma listagem de recursos cadastrados;
     {
                
 
         
             // usuário ainda está ativo, não faz nada
             $ano = date('Y');
             $mes = date('m');
             $mesAtual = Carbon::now()->month;
             $user_id = Auth::user()->id;
            
                         $dinheiros = DB::table('moviments')
                         ->whereYear('data', '=', $ano)->whereMonth('data', '=', $mes)->where('user_id', '=',  $user_id)->orderBy('id', 'desc')->get();
                  
                        
                       
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
             
                
                         $totalEntradaPorMes = DB::table('moviments')
             ->selectRaw('MONTH(data) as mes, SUM(valor) as total')
             ->whereYear('data', '=', $ano)
             ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'E']])
             ->whereMonth('data', '=', $mes)
             ->groupBy('mes')
             ->get();
         
         $totalSaidaPorMes = DB::table('moviments')
             ->selectRaw('MONTH(data) as mes, SUM(valor) as total')
             ->whereYear('data', '=', $ano)
             ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'S']])
             ->whereMonth('data', '=', $mes)
             ->groupBy('mes')
             ->get();
         
         //==================grafico==============
         $entrada = 0;
         $saida = 0;
         
         foreach ($totalEntradaPorAno as $entradaMes) {
             $entrada = $entradaMes->total;
         }
         
         foreach ($totalSaidaPorAno as $saidaMes) {
             $saida = $saidaMes->total;
         }
         
         $dadosPizza = [
             'Entradas' => $entrada,
             'Saídas' => $saida,
         ];
              //====================================anual 
              
             
              $moviments = DB::table('moviments')
             ->select('etiqueta', DB::raw('YEAR(data) as year'), DB::raw('SUM(valor) as total'))
             ->groupBy('etiqueta', 'year')->where('user_id', '=',  $user_id)
             ->get();
         
         $labels = $moviments->pluck('etiqueta')->toArray();
         
         $datasets = [];
         foreach ($moviments->unique('year') as $yearData) {
             $year = $yearData->year;
             $totals = $moviments->where('year', $year)->pluck('total')->toArray();
             $datasets[] = [
                 'label' => 'Valores do ano de '.$year,
                 'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
                 'data' => $totals,
             ];
         }
         
         $data2 = [
             'labels' => $labels,
             'datasets' => $datasets,
         ];
         
             //========================================================anual
             $mesmoviments = DB::table('moviments')
            ->select(DB::raw('YEAR(data) as ano'), 'etiqueta', DB::raw('SUM(valor) as total'))
            ->whereYear('data', '=', $ano)
            ->where([['user_id', '=',  $user_id], [ 'tipo', '=', 'S']])
            ->groupBy('ano', 'etiqueta')
            ->orderBy('ano')
            ->get();
         
         $data1 = [
             'labels' => $mesmoviments->pluck('mes')->unique()->toArray(),
             'datasets' => [],
         ];
         
         foreach ($mesmoviments->pluck('etiqueta')->unique() as $etiqueta) {
             $movimentsetiqueta = $mesmoviments->where('etiqueta', $etiqueta);
         
             $data1['datasets'][] = [
                 'label' => "Controle de valores da categoria " . $etiqueta,
                 'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
                 'data' => $movimentsetiqueta->pluck('total')->toArray(),
             ];
         }
         
         $labels1 = $mesmoviments->pluck('etiqueta')->unique();
         $data1 = $mesmoviments->pluck('total')->unique();
         
         
          //========================================================mensal entredas
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
         
         
         if(Auth::user()->status == 'ativo'){
         //========filtra ano ==========
         $data3['filtro'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
         ->orderBy(DB::raw('YEAR(data)'), 'asc')
         ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)->whereYear('data', '=', $ano)
         ->take(12)
         ->get();

         $filtros['filtros'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
         ->orderBy(DB::raw('YEAR(data)'), 'asc')
         ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)
         
         ->get();
         }else{
             $data3['filtro'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
             ->orderBy(DB::raw('YEAR(data)'), 'asc')
             ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)
             ->take(3)
             ->get();

             $filtros['filtros'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
             ->orderBy(DB::raw('YEAR(data)'), 'asc')
             ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)
            
             ->get();
 
         }
         $ano = date('Y');
         $mes = date('m');
         $user_id = Auth::user()->id;
         //=====================
         $EntradaPorAno = DB::table('moviments')
         ->selectRaw('YEAR(data) as ano, MONTH(data) as mes, SUM(valor) as total')
         ->whereYear('data', '=', $ano)
         ->where([
             ['user_id', '=', $user_id],
             ['tipo', '=', 'E']
         ])
         ->groupBy('ano', 'mes')
         ->get();
     
        $SaidaPorAno = DB::table('moviments')
         ->selectRaw('YEAR(data) as ano, MONTH(data) as mes, SUM(valor) as total')
         ->whereYear('data', '=', $ano)
         ->where([
             ['user_id', '=', $user_id],
             ['tipo', '=', 'S']
         ])
         ->groupBy('ano', 'mes')
         ->get();
            return view('/dinheiro/painel', ['entradaPorAno' =>$EntradaPorAno, 'saidaPorAno'=>$SaidaPorAno, 'filtros' => $filtros, 'datae' => $datae, 'data3' => $data3,  'data1' => $data1, 'labelse' => $labelse, 'labels1' => $labels1, 'moviments' => $moviments, 'dinheiros' => $dinheiros, 'totalEntradaPorAno' => $totalEntradaPorAno, 'totalSaidaPorAno' => $totalSaidaPorAno, 'totalEntradaPorMes' => $totalEntradaPorMes, 'totalSaidaPorMes' => $totalSaidaPorMes, 'dadosPizza' => $dadosPizza, 'labels' => $labels, 'data2' => $data2]);
                      
              }

              
//=================================================================
 
              public function buscames(){

               
                $user_id = Auth::user()->id;
          
            
                $filtros = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
                ->orderBy(DB::raw('YEAR(data)'), 'asc')
                ->orderBy(DB::raw('MONTH(data)'), 'asc')
                ->where('user_id', '=', $user_id )
                ->get();
            
                $this->Logger->log('info', 'Busca por mes');
              
              return view('/dinheiro/busca', ['filtros' => $filtros]);
                }
               

//=====================================META

public function meta(){

    return view('/dinheiro/meta');
}
//========================================ADD===Meta
public function metastore(Request $request){

    $id = Auth::user()->id;

    $dinheiro = User::find($id);
    $dinheiro->meta = strip_tags($request->get('meta'));
     
    $dinheiro->save();

    $this->Logger->log('info', 'Atualizou meta');

    return redirect()->route('controle.index', )->with('success', 'Meta cadastrada com sucesso!');
}


}
