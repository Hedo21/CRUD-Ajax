<?php

use App\Http\Controllers\KopiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('owners', [OwnerController::class, 'create']);
Route::get('/kopi/list', [KopiController::class, 'index']);
Route::get('/kopi/list/yajra', [KopiController::class, 'yajra']);
Route::get('/kopi/list/id/{id}', [KopiController::class, 'show']);
Route::post('/kopi/list/tambah', [KopiController::class, 'create']);
Route::put('/kopi/list/update/{id}', [KopiController::class, 'update']);
Route::delete('/kopi/list/delete/{id}', [KopiController::class, 'destroy']);
