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

URL::forceScheme('https');

$router->get('/', 'HomeController@index');

$router->get('/{user}/title', 'HomeController@checkTitle');

$router->get('/{user}', 'HomeController@loadUser');
