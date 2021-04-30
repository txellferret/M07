<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ItemController;
use \App\Http\Controllers\NoteController;
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
 
Route::get('/home', function () {
    return view('welcome');
});


//per a laravel versió 8
Route::get('/items/list', [ItemController::class, 'list']);
Route::get('/items/{item}', [ItemController::class, 'find']);
Route::post('/items/{item}/delete', [ItemController::class, 'delete']);
Route::post('/items/{item}/notes', [NoteController::class, 'store']);
Route::get('/itemform', [ItemController::class, 'addForm']);
Route::post('/items/{item}/update', [ItemController::class, 'update']);
Route::post('/additem', [ItemController::class, 'store']);

Route::get('/notes/list', [NoteController::class, 'list']);
Route::post('/notes/{note}/update', [NoteController::class, 'update']);
Route::post('/notes/{note}/delete', [NoteController::class, 'delete']);
Route::get('/notes/{note}', [NoteController::class, 'find']);

