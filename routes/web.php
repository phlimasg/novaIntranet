<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Rotas de login do google */

use Illuminate\Support\Facades\Auth;

Route::get('login/google', 'Auth\GoogleLoginController@redirectToProvider')->name('googleLogin');
Route::post('logout', 'Auth\GoogleLoginController@logout')->name('logout');
Route::get('login/google/callback', 'Auth\GoogleLoginController@handleProviderCallback');
/**Fim Login google */


/* Rotas a aplicação de veículos */
Route::get('autorizar-solicitacao/{token}', 'Veiculos\UtilizacaoController@autorizar');

Route::middleware('auth')->group(function(){
    Route::resource('controle-de-utilizacao', 'Veiculos\UtilizacaoController');
    Route::prefix('administracao')->group(function(){
        Route::resource('veiculos', 'Veiculos\VeiculosController');
        Route::resource('coordenador', 'Veiculos\CoordenadorController');
        Route::resource('motoristas', 'Veiculos\MotoristaController');
        Route::any('solicitacoes/search', 'Veiculos\SolicitacoesController@search')->name('solicitacoes.search');
        Route::resource('solicitacoes', 'Veiculos\SolicitacoesController');
        Route::resource('usuarios', 'Veiculos\UsuariosController');
        Route::resource('entregas', 'Veiculos\EntregasController');
    });

});


Route::get('/', function () {
    if(Auth::check())
        return redirect()->route('controle-de-utilizacao.index');    
    return view('welcome');
});
Route::get('/mail', function () {
    return view('mail.MailCoordenador');
});
