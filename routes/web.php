<?php

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

$router->get('/charbot/ask', 'MessageController@getMatchingMessages');
$router->get('/messages', 'MessageController@index');
$router->get('/history', 'HistoryController@index');
$router->get('/history/{user_id}', 'HistoryController@getHistoryByUser');
$router->post('/history', 'HistoryController@store');