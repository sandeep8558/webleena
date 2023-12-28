<?php

use Core\Route;
use Core\Data;

/* Website Pages */
Route::get('/', ['App\Controller\Home', 'home']);
Route::get('/login', ['App\Controller\Auth', 'login']);
Route::get('/forgot', ['App\Controller\Auth', 'forgot']);
Route::get('/mail', ['App\Controller\Auth', 'mail']);
Route::get('/update_password', ['App\Controller\Auth', 'update_password']);
Route::get('/authenticate', ['App\Controller\Auth', 'authenticate']);
Route::get('/logout', ['App\Controller\Auth', 'logout']);

/* Admin Pages */
Route::get('/dashboard', ['App\Controller\Admin', 'dashboard']);
Route::get('/settings', ['App\Controller\Admin', 'settings']);
Route::get('/user', ['App\Controller\Admin', 'user']);
Route::get('/pages', ['App\Controller\Admin', 'pages']);
Route::get('/navigation', ['App\Controller\Admin', 'navigation']);
Route::get('/layout', ['App\Controller\Admin', 'layout']);
Route::get('/elements', ['App\Controller\Admin', 'elements']);

/* API Calls */
Route::get('/api/data/save', ['App\Controller\CrudController', 'save']);
Route::get('/api/data/all', ['App\Controller\CrudController', 'all']);
Route::get('/api/data/fields', ['App\Controller\CrudController', 'fields']);
Route::get('/api/data/insert', ['App\Controller\CrudController', 'insert']);
Route::get('/api/data/update', ['App\Controller\CrudController', 'update']);
Route::get('/api/data/delete', ['App\Controller\CrudController', 'delete']);

/* Dynamic Pages created by user */
$pagesdata = new Data('pages');

foreach($pagesdata->all() as $key => $page){
    Route::dynamic($page);
}

Route::end();