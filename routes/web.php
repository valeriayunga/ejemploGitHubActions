<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->group(['prefix' => 'authors'], function () use ($router) {
    $router->get('/', ['uses' => 'AuthorController@index']);
    $router->get('/{id}', ['uses' => 'AuthorController@show']);
    $router->post('/', ['uses' => 'AuthorController@store']);
    $router->put('/{id}', ['uses' => 'AuthorController@update']);
    $router->delete('/{id}', ['uses' => 'AuthorController@destroy']);
});

$router->group(['prefix' => 'publishers'], function () use ($router) {
    $router->get('/', 'PublisherController@index');
    $router->get('/{id}', 'PublisherController@show');
    $router->post('/', 'PublisherController@store');
    $router->put('/{id}', 'PublisherController@update');
    $router->delete('/{id}', 'PublisherController@destroy');
    $router->get('/{id}/authors', 'PublisherController@authors');
    $router->post('/{id}/authors', 'PublisherController@associateAuthor');
    $router->delete('/{id}/authors', 'PublisherController@disassociateAuthor');
});

