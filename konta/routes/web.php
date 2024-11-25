<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovimentsController;
use App\Http\Controllers\MobiController;
use App\Http\Controllers\GraficoController;
use App\Http\Controllers\EdminController;
use App\Http\Controllers\PagarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\NovaAssinaturaController;
use App\Http\Controllers\PagSeguroController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\WebhooksController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('inicio');
});

Route::get('/planos', function () {
    return view('iniciodetalhes');
});

Route::get('termo', function () {
    return view('termo');
});


Route::get('privacidade', function () {
    return view('privacidade');
});

//==remover em produçao




Route::get('/dashboard', function () {

   
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
    Route::get("/dinheiro/painel", [MovimentsController::class, 'index'])->name('controle.index');
    Route::match(['get', 'post'],"/dinheiro/controle", [MovimentsController::class, 'store'])->name('controle.store');
    Route::get("/dinheiro/cadames/{mes}/{ano}", [MovimentsController::class, 'cadames'])->name('cada.mes');
    Route::post("/dinheiro/cada/{id}/{mes}/{ano}", [MovimentsController::class, 'update'])->name('controle.update');
    Route::get("/dinheiro/edit/{id}/{mes}", [MovimentsController::class, 'edit'])->name('controle.edit');
    Route::get("/dinheiro/cadame/{id}/{mes}/{ano}", [MovimentsController::class, 'destroy'])->name('destroy');
    Route::get("/dinheiro/cad/{id}/{mes}/{ano}", [MovimentsController::class, 'pagar'])->name('controle.pagar');
    Route::get("/dinheiro/adicionar", [MovimentsController::class, 'adicionar'])->name('controle.adicionar');
    Route::get("/dinheiro/paine", [MovimentsController::class, 'freeindex'])->name('free.index');
    Route::get("/dinheiro/busca", [MovimentsController::class, 'buscames'])->name('busca.mes');
    
    //mobi
    
    Route::get("/mobi/painel", [MobiController::class, 'index'])->name('mbcontrole.index');
    Route::match(['get', 'post'],"/mobi/controle", [MobiController::class, 'store'])->name('mbcontrole.store');
    Route::get("/mobi/cadames/{mes}/{ano}", [MobiController::class, 'cadames'])->name('mbcada.mes');
    Route::post("/mobi/cada/{id}/{mes}/{ano}", [MobiController::class, 'update'])->name('mbcontrole.update');
    Route::get("/mobi/edit/{id}/{mes}", [MobiController::class, 'edit'])->name('mbcontrole.edit');
    Route::get("/mobi/cadame/{id}/{mes}/{ano}", [MobiController::class, 'destroy'])->name('mbdestroy');
    Route::get("/mobi/cad/{id}/{mes}/{ano}", [MobiController::class, 'pagar'])->name('mbcontrole.pagar');
    Route::get("/mobi/paine", [MobiController::class, 'freeindex'])->name('mbfree.index');
    Route::get("/mobi/busca", [MobiController::class, 'buscames'])->name('mbbusca.mes');
    Route::get("/mobi/grafi/{etiqueta}", [GraficoController::class, 'mbindex'])->name('mbgrafico.index');
    Route::get("/mobi/meta", [MobiController::class, 'meta'])->name('mbmeta.index');
    Route::post("/mobi/met", [MobiController::class, 'metastore'])->name('mbmeta.store');
    
    
    //===logs
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');

   
    //==============mercadopago
    Route::post('/pagar/pagamento-recorrente', [MercadoPagoController::class, 'criarPagamentoRecorrente'])->name('mercadopago.criar');
    Route::get('/pagar/pagamento-recorrente/sucesso', [MercadoPagoController::class, 'pagamentoRecorrenteSucesso'])->name('mercadopago.sucesso');
    Route::get('/pagar/pagamento-recorrente/cancelado', [MercadoPagoController::class, 'pagamentoRecorrenteCancelado'])->name('mercadopago.cancelado');
    Route::get('/pagar/cadastro-cartao', [MercadoPagoController::class, 'exibirCadastroCartao'])->name('mercadopago.cadastro');
   

  
    Route::post('/pagar/cadastrocartao', [NovaAssinaturaController::class, 'enviarPedidoParaMercadoPago'])->name('mercadopago.assinatura');




    Route::get("/dinheiro/pagar/{valor}", [PagarController::class, 'index'])->name('pagar.index');

    Route::get("/dinheiro/pix", [PagarController::class, 'ppa'])->name('ppa');
    Route::get('/pay/{id}', [PagarController::class, 'pay'])->name('pay');
    //===meta
    Route::get("/dinheiro/meta", [MovimentsController::class, 'meta'])->name('meta.index');
    Route::post("/dinheiro/met", [MovimentsController::class, 'metastore'])->name('meta.store');
    

    //====grafico
    Route::get("/dinheiro/grafi/{etiqueta}", [GraficoController::class, 'index'])->name('grafico.index');
   



    //===admin
    Route::get("/edmin/lista", [EdminController::class, 'index'])->name('admin.index');
    Route::get("/edmin/lista/{id}", [EdminController::class, 'bonus'])->name('admin.bonus');
    Route::get("/edmin/list/{id}", [EdminController::class, 'adminEmail'])->name('admin.email');


});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['web']], function () {
   

Route::post('/criar-plano', [PagSeguroController::class, 'criarPlano']);
Route::post('/criar-assinatura', [PagSeguroController::class, 'criarAssinatura']);
Route::post('/retorno-pagamento', [PagSeguroController::class, 'retornoPagamento']);
});

Route::match(['get', 'post'],'webhooks', WebhooksController::class);

//Vendedor	TESTT56323      5F1Xis19DE	    18/05/2023	

//Comprador	TTTEST24978     CP3hlt73Uy       18/05/2023

//api plano pagseguro 2B08DA7B-E9E9-8D4B-B4E1-FF9A8588B4AE
