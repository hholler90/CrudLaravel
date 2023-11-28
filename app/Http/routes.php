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

Route::group(['prefix' => 'produtos', 'middleware' => ['auth'] ], function () {
    Route::get('/', 'ProdutoController@index');
    Route::post('/', 'ProdutoController@formulario');
    Route::post('/', 'ProdutoController@salvar');
    Route::get('deletar/{id}', 'ProdutoController@deletar');
    Route::get('formulario/{id}', 'ProdutoController@formulario');
});

Route::group(['prefix' => 'perfis'], function () {
    Route::get('/', 'PerfilController@index');
    Route::post('/', 'PerfilController@formulario');
    Route::post('/', 'PerfilController@salvar');
    Route::get('deletar/{id}', 'PerfilController@deletar');
    Route::get('formulario/{id}', 'PerfilController@formulario');
});


Route::get('/home', 'HomeController@index');
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
