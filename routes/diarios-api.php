<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiariosAntigosController;

/*
|--------------------------------------------------------------------------
| Endpoint para Integração Externa (Diários Oficiais Antigos)
|--------------------------------------------------------------------------
|
| Este endpoint permite que um outro sistema consulte informações do diario oficial
| antigo. 
|
*/

Route::group(['prefix' => 'diarios-api'], function () {
    Route::get('diarios-antigos', [DiariosAntigosController::class, 'index'])
         ->name('diarios-api.diarios-antigos');
});
