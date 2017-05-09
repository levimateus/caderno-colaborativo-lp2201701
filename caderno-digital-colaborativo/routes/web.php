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

Route::get('/', function () {
    return view('welcome');
});



/**
 * 
 * https://laracasts.com/discuss/channels/eloquent/replacing-the-laravel-authentication-with-a-custom-authentication-errors
 */
Auth::routes();

Route::get('/home', 'PublicacaoController@index');
Route::get('/post/{postId}', 'PublicacaoController@show');

//Route::get('/post', 'PublicacaoController@index');//TESTE
Route::post('/post', 'PublicacaoController@publicar');
Route::post('/comment', 'ComentarioController@comentar');
//Route::get('/post/{id}', 'PublicacaoController@ver'); //TESTE

