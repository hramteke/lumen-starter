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

use App\Http\Controllers\Api\QuoteController;

$app->get('/', function () use ($app) {
    return $app->make('db')->table('quotes')->orderByRaw('random()')->take(1)->get();
});
$app->group(['prefix' => 'api/v1'], function () use ($app) {
    $app->get('quotes', ['middleware' => 'jsonApi.enforceMediaType', 'uses' => QuoteController::class . '@index']);
    $app->post('quotes', ['middleware' => 'jsonApi.enforceMediaType', 'uses' => QuoteController::class . '@post']);
    $app->get('quotes/{id}', ['middleware' => 'jsonApi.enforceMediaType', 'uses' => QuoteController::class . '@show']);
});
