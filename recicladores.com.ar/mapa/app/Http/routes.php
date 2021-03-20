<?php

$app->get('/implementacion', ['uses' => 'App\Http\Controllers\UseController@show']);



$app->get('/', ['uses' => 'App\Http\Controllers\UseController@usage']);
$app->get('/que_es', ['uses' => 'App\Http\Controllers\UseController@que_es']);
$app->get('/somos', ['uses' => 'App\Http\Controllers\UseController@somos']);
$app->get('/contacto', ['uses' => 'App\Http\Controllers\UseController@contacto']);
$app->get('/lista_precios', ['uses' => 'App\Http\Controllers\UseController@lista_precios']);
