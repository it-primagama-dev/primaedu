<?php
date_default_timezone_set('Asia/Jakarta');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});
//auth route
$app->group(['prefix' => 'auth', 'middleware' => 'security'], function () use ($app) {
    $app->get('/', 'AuthController@index');
    $app->post('register', 'AuthController@store');
});
//log route
$app->group(['prefix' => 'log', 'middleware' => 'auth'], function () use ($app) {
    $app->get('/', 'LogController@index');
});
//deposit route
$app->group(['prefix' => 'deposit', 'middleware' => 'auth'], function () use ($app) {
    $app->get('/', 'DepositDetailController@index');
    $app->get('details', 'DepositDetailController@getAll');
    $app->get('details/{id}', 'DepositDetailController@getOne');
    $app->post('details', 'DepositDetailController@store');
//    $app->put('details/{id}', 'DepositDetailController@update');
//    $app->delete('details/{id}', 'DepositDetailController@delete');
});
