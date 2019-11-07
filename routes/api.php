<?php

Route::group(
    [
        'prefix' => 'lot',
        'namespace'  => 'Atiladanvi\LaravelObjectTrafic\Http\Controllers',
    ],
    function () {
        Route::get('{model}', 'LotApiController@index')->name('lot.api');
    }
);

