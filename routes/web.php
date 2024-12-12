<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('landing');
});

Route::post('/', [CategoryController::class, 'showLanding'])->name('/');

Route::post('/categories', [CategoryController::class, 'showMasterCat'])->name('/categories');
Route::post('/items', [CategoryController::class, 'showMasterItems'])->name('/items');

Route::post('/categories/create', [CategoryController::class, 'addCategory'])->name('/categories/create');
Route::post('/categories/create/results', [CategoryController::class, 'insertCategory'])->name('/categories/create/results');

Route::post('/items/create', [CategoryController::class, 'addItem'])->name('/items/create');




Route::get('/categories', function () {
    return view('mastercat');
})->name('/categories');

Route::get('/categories/create', function () {
    return view('addcat');
})->name('/categories/create');

Route::get('/items', function () {
    return view('masteritems');
})->name('/items');

Route::get('/items/create', function () {
    return view('additem');
})->name('/items/create');