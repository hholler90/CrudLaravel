<?php
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', 'UsuarioController@index');
        Route::post('/', 'UsuarioController@salvar');
        Route::post('deletar/{id}', 'UsuarioController@deletar')->name('usuarios.deletar');
        Route::get('formulario/{id}', 'UsuarioController@formulario');
    });

    Route::group(['prefix' => 'produtos'], function () {
        Route::get('/', 'ProdutoController@index');
        Route::post('/', 'ProdutoController@salvar');
        Route::post('deletar/{id}', 'ProdutoController@deletar')->name('produtos.deletar');
        Route::get('formulario/{id}', 'ProdutoController@formulario');
    });

    Route::group(['prefix' => 'perfis'], function () {
        Route::get('/', 'PerfilController@index');
        Route::post('/', 'PerfilController@salvar');
        Route::post('deletar/{id}', 'PerfilController@deletar')->name('perfis.deletar');
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


Route::get('/log', 'RelatorioController@exibirLogs')->name('log.index');

