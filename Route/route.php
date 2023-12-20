<?php

use App\Core\Route;

Route::get('/', ['App\Controller\Home', 'home']);

Route::get('/login', ['App\Controller\Auth', 'login']);

Route::get('/forgot', ['App\Controller\Auth', 'forgot']);

Route::get('/reset', ['App\Controller\Auth', 'reset']);

Route::end();