<!--
    Author: Samuel Cook
    Date: December 12, 2024
    Sorry for clunkiness, this was all new to me.
-->

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('landing');
});

// Post Route for the landing page for the inventory management web app.
Route::post('/', [CategoryController::class, 'showLanding'])->name('/');

// Post Routes for the master list pages for categories and items
Route::post('/categories', [CategoryController::class, 'showMasterCat'])->name('/categories');
Route::post('/items', [CategoryController::class, 'showMasterItems'])->name('/items');

// Post Routes for the category creation page as well as for submission of new categories.
Route::post('/categories/create', [CategoryController::class, 'addCategory'])->name('/categories/create');
Route::post('/categories/create/results', [CategoryController::class, 'insertCategory'])->name('/categories/create/results');

// Post Routes for item creation page and the submission.
Route::post('/items/create', [CategoryController::class, 'addItem'])->name('/items/create');
Route::post('/items/create/results', [CategoryController::class, 'insertItem'])->name('/items/create/results');

// Get routes for the categories and add category pages that allows for direct access from URL.
Route::get('/categories', [CategoryController::class, 'showMasterCat'])->name('/categories');
Route::get('/categories/create', [CategoryController::class, 'addCategory'])->name('/categories/create');

// Get routes for the items and add item pages that allows for direct access from URL.
Route::get('/items', [CategoryController::class, 'showMasterItems'])->name('/items');
Route::get('/items/create', [CategoryController::class, 'addItem'])->name('/items/create');

// Post routes for editing specific items and categories pages
Route::post('/items/{id}/edit', [CategoryController::class, 'editItem'])->name('/items/{id}/edit');
Route::post('/categories/{id}/edit', [CategoryController::class, 'editCategory'])->name('/categories/{id}/edit');

// Post routes for sending the results of an edit in both category and item
Route::post('/items/{id}/edit/results', [CategoryController::class, 'alterItem'])->name('/items/{id}/edit/results');
Route::post('/categories/{id}/edit/results', [CategoryController::class, 'alterCategory'])->name('/categories/{id}/edit/results');

// Route for deleting an item. Only for items, not required for categories.
Route::post('/items/{id}/delete', [CategoryController::class, 'deleteItem'])->name('/items/{id}/delete');
