<?php

use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\GuestController;
use App\Admin\Controllers\ReservationController;
use App\Admin\Controllers\RoomController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    
    $router->resource('categories', CategoryController::class);
    $router->resource('rooms', RoomController::class);
    $router->resource('reservations', ReservationController::class);
    $router->resource('guests', GuestController::class);
});
