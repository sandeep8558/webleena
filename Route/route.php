<?php

use App\Core\Route;

Route::get('/', ['App\Controller\Home', 'home']);

Route::get('/login', ['App\Controller\Auth', 'login']);

Route::get('/forgot', ['App\Controller\Auth', 'forgot']);

Route::get('/authenticate', ['App\Controller\Auth', 'authenticate']);

Route::get('/logout', ['App\Controller\Auth', 'logout']);

Route::get('/dashboard', ['App\Controller\Admin', 'dashboard']);

Route::get('/settings', ['App\Controller\Admin', 'settings']);

Route::get('/api/data/save', ['App\Controller\CrudController', 'save']);

Route::end();