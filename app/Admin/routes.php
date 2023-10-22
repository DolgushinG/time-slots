<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('events', EventsController::class);
    $router->resource('services', ServicesController::class);
    $router->resource('time-slots', TimeSlotController::class);
    $router->resource('mode-of-schedules', ModeOfScheduleController::class);


});
