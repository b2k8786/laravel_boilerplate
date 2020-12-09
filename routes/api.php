<?php

use App\Http\Controllers\Users;
use App\Http\Controllers\Products;
use Illuminate\Support\Facades\Route;

$router->group(['prefix' => 'v1', 'namespace' => '\App\Modules\Api\V1\Controllers', 'middleware' => 'cors'], function ($router) {

    // public api like

    $router->group(['middleware' => ['CheckAccessToken']], function ($router) {

        // API require token

        $router->group(['middleware' => ['IsAuthorized']], function ($router) {

            // API require token and authorization 

        });
    });
});

Route::post('/addProduct', [Products::class, 'add']);
Route::post('/addUser', [Users::class,'add']);
Route::get('/addUser', function () {
    echo "Yes Debug.....";die;
});
