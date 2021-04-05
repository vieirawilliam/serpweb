<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function ($router) {

    Route::resource('cadger','CadgerController');                                //TABELA CADGER
    Route::get('cadger/carregaselect/lista', 'CadgerController@carregaselect');  //TABELA CADGER

    Route::resource('cadvend','CadvendController');                                                              //TABELA CADVEND
    Route::get('cadvend/showvendedor/lista', 'CadvendController@showvendedor');                                  //TABELA LISTA VENDEDOR PARA PESQUISA
    Route::resource('cadparam','CadparamController');                                                            //TABELA CADPARAM
    Route::get('cadparam/retornaparametros/lista','CadparamController@retornaparametros');                       //TABELA CADPARAM RETORNA TODOS OS DADOS
    Route::resource('tblusu','TblusuController');                                                                //TABELA TBLUSU 
    Route::get('tblusu/retornafotogravatar/foto/{emailusu}', 'TblusuController@retornafotogravatar');            //TABELA TBLUSU RETORNA FOTO GRAVATAR
    Route::resource('cadmod','CadmodController');                                                                //TABELA CADMOD
    Route::resource('tabmenu','TabmenuController');                                                              //TABELA TABMENU
    Route::resource('menuusu','MenuUsuController');                                                              //TABELA MENU_USU
    Route::get('menuusu/listamenusmodpermitidos/lista', 'MenuUsuController@listmenuusumodpermitido');            //TABELA MENU_USU LISTA
    Route::resource('modulousu','ModulousuController');                                                          //TABELA MODULOUSU
    Route::get('modulousu/listamodusupermitidos/lista/{idtblusu}', 'ModulousuController@listmodusupermitidos');  //TABELA MODULOUSU LISTA
    Route::get('tblusu/retornafotogravatar/foto/{idtblusu}', 'TblusuController@retornafotogravatar');            //TABELA TBLUSU RETORNA FOTO GRAVATAR

    Route::resource('cadcondpagamento','CadcondpagamentoController');                                            //TABELA CONDIÇÃO DE PAGAMENTO
    Route::get('cadcondpagamento/carregaselect/lista', 'CadcondpagamentoController@carregaselect');              //TABELA CONDIÇÃO DE PAGAMENTO CARREGA SELECT
    Route::resource('cadformapagamento','CadformapagamentoController');                                          //TABELA FORMA DE PAGAMENTO
    Route::get('cadformapagamento/carregaselect/lista', 'CadformapagamentoController@carregaselect');            //TABELA FORMA DE PAGAMENTO CARREGA SELECT
    Route::resource('cadbanco','CadbancoController');                                                            //TABELA CADASTRO DE BANCO
    Route::get('cadbanco/carregaselect/lista', 'CadbancoController@carregaselect');                              //TABELA CADASTRO DE BANCO CARREGA SELECT

    //CADFILIAL
    Route::get('cadfilial/getFiliais','CadfilialController@getFiliais');
    Route::get('cadfilial/getFiliaisAtivas','CadfilialController@getFiliaisAtivas');
    Route::get('cadfilial/getFilialByID/{codfilial}','CadfilialController@getFilialByID');
    Route::post('cadfilial/store','CadfilialController@store');
    Route::put('cadfilial/update/{codfilial}','CadfilialController@update');

});
