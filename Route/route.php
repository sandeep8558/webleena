<?php

use Core\Route;

/* Website Pages */
Route::get('/login', [App\Controller\Auth::class, 'login']);
Route::get('/forgot', [App\Controller\Auth::class, 'forgot']);
Route::post('/mail', [App\Controller\Auth::class, 'mail']);
Route::post('/update_password', [App\Controller\Auth::class, 'update_password']);
Route::post('/authenticate', [App\Controller\Auth::class, 'authenticate']);
Route::get('/logout', [App\Controller\Auth::class, 'logout']);

/* Admin Pages */
Route::get('/admin/dashboard', [App\Controller\Admin::class, 'dashboard']);
Route::get('/admin/settings', [App\Controller\Admin::class, 'settings']);
Route::get('/admin/user', [App\Controller\Admin::class, 'user']);
Route::get('/admin/pages', [App\Controller\Admin::class, 'pages']);
Route::get('/admin/navigation', [App\Controller\Admin::class, 'navigation']);
Route::get('/admin/layout', [App\Controller\Admin::class, 'layout']);
Route::get('/admin/elements', [App\Controller\Admin::class, 'elements']);
Route::get('/admin/element/crud', [App\Controller\Admin::class, 'element_crud']);

/* API Calls | Authenticated API Calls */
Route::get('/api/data/rows', [App\Controller\CrudController::class, 'rows']);
Route::get('/api/data/all', [App\Controller\CrudController::class, 'all']);
Route::get('/api/data/fields', [App\Controller\CrudController::class, 'fields']);
Route::get('/api/data/type', [App\Controller\CrudController::class, 'type']);
Route::post('/api/data/save', [App\Controller\CrudController::class, 'save']);
Route::post('/api/data/insert', [App\Controller\CrudController::class, 'insert']);
Route::post('/api/data/update', [App\Controller\CrudController::class, 'update']);
Route::post('/api/data/delete', [App\Controller\CrudController::class, 'delete']);
Route::post('/api/data/deletewithchildren', [App\Controller\CrudController::class, 'deletewithchildren']);

Route::post('/api/element/create', [App\Controller\ElementController::class, 'create']);
Route::post('/api/element/update', [App\Controller\ElementController::class, 'update']);
Route::post('/api/element/delete', [App\Controller\ElementController::class, 'delete']);


/* Website API Calls | Non Authenticated API Calls */
Route::get('/api/fetch/rows', [App\Controller\DisplayContentController::class, 'rows']);
Route::get('/api/fetch/all', [App\Controller\DisplayContentController::class, 'all']);

Route::run();