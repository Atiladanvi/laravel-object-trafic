<?php

Route::group(
    [
        'prefix' => 'lot',
        'namespace'  => 'Atiladanvi\LaravelObjectTrafic\Http\Controllers',
        'middleware' => config('laravel-object-trafic.middleware')
    ],
    function () {
        Route::get('{model}', 'LotApiController@index')->name('lot.api');
    }
);

