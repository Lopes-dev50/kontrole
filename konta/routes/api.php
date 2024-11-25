<?php
use App\Http\Controllers\API\ContaController;
use App\Http\Controllers\Api\SupportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ListKeyController;
use Illuminate\Http\Request;


 Route::apiResource('/supports', SupportController::class);


Route::post('listkey/{key}/{site}', [ListkeyController::class, 'listkey']);

 Route::post('register', [UserController::class, 'register']);
 Route::post('login', [UserController::class, 'login']);


 Route::group( ['middleware'=> ["auth:sanctum"] ], function() {
 Route::get("user-profile", [UserController::class, "userProfile"]);
 Route::get("logout", [UserController::class, "logout"]);

 Route::get("AppPainel/{id}", [UserController::class, "AppPainel"])->name('AppPainel');
 Route::get('ListaConta/{id}', [ContaController::class, 'ListaConta'])->name('ListaConta');
 
 Route::post('addConta/{id}', [ContaController::class, 'addConta'])->name('addConta');
 Route::get('editConta/{id}', [ContaController::class, 'editConta'])->name('editConta');
 Route::get('delConta/{id}', [ContaController::class, 'delConta'])->name('delConta');
 Route::get('listaMes/{id}', [ContaController::class, 'listaMes'])->name('listaMes');
 
 ///graficos
 Route::get('EntradasaidaPorAno/{id}', [ContaController::class, 'EntradasaidaPorAno'])->name('EntradasaidaPorAno');
 Route::get('EntradaPorAno/{id}', [ContaController::class, 'EntradaPorAno'])->name('EntradaPorAno');
 Route::get('SaidaPorAno/{id}', [ContaController::class, 'SaidaPorAno'])->name('SaidaPorAno');
 Route::get('geralano/{id}', [ContaController::class, 'geralano'])->name('geralano');



 Route::get('AppListaEtiqueta/{id}', [ContaController::class, 'AppListaEtiqueta'])->name('AppListaEtiqueta');
 Route::get('filtro/{id}', [ContaController::class, 'filtro'])->name('filtro');
 Route::get('mostracadames/{id}/{mes}/{ano}', [ContaController::class, 'mostracadames'])->name('mostracadames');

 Route::put('EdtConta/{id}', [ContaController::class, 'EdtConta'])->name('EdtConta');
 Route::get('ContaUnico/{id}/{userid}', [ContaController::class, 'ContaUnico'])->name('ContaUnico');

 Route::put('DeletarCliente/{id}', [ContaController::class, 'DeletarCliente'])->name('DeletarCliente');


});

//Esta ruta viene por defecto
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


