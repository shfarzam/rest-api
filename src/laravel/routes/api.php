<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Create article
Route::post('/articles', [ArticleController::class, 'create']);

// Edit article
Route::put('/articles/{id}', [ArticleController::class, 'update']);

// List articles
Route::get('/articles', [ArticleController::class, 'list']);

// View article
Route::get('/articles/{id}', [ArticleController::class, 'view']);

// Delete article
Route::delete('/articles/{id}', [ArticleController::class, 'delete']);

