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

$router->get('/', function () use ($router) {
    return $router->app->version() . ' by Dai Luc';
});

$router->group(['prefix' => 'posts'], function () use ($router) {
    $router->get('/', 'PostsController@getPosts');
    $router->post('/', 'PostsController@createPosts');
    $router->put('/{id}', 'PostsController@updatePosts');
    $router->delete('/{id}', 'PostsController@deletePosts');

    $router->post('/{id}/like', 'PostsController@likePosts');
    $router->delete('/{id}/unlike', 'PostsController@unlikePosts');

});
