<?php

use Core\Route;

/* Website Pages */
Route::get('/', [App\Controller\Home::class, 'home']);
Route::get('/login', [App\Controller\Auth::class, 'login']);
Route::get('/forgot', [App\Controller\Auth::class, 'forgot']);
Route::get('/mail', [App\Controller\Auth::class, 'mail']);
Route::get('/update_password', [App\Controller\Auth::class, 'update_password']);
Route::get('/authenticate', [App\Controller\Auth::class, 'authenticate']);
Route::get('/logout', [App\Controller\Auth::class, 'logout']);

/* Admin Pages */
Route::get('/dashboard', [App\Controller\Admin::class, 'dashboard']);
Route::get('/settings', [App\Controller\Admin::class, 'settings']);
Route::get('/user', [App\Controller\Admin::class, 'user']);
Route::get('/pages', [App\Controller\Admin::class, 'pages']);
Route::get('/navigation', [App\Controller\Admin::class, 'navigation']);
Route::get('/layout', [App\Controller\Admin::class, 'layout']);
Route::get('/elements', [App\Controller\Admin::class, 'elements']);

/* API Calls */
Route::get('/api/data/all', [App\Controller\CrudController::class, 'all']);
Route::get('/api/data/fields', [App\Controller\CrudController::class, 'fields']);
Route::get('/api/data/type', [App\Controller\CrudController::class, 'type']);
Route::post('/api/data/save', [App\Controller\CrudController::class, 'save']);
Route::post('/api/data/insert', [App\Controller\CrudController::class, 'insert']);
Route::post('/api/data/update', [App\Controller\CrudController::class, 'update']);
Route::post('/api/data/delete', [App\Controller\CrudController::class, 'delete']);

Route::run();