<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostIndexController as AdminPostIndexController;
use App\Http\Controllers\PostIndexController;
use App\Http\Controllers\ShowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/posts', PostIndexController::class);
Route::get('/posts/{post:slug}', ShowController::class);
Route::get('/admin/posts', [PostController::class, 'index']);
Route::post('/admin/posts', [PostController::class, 'store']);
Route::get('/admin/posts/{post:uuid}/edit', [PostController::class, 'edit']);
Route::patch('/admin/posts/{post:uuid}', [PostController::class, 'update']);
Route::delete('/admin/posts/{post:uuid}', [PostController::class, 'delete']);
