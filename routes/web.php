<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarpenterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MessageController::class,"index"]);

Route::get('/messages/new', [MessageController::class,"new"]);

Route::get('/messages/{message}', [MessageController::class,"show"]);

Route::get('/clients', [ClientController::class,"index"]);

Route::get('/clients/new', [ClientController::class,"new"]);

Route::get('/clients/{client}', [ClientController::class,"show"]);

Route::get('/carpenters', [CarpenterController::class,"index"]);

Route::get('/carpenters/new', [CarpenterController::class,"new"]);

Route::get('/carpenters/{carpenter}', [CarpenterController::class,"show"]);

Route::get('/sentences', [SentenceController::class,"index"]);

Route::get('/sentences/new', [SentenceController::class,"new"]);

Route::get('/sentences/{sentence}', [SentenceController::class,"show"]);
