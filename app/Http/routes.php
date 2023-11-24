<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', 'UsuarioController@index');
Route::post('/usuarios', 'UsuarioController@formulario');
Route::post('/usuarios', 'UsuarioController@salvar');
Route::delete('/usuarios/{usuario}', 'UsuarioController@deletar')->name('usuarios.deletar');
Route::get('/usuarios/deletar/{id}', 'UsuarioController@deletar');
Route::get('/usuarios/formulario/{id}', 'UsuarioController@formulario');
Route::get('/usuarios', 'UsuarioController@index')->name('usuarios.index');

Route::group(['prefix' => 'produtos'],function(){
Route::get('/', 'ProdutoController@index');
Route::post('/', 'ProdutoController@formulario');
Route::post('/', 'ProdutoController@salvar');
Route::delete('/{usuario}', 'ProdutoController@deletar')->name('produtos.deletar');
Route::get('deletar/{id}', 'ProdutoController@deletar');
Route::get('formulario/{id}', 'ProdutoController@formulario');
Route::get('/', 'ProdutoController@index')->name('produtos.index');
});