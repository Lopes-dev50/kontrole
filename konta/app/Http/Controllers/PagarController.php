<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Moviment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PagarController extends Controller
{
    public function index($valor){


        $id = Auth::user()->id;
        $data['user'] =  User::find($id);

       return view('/pagar/listaValor', ['valor' => $valor, 'usuario' => $data]);
    }

public function pay($id, Request $request){
    $payment_id = $request->get('payment_id');


    $response = HTTP::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-60000000000000000000-041921-9b145f3d7993cf775e952e1e57eb9a21-178883096");

   $response =  json_decode($response, true);

   $user_id =  $response['additional_info']['items'][0]['id'];
   $valor = $response['additional_info']['items'][0]['category_id'];
   $dia = $response['additional_info']['items'][0]['description'];


   $status = $response['status'];

   if($status == 'approved'){

       $inicio_date = Carbon::now();

       $dataAtual = Carbon::now();

       if($valor < 50){

           $fim_date = $dataAtual->add(30, 'days')->format('Y-m-d');

       }else{

           $fim_date = $dataAtual->add(365, 'days')->format('Y-m-d');

       }

       $estatus = 'ativo';
       $dia = date('d');

       $ovalor = $valor . 0 . 0;

       User::where('id',$user_id)->update(array( 'status'=> $estatus));
       User::where('id',$user_id)->update(array( 'inicio_date' =>$inicio_date ));
       User::where('id',$user_id)->update(array( 'fim_date' => $fim_date ));
       User::where('id',$user_id)->update(array( 'plano' => 'Gold' ));
       Moviment::create([ 'data' => $inicio_date, 'motivo'=> 'Plano Gold','etiqueta' => 'Kontrole', 'dia' => $dia, 'valor' =>$ovalor, 'tipo'=>'S', 'pago' => 'S', 'user_id' => $user_id,  ]);
       Moviment::create([ 'data' => $inicio_date, 'motivo'=> 'Plano Gold-'. $user_id ,'etiqueta' => 'Kontrole', 'dia' => $dia, 'valor' =>$ovalor, 'tipo'=>'E', 'pago' => 'S', 'user_id' => 1,  ]);

       return view('pagar/approved');
    
   }
  //pagamento pendente
  if($status == 'pending'){
      return view('pagar/pending');
   }
   //pagamento negado
     if($status == 'failure'){
    return view('pagar/failure');
   }

}
    
}
