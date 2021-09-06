<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Http\Request;
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

$router->group(['prefix' => 'api/v1'], function() use ($router){
    // register & login 
    $router->post('register', [ 'as' => 'register', 'uses' => 'Auth\ApiAuthController@register']);
    $router->get('verification/{token}', [ 'as' => 'verification', 'uses' => 'Auth\ApiAuthController@verification']);
    $router->get('refresh_activation/{id}', [ 'as' => 'refresh_activation', 'uses' => 'Auth\ApiAuthController@get_activation_token']);
    $router->post('login', [ 'as' => 'login', 'uses' => 'Auth\ApiAuthController@login']);
    $router->post('cek_session', [ 'as' => 'cek_session', 'uses' => 'Auth\ApiAuthController@cek_session']);



    $router->group(['prefix' => 'auth', 'middleware' => 'auth'], function() use ($router){
        $router->get('logout', [ 'as' => 'logout', 'uses' => 'Auth\ApiAuthController@logout']);
        
        // menu admin panel 
        $router->group(['prefix' => 'menu'], function() use ($router){
            $router->get('menu_role/{id}', [ 'as' => 'menu_role', 'uses' => 'MenuController@menu_role']);
            $router->get('menu_ms/{id}', [ 'as' => 'menu_ms', 'uses' => 'MenuController@menu_ms']);
            $router->get('menu_manage', [ 'as' => 'menu_manage', 'uses' => 'MenuController@menu_manage']);
            $router->get('menu_ms/data/{id}', [ 'as' => 'data_menu_ms', 'uses' => 'MenuController@data_menu_ms']);
            // resource
            $router->get('get', ['uses' => 'MenuController@index']);
            $router->get('create', ['uses' => 'MenuController@create']);
            $router->get('get_id', ['uses' => 'MenuController@get_id']);
            $router->post('update/{id}', ['uses' => 'MenuController@update']);
            $router->post('create', ['uses' => 'MenuController@create']);
            $router->delete('delete/{id}', ['uses' => 'MenuController@delete']);
        });
        // end mneu admin panel 

        // user
        $router->group(['prefix' => 'user'], function() use ($router){
            $router->get('get', [ 'as' => 'user', 'uses' => 'UserController@index']);
            $router->post('create', [ 'as' => 'create_user', 'uses' => 'UserController@store']);
            $router->get('edit/{id}', [ 'as' => 'edit_user', 'uses' => 'UserController@edit']);
            $router->post('update/{id}', [ 'as' => 'update_user', 'uses' => 'UserController@update']);
            $router->post('destroy/{id}', [ 'as' => 'destroy_user', 'uses' => 'UserController@destroy']);
        });

        // role
        $router->group(['prefix' => 'role'], function() use ($router){
            $router->get('get', ['uses' => 'RoleController@index']);
            $router->get('create', ['uses' => 'RoleController@create']);
            $router->get('get_id', ['uses' => 'RoleController@get_id']);
            $router->post('update/{id}', ['uses' => 'RoleController@update']);
            $router->post('create', ['uses' => 'RoleController@create']);
            $router->delete('delete/{id}', ['uses' => 'RoleController@delete']);
        });

        // menu_ms
        $router->group(['prefix' => 'menu_ms'], function() use ($router){
            $router->get('get', ['uses' => 'MenuMsController@index']);
            $router->get('create', ['uses' => 'MenuMsController@create']);
            $router->get('get_id', ['uses' => 'MenuMsController@get_id']);
            $router->post('update/{id}', ['uses' => 'MenuMsController@update']);
            $router->post('create', ['uses' => 'MenuMsController@create']);
            $router->delete('delete/{id}', ['uses' => 'MenuMsController@delete']);
        });

        // menu_management
        $router->group(['prefix' => 'menu_management'], function() use ($router){
            $router->get('get', ['uses' => 'MenuManagementController@index']);
            $router->get('create', ['uses' => 'MenuManagementController@create']);
            $router->get('get_id', ['uses' => 'MenuManagementController@get_id']);
            $router->post('update/{id}', ['uses' => 'MenuManagementController@update']);
            $router->post('create', ['uses' => 'MenuManagementController@create']);
            $router->delete('delete/{id}', ['uses' => 'MenuManagementController@delete']);
            $router->get('check_sort', ['uses' => 'MenuManagementController@check_sort']);
        });

        // combo
        $router->group(['prefix' => 'combo'], function() use ($router){
            $router->get('get_master', [ 'as' => 'get_master', 'uses' => 'MenuController@get_master']);
            $router->get('get_menu', [ 'as' => 'get_menu', 'uses' => 'MenuController@get_menu']);
        });

        $router->get('home', function () use ($router) {
            return $router->app->version();
        });
    });
});


// $router->group(['prefix' => 'api/v1'], function () use ($router) {
//     $router->post('login', [ 'as' => 'login', 'uses' => 'Auth\ApiAuthController@login']);
//     $router->group(['middleware' => 'auth:api'], function() use ($router) {
//         $router->get('/', function () use ($router) {
//             return $router->app->version();
//         });
//     });
// });
