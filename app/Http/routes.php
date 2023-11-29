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
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', 'UsuarioController@index');
        Route::post('/', 'UsuarioController@salvar');
        Route::get('deletar/{id}', 'UsuarioController@deletar');
        Route::get('formulario/{id}', 'UsuarioController@formulario');
    });

    Route::group(['prefix' => 'produtos'], function () {
        Route::get('/', 'ProdutoController@index');
        Route::post('/', 'ProdutoController@salvar');
        Route::get('deletar/{id}', 'ProdutoController@deletar');
        Route::get('formulario/{id}', 'ProdutoController@formulario');
    });

    Route::group(['prefix' => 'perfis'], function () {
        Route::get('/', 'PerfilController@index');
        Route::post('/', 'PerfilController@salvar');
        Route::get('deletar/{id}', 'PerfilController@deletar');
        Route::get('formulario/{id}', 'PerfilController@formulario');
    });
});
Route::get('/home', 'HomeController@index');
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::get('/register', 'CadastroController@index');
Route::post('/register', 'CadastroController@formulario');
Route::post('/register', 'CadastroController@salvar');
