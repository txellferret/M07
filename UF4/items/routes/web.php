<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ItemController;
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

/*
Route::get('/items', function () {
    return view('item.index');
});

Route::get('/items/list', function () {
    $items = ['Item1', 'Item2', 'Item3'];
    //$items = [];  //to test for empty list.
    return view('item.list', compact('items'));
});
*/

//per a laravel versió 8
Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/list', [ItemController::class, 'list']);

Route::get('/items/{item}', [ItemController::class, 'find']);