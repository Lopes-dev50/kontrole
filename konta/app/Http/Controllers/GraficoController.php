<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moviment;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
    public function index($etiqueta){

        $user_id = Auth::user()->id;
        $ano = date('Y');

        switch ($etiqueta) {
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
       
        //========================================================mensal entredas
        $emoviments = DB::table('moviments')
        ->select(DB::raw('YEAR(data) as ano'), 'motivo', DB::raw('SUM(valor) as total'))
        ->whereYear('data', '=', $ano)
        ->where([['user_id', '=',  $user_id], [ 'tipo', '=', $tipo], [ 'etiqueta', '=', $etiqueta]])
        ->groupBy('ano', 'motivo')
        ->orderBy('ano')
        ->get();
     
     $dataet = [
      'labels' => $emoviments->pluck('mes')->unique()->toArray(),
      'datasets' => [],
     ];
     
     foreach ($emoviments->pluck('motivo')->unique() as $motivo) {
      $movimentsmotivo = $emoviments->where('motivo', $motivo);
     
      $dataet['datasets'][] = [
          'label' => "Controle de valores da categoria " . $motivo,
          'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
          'data' => $movimentsmotivo->pluck('total')->toArray(),
      ];
     }
     
     $labelset = $emoviments->pluck('motivo')->unique();
     $dataet = $emoviments->pluck('total')->unique();


      $etiquetas_distintas = Moviment::distinct('etiqueta')
     ->where('user_id', $user_id)
     ->orderBy('etiqueta')
     ->get(['etiqueta']);


     //===============================================
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
  
  
      $data3['filtro'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
      ->orderBy(DB::raw('YEAR(data)'), 'asc')
      ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)->whereYear('data', '=', $ano)
      ->take(12)
      ->get();

      $filtros['filtros'] = Moviment::select(DB::raw('DISTINCT YEAR(data) as year'), DB::raw('MONTH(data) as month'), DB::raw("DATE_FORMAT(data, '%m/%Y') as month_year"))
      ->orderBy(DB::raw('YEAR(data)'), 'asc')
      ->orderBy(DB::raw('MONTH(data)'), 'asc')->where('user_id', '=', $user_id)
      ->get();

  
   
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



     return view('/dinheiro/grafico', ['entradaPorAno' =>$EntradaPorAno, 'saidaPorAno'=>$SaidaPorAno, 'etiqueta' =>$etiquetas_distintas , 'totalmeta' => $totalMeta, 'filtros' => $filtros, 'datae' => $datae, 'data3' => $data3,  'data1' => $data1, 'labelse' => $labelse, 'labels1' => $labels1, 'moviments' => $moviments, 'dinheiros' => $dinheiros, 'totalEntradaPorAno' => $totalEntradaPorAno, 'totalSaidaPorAno' => $totalSaidaPorAno, 'totalEntradaPorMes' => $totalEntradaPorMes, 'totalSaidaPorMes' => $totalSaidaPorMes, 'dadosPizza' => $dadosPizza, 'labels' => $labels, 'data2' => $data2, 'dataet' => $dataet,   'labelset' => $labelset, 'etiqueta' => $etiquetas_distintas     ]);
    }




    public function mbindex($etiqueta){

        $user_id = Auth::user()->id;
        $ano = date('Y');

        switch ($etiqueta) {
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
       
        //========================================================mensal entredas
        $emoviments = DB::table('moviments')
        ->select(DB::raw('YEAR(data) as ano'), 'motivo', DB::raw('SUM(valor) as total'))
        ->whereYear('data', '=', $ano)
        ->where([['user_id', '=',  $user_id], [ 'tipo', '=', $tipo], [ 'etiqueta', '=', $etiqueta]])
        ->groupBy('ano', 'motivo')
        ->orderBy('ano')
        ->get();
     
     $datae = [
      'labels' => $emoviments->pluck('mes')->unique()->toArray(),
      'datasets' => [],
     ];
     
     foreach ($emoviments->pluck('motivo')->unique() as $motivo) {
      $movimentsmotivo = $emoviments->where('motivo', $motivo);
     
      $datae['datasets'][] = [
          'label' => "Controle de valores da categoria " . $motivo,
          'backgroundColor' => ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(25, 99, 132, 0.5)', 'rgba(154, 62, 235, 0.5)', 'rgba(55, 206, 86, 0.5)', 'rgba(125, 99, 32, 0.5)', 'rgba(84, 162, 25, 0.5)', 'rgba(200, 06, 86, 0.5)'],
          'data' => $movimentsmotivo->pluck('total')->toArray(),
      ];
     }
     
     $labelse = $emoviments->pluck('motivo')->unique();
     $datae = $emoviments->pluck('total')->unique();


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



     return view('/mobi/grafico', ['entradaPorAno' =>$EntradaPorAno, 'saidaPorAno'=>$SaidaPorAno, 'datae' => $datae,   'labelse' => $labelse, 'etiqueta' => $etiquetas_distintas     ]);
    }


    
}


